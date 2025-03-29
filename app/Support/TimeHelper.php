<?php

namespace App\Support;

class TimeHelper
{
    /**
     * Format duration in minutes into a human-readable string (e.g., '2h 30m').
     */
    public static function formatDurationFromMinutes(int $totalMinutes): string
    {
        if ($totalMinutes <= 0) {
            return '0m';
        }

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        $formatted = '';
        if ($hours > 0) {
            $formatted .= $hours.'h';
        }

        if ($minutes > 0) {
            $formatted .= ($hours > 0 ? ' ' : '').$minutes.'m'; // Add space only if hours exist
        }

        return $formatted;
    }
}
