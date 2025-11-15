<?php

namespace App\Jobs;

use App\Models\Blash\BlashDetail;
use App\Models\Blash\BlashWhatsapp;
use App\Models\Store\Store;
use Illuminate\Support\Carbon;

class SendWhatsappJob
{



    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $schedules   = BlashWhatsapp::where("use", "whatsapp")->where("status", "pending")->where("schedule", "<=", now())->orderBy('created_at', 'asc')->get();

        foreach ($schedules as $schedulingPromotions) {
            $delay              = $schedulingPromotions->delay;
            $getStores          = Store::where(function ($q) use ($schedulingPromotions) {
                return $schedulingPromotions->category_id != null ? $q->where("category_id", $schedulingPromotions->category_id) : '';
            })->where(function ($q) use ($schedulingPromotions) {
                return $schedulingPromotions->district_id != null ? $q->where("district_id", $schedulingPromotions->district_id) : '';
            })->where(function ($q) use ($schedulingPromotions) {
                return $schedulingPromotions->city_id != null ? $q->whereHas("district", function ($q) use ($schedulingPromotions) {
                    return $q->where("city_id", $schedulingPromotions->city_id);
                }) : '';
            })->where("phone", "!=", null)->where("status", "no")->orderBy('name', 'asc')->get();

            $lastShceduleOn    = BlashDetail::where("status", "no")->whereHas('parent', function ($q) use ($schedulingPromotions) {
                return $q->where("use", 'whatsapp');
            })->whereHas('parent', function ($q) use ($schedulingPromotions) {
                $q->where('merchant_id', $schedulingPromotions->merchant_id)->orWhere('merchant_id', null);
            })->orderBy('schedule', 'desc')->first(['schedule']);

            $last   = now();
            $number = 1;
            if ($lastShceduleOn) {
                if ($lastShceduleOn->schedule != null) {
                    $last = Carbon::parse($lastShceduleOn->schedule); // Convert to Carbon instance
                }
            }

            foreach ($getStores as $store) {
                $timeToDelay    = ($number++ * $delay); // Increment delay for each store
                $schedule       = $last->copy()->addSeconds($timeToDelay); // New scheduled time for each message

                $message = BlashDetail::firstOrCreate(
                    [
                        'blash_whatsapp_id' => $schedulingPromotions->id,
                        'store_id'          => $store->id
                    ],
                    [
                        'phone'     => $store->phone,
                        'status'    => 'no',
                        'schedule'  => $schedule->format('Y-m-d H:i:s')
                    ]
                );

                dispatch(new SendPromotionWhatsappWithDelayJob($message))
                    ->delay($schedule); // delay the job
            }

            $schedulingPromotions->update([
                'status'        => 'success'
            ]);
        }
    }
}
