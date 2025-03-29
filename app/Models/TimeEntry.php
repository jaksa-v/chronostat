<?php

namespace App\Models;

use App\Support\TimeHelper;
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
                $timeEntry->duration = $timeEntry->start_time->diffInMinutes($timeEntry->end_time);
            } else {
                $timeEntry->duration = 0;
            }
        });
    }

    /**
     * Get the duration formatted as a human-readable string (e.g., '2h 30m').
     * Uses the TimeHelper utility.
     */
    public function getDurationFormattedAttribute(): string
    {
        return TimeHelper::formatDurationFromMinutes($this->duration ?? 0);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
