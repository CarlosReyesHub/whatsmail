<?php

namespace App\Jobs;

use App\Models\Log;
use App\Models\Setting;
use App\Models\Store\Scrapping;
use App\Observers\Store\StoreScrappingObserver; 

class ScrappingGmapsJob 
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
        $schedulingScrapping   = Scrapping::where("status", "pending")->where("schedule", "<=", now())->orderBy('created_at', 'asc')->first();


        if ($schedulingScrapping) {


            $log = Log::create([
                'description'   => __('scrapp.start_scrapping', [
                    'name'          => $schedulingScrapping->name
                ]),
                'type'          => 'scrapping',
                'merchant_id'   => $schedulingScrapping->merchant_id ?? null,
            ]);

            $setting    = Setting::where("merchant_id", $schedulingScrapping->merchant_id)->first(['scrapp_counter']);

            if ($schedulingScrapping->merchant_id != null) {
               
                $merchant   = $schedulingScrapping->merchant ?? null;
                if ($setting != null && $merchant != null) {
                    $transaction = $merchant->package_active;
                    if (!$transaction) {

                        $schedulingScrapping->update([
                            'status'        => 'success', 
                        ]);

                        $log->update([
                            'status'        => 'error',
                            'error'         => 'Paket Langganan telah Berakhir'
                        ]);
                    }

                    if ($transaction->limit_scrapp_option == 'yes') {
                        if ($setting->scrapp_counter >= $transaction->scrapp_limit) {
                            $schedulingScrapping->update([
                                'status'        => 'success'
                            ]);

                            $log->update([
                                'status'        => 'error',
                                'error'         => 'Limit Scrapping harian telah habis'
                            ]);
                        }
                    }
                }
            }


            try {

                $scrappingObserver = new StoreScrappingObserver();
                $scrappingProcess = $scrappingObserver->scrappingData($schedulingScrapping);

                if ($scrappingProcess == true) {
                    $schedulingScrapping->update([
                        'status'        => 'success'
                    ]);

                    $log->update([
                        'status'    => 'success'
                    ]);
                } else {

                    $log->update([
                        'error'     => __('scrapp.error_api_key'),
                        'status'    => 'error'
                    ]);
                }
            } catch (\Exception $e) {
                $log->update([
                    'error'     => $e->getMessage(),
                    'status'    => 'error'
                ]);
            }
        }
    }
}
