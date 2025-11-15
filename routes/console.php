<?php

use App\Jobs\FineTunnelStatusCheckJob;
use App\Jobs\ResetWhatsappDailySendJob;
use App\Jobs\ScrappingGmapsJob;
use App\Jobs\SendEmailJob;
use App\Jobs\SendPromotionEmailJob; 
use App\Jobs\SendWhatsappJob;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new SendWhatsappJob)->everyMinute();
// Schedule::job(new SendPromotionWhatsappJob)->everyMinute();
// Schedule::jon(new SendPromotionWhatsappWithDelayJob)->everyMinute();
Schedule::job(new ScrappingGmapsJob)->everyMinute();
Schedule::job(new SendEmailJob)->everyMinute();
Schedule::job(new SendPromotionEmailJob)->everyMinute();
Schedule::job(new ResetWhatsappDailySendJob)->dailyAt('00:00');
Schedule::job(new FineTunnelStatusCheckJob)->everyTwoHours();
