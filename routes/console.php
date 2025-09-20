<?php

use App\Console\Commands\UserCheckExpiration;
use Illuminate\Support\Facades\Schedule;

Schedule::command(UserCheckExpiration::class)->everyTenMinutes();
