<?php

namespace App\Mail;

use App\Models\User;
use App\Support\TimeHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WeeklyReport extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Your Weekly Time Report',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $projects = $this->user->projects()
            ->with(['timeEntries' => function ($query) {
                // Filter time entries to only include those from the start of the current week
                $query->where('start_time', '>=', now()->startOfWeek());
            }])
            // Calculate the sum of durations (in minutes) for time entries within the current week for each project
            ->withSum(['timeEntries' => function ($query) {
                $query->where('start_time', '>=', now()->startOfWeek());
            }], 'duration')
            ->get()
            // Filter out projects that have no time logged in the current week
            ->filter(function ($project) {
                return $project->time_entries_sum_duration > 0;
            });

        $projects->each(function ($project) {
            $project->weekly_total_formatted = TimeHelper::formatDurationFromMinutes($project->time_entries_sum_duration ?? 0);
        });

        return new Content(
            markdown: 'mail.weekly-report',
            with: [
                'user' => $this->user,
                'projects' => $projects,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
