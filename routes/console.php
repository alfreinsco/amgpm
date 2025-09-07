<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule birthday check to run daily at 6 PM
Schedule::command('birthday:check')
    ->dailyAt('18:00')
    ->timezone('Asia/Makassar')
    ->description('Check for members with birthday tomorrow and send wishes');
