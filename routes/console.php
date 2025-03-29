<?php

use App\Console\Commands\SendWeeklyReports;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(SendWeeklyReports::class)->weekly()->sundays()->at('21:00');
