<?php

namespace App\Console\Commands;

use App\Mail\WeeklyReport;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWeeklyReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:weekly-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly reports to users.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Starting weekly report sending process.');

        try {
            User::all()->each(function ($user) {
                Mail::to($user->email)->send(new WeeklyReport($user));
            });

            Log::info('Weekly report sending process completed successfully.');
            $this->info('Weekly report sending process completed successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to send weekly reports: '.$e->getMessage());
            $this->error('An error occurred during the weekly report sending process. Check the logs for details.');

            return 1;
        }

        return 0;
    }
}
