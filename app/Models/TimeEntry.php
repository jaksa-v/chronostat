<?php

namespace App\Models;

use Database\Factories\TimeEntryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeEntry extends Model
{
    /** @use HasFactory<TimeEntryFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['duration_formatted'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function ($timeEntry) {
            if ($timeEntry->start_time && $timeEntry->end_time) {
                $timeEntry->duration = $timeEntry->start_time->diffInSeconds($timeEntry->end_time);
            }
        });
    }

    public function getDurationFormattedAttribute(): string
    {
        if (! $this->start_time || ! $this->end_time) {
            return '0m';
        }

        $diffInSeconds = $this->start_time->diffInSeconds($this->end_time);
        $diffInMinutes = floor($diffInSeconds / 60);
        $hours = floor($diffInMinutes / 60);
        $minutes = $diffInMinutes % 60;

        if ($hours > 0) {
            return "{$hours}h {$minutes}m";
        }

        return "{$diffInMinutes}m";

    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
