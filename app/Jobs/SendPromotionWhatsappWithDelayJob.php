<?php

namespace App\Jobs;

use App\Models\Blash\BlashDetail;
use App\Models\Log;
use App\Models\Setting;
use App\Models\WhatsappDevice;
use App\Models\WhatsappKeyAccount;
use App\Observers\WhatsappOfficial\WhatsappOfficialServiceObserver;
use App\Observers\WhatsappOfficial\WhatsappTemplateServiceObserver;
use App\Observers\WhatsappServiceObserver;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendPromotionWhatsappWithDelayJob implements ShouldQueue
{
    use Queueable;
    protected $blast;

    /**
     * Create a new job instance.
     */

    public function __construct(BlashDetail $blast)
    {
        $this->blast        = $blast;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $settings   = Setting::where("merchant_id", ($this->blast->store->merchant_id ?? null))->first(['whatsapp_sender', 'whatsapp_sender_notif', 'merchant_id']);
        $log        = Log::create([
            'description'   => __('blash.blash_description', [
                'name'          => $this->blast->store->name ?? '',
                'schedule'      => $this->blast->parent->name ?? ''
            ]),
            'merchant_id'   => $this->blast->store->merchant_id ?? null,
            'type'          => 'whatsapp'
        ]);

        if (!$settings) {
            $log->update([
                'status'        => 'error',
                'error'         => 'Tidak dapat mendeteksi pengaturan'
            ]);
        }

        if ($this->blast->store->merchant_id != null) {

            $merchant   = $this->blast->store->merchant ?? null;
            if ($settings != null && $merchant != null) {
                $transaction = $merchant->package_active;
                if (!$transaction) {

                    $this->blast->update([
                        'status'        => 'yes',
                        'reports'       => 'Paket Langganan telah Berakhir'
                    ]);

                    $log->update([
                        'status'        => 'error',
                        'error'         => 'Paket Langganan telah Berakhir'
                    ]);
                }

                if ($transaction->limit_whatsapp_option == 'yes') {
                    if ($settings->whatsapp_sender >= $transaction->whatsapp_limit) {
                        $this->blast->update([
                            'status'        => 'yes',
                            'reports'       => 'Limit Pengiriman Harian Telah Habi'
                        ]);

                        $log->update([
                            'status'        => 'error',
                            'error'         => 'Limit Pengiriman harian telah habis'
                        ]);
                    }
                }
            }
        }

        $settings->update([
            'whatsapp_sender'       => $settings->whatsapp_sender + 1
        ]);

        $whatsappNotificationObserver   = new WhatsappOfficialServiceObserver();
        $whatsappServiceObserver        = new WhatsappServiceObserver();
        $whatsappTemplateObserver       = new WhatsappTemplateServiceObserver();

        $storeName      = $this->blast->store->name ?? '';
        $categoryName   = $this->blast->store->category->name ?? '';
        $phone          = $this->blast->phone ?? '';
        $email          = $this->blast->email ?? '';
        $address        = $this->blast->store->address ?? '';
        $message        = $this->blast->parent->template->message ?? null;
        $wabaOfficial   = $this->blast->parent->waba ?? 'no';

        if ($message != null) {

            $message = str_replace(
                ['{store}', '{category}', '{phone}', '{email}', '{address}'],
                [$storeName, $categoryName, $phone, $email, $address],
                $message
            );

            $whatsappAccounts   = $wabaOfficial == 'yes' ?  WhatsappKeyAccount::where(function ($q) {
                return $q->whereRaw('daily_send < limit_per_day')->orWhere("daily_limit", "no");
            })->where('id', $this->blast->parent->waba_id)->where("status", "active") : WhatsappDevice::where(function ($q) {
                return $q->whereRaw('daily_send < limit_per_day')->orWhere("daily_limit", "no");
            })->where("merchant_id", $settings->merchant_id)->where("status", "active");

            $messageVariable = array(
                'message'           => urldecode($message),
                'template_body'     => array(),
                'whatsapp_key'      => '',
                'whatsapp_session'  => '',
                'file'              => $this->blast->parent->template->image != null ? asset($this->blast->parent->template->image) : '',
                'phone'             => $this->blast->store->phone ?? null,
                'type'              => $this->blast->parent->template->type_content ?? 'description',
                'datas'             => json_decode($this->blast->parent->template->button_or_list, true)
            );

            $status = false;

            if ($wabaOfficial == 'no') {
                if ($settings->whatsapp_sender_notif === 'sequence') {
                    if ($whatsappAccounts->count() > 0) {
                        $account                                = $whatsappAccounts->first();
                        $messageVariable['whatsapp_key']        = $account->id;
                        $messageVariable['whatsapp_session']    = $account->id;
                        $account->daily_send                    += 1;
                        $account->save();
                        $status = true;
                    }
                } elseif ($settings->whatsapp_sender_notif === 'spin') {
                    if ($whatsappAccounts->count() > 0) {
                        $accountData                            = collect($whatsappAccounts->get())->shift();
                        $account                                = $whatsappAccounts->where("id", $accountData->id)->first();
                        $messageVariable['whatsapp_key']        = $account->id;
                        $messageVariable['whatsapp_session']    = $account->id;
                        $account->daily_send += 1;
                        $account->save();
                        $status = true;
                    }
                } elseif ($settings->whatsapp_sender_notif === 'random') {
                    if ($whatsappAccounts->count() > 0) {
                        $accountData                            = collect($whatsappAccounts->get())->random();
                        $account                                = $whatsappAccounts->where("id", $accountData->id)->first();
                        $messageVariable['whatsapp_key']        = $account->id;
                        $messageVariable['whatsapp_session']    = $account->id;
                        $account->daily_send += 1;
                        $account->save();
                        $status = true;
                    }
                }
            } else {
                $account                                = $whatsappAccounts->first();
                $config                                 = $account->meta_data;
                $config                                 = $config ? json_decode($config, true) : [];
                unset($messageVariable);
                $messageVariable['appid']               =  $config['whatsapp']['app_id'] ?? null;
                $messageVariable['phoneid']             =  $config['whatsapp']['phone_number_id'] ?? null;
                $messageVariable['wabaid']              =  $config['whatsapp']['waba_id'] ?? null;
                $messageVariable['access_token']        =  $config['whatsapp']['access_token'] ?? null;
                $account->daily_send                    += 1;
                $account->save();
                $status = true;
            }


            if ($status == true) {
                if ($phone != '') {

                    if ($wabaOfficial == 'yes') {
                        $templateBuilder    = $whatsappTemplateObserver->buildTemplate($this->blast->parent);
                        $result             = $whatsappNotificationObserver->sendTemplateMessage($this->blast->store, $templateBuilder, $messageVariable);

                        if ($result['status'] == 200) {
                            $this->blast->update([
                                'status'    => 'yes',
                                'sending'   => now()->format('Y-m-d H:i:s'),
                                'phone'     => $this->blast->store->phone ?? '',
                                'device_id' => $account->id,
                                'reports'   => null
                            ]);

                            $log->update([
                                'status'    => 'success',
                                'store_id'  => $this->blast->store_id,
                                'sending'   => now()->format('Y-m-d H:i:s'),
                                'device_id' => $account->id,
                            ]);
                        } else {

                            $this->blast->update([
                                'status'        => 'yes',
                                'sending'       => now()->format('Y-m-d H:i:s'),
                                'phone'         => $this->blast->store->phone ?? '',
                                'device_id'     => $account->id,
                                'sending_status' => 'no',
                                'reports'       => $result['message']
                            ]);

                            $log->update([
                                'status'        => 'error',
                                'store_id'      => $this->blast->store_id,
                                'sending'       => now()->format('Y-m-d H:i:s'),
                                'device_id'     => $account->id,
                                'error'         => $result['message']
                            ]);
                        }
                    } else {
                        $result = $whatsappServiceObserver->sendMessage($phone, $messageVariable['whatsapp_key'], $messageVariable['message'], $messageVariable['file'], $messageVariable['type'], $messageVariable['datas']);

                        if ($result['status'] == 200) {
                            $this->blast->update([
                                'status'    => 'yes',
                                'sending'   => now()->format('Y-m-d H:i:s'),
                                'phone'     => $this->blast->store->phone ?? '',
                                'text'      => $messageVariable['message'],
                                'device_id' => $messageVariable['whatsapp_session'],
                                'reports'   => null
                            ]);

                            $log->update([
                                'status'    => 'success',
                                'store_id'  => $this->blast->store_id,
                                'sending'   => now()->format('Y-m-d H:i:s'),
                                'text'      => $messageVariable['message'],
                                'device_id' => $messageVariable['whatsapp_session'],
                            ]);
                        } else {
                            $this->blast->update([
                                'status'        => 'yes',
                                'sending'       => now()->format('Y-m-d H:i:s'),
                                'phone'     => $this->blast->store->phone ?? '',
                                'text'          => $messageVariable['message'],
                                'device_id'     => $messageVariable['whatsapp_session'],
                                'sending_status' => 'no',
                                'reports'       => $result['message']
                            ]);

                            $log->update([
                                'status'        => 'error',
                                'store_id'      => $this->blast->store_id,
                                'sending'       => now()->format('Y-m-d H:i:s'),
                                'text'          => $messageVariable['message'],
                                'device_id'     => $messageVariable['whatsapp_session'],
                                'error'         => $result['message']
                            ]);
                        }
                    }
                } else {
                    $this->blast->update([
                        'status'        => 'yes',
                        'sending'       => now()->format('Y-m-d H:i:s'),
                        'phone'         => $this->blast->store->phone ?? '',
                        'text'          => $messageVariable['message'],
                        'sending_status' => 'no',
                        'device_id'     => $messageVariable['whatsapp_session'],
                        'reports'       => __('blash.phone_nothing')
                    ]);

                    $log->update([
                        'status'        => 'error',
                        'store_id'      => $this->blast->store_id,
                        'sending'       => now()->format('Y-m-d H:i:s'),
                        'text'          => $messageVariable['message'],
                        'device_id'     => $messageVariable['whatsapp_session'],
                        'error'         => __('blash.wa_not_registered')
                    ]);
                }
            } else {
                $log->update([
                    'status'        => 'error',
                    'store_id'      => $this->blast->store_id,
                    'sending'       => now()->format('Y-m-d H:i:s'),
                    'text'          => $messageVariable['message'],
                    'error'         => __('blash.daily_limit')
                ]);
            }
        }
    }
}
