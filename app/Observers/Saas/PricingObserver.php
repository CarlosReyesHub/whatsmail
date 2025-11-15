<?php

namespace App\Observers\Saas;

use App\Models\Package\Package;
use App\Models\Package\PackageDetail;
use Illuminate\Http\Request;

class PricingObserver
{
    public function getData(Request $request)
    {
        return Package::where(function ($q) use ($request) {
            return $request->name ? $q->where('name', 'like', '%' . $request->name . '%') : '';
        })->orderBy('created_at', 'desc');
    }

    public function createData(Request $request)
    {
        return Package::create([
            'name'                          => $request->name,
            'price'                         => $request->trial_version == 'yes' ? 0 : $request->price,
            'add_days'                      => $request->add_days,
            'trial_version'                 => $request->trial_version,
            'limit_user_option'             => $request->limit_user_option,
            'users_limit'                   => $request->limit_user_option == 'yes' ? $request->users_limit : 0,
            'limit_whatsapp_option'         => $request->limit_whatsapp_option,
            'limit_whatsapp_priode'         => $request->limit_whatsapp_priode ?? 'daily',
            'whatsapp_limit'                => $request->limit_whatsapp_option == 'yes' ? $request->whatsapp_limit : 0,
            'limit_email_option'            => $request->limit_email_option,
            'limit_email_priode'            => $request->limit_email_priode ?? 'daily',
            'email_limit'                   => $request->limit_email_option == 'yes' ? $request->email_limit : 0,
            'limit_scrapp_option'           => $request->limit_scrapp_option,
            'limit_scrapp_priode'           => $request->limit_scrapp_priode ?? 'daily',
            'scrapp_limit'                  => $request->limit_scrapp_option == 'yes' ? $request->scrapp_limit : 0,
            'limit_device'                  => $request->limit_device,
            'device_limit'                  => $request->limit_device == 'yes' ? $request->device_limit : 0,
            'limit_template'                => $request->limit_template,
            'template_limit'                => $request->limit_template == 'yes' ? $request->template_limit : 0,
            'limit_ai_training'             => $request->limit_ai_training,
            'ai_training_limit'             => $request->limit_ai_training == 'yes' ? $request->ai_training_limit : 0,
            'limit_chatbot'                 => $request->limit_chatbot,
            'chatbot_limit'                 => $request->limit_chatbot == 'yes' ? $request->chatbot_limit : 0,
        ]);
    }

    public function updateData(Request $request, Package $package)
    {
        $package->update([
            'name'                          => $request->name,
            'price'                         => $request->trial_version == 'yes' ? 0 : $request->price,
            'add_days'                      => $request->add_days,
            'trial_version'                 => $request->trial_version,
            'limit_user_option'             => $request->limit_user_option,
            'users_limit'                   => $request->limit_user_option == 'yes' ? $request->users_limit : 0,
            'limit_whatsapp_option'         => $request->limit_whatsapp_option,
            'limit_whatsapp_priode'         => $request->limit_whatsapp_priode ?? 'daily',
            'whatsapp_limit'                => $request->limit_whatsapp_option == 'yes' ? $request->whatsapp_limit : 0,
            'limit_email_option'            => $request->limit_email_option,
            'limit_email_priode'            => $request->limit_email_priode ?? 'daily',
            'email_limit'                   => $request->limit_email_option == 'yes' ? $request->email_limit : 0,
            'limit_scrapp_option'           => $request->limit_scrapp_option,
            'limit_scrapp_priode'           => $request->limit_scrapp_priode ?? 'daily',
            'scrapp_limit'                  => $request->limit_scrapp_option == 'yes' ? $request->scrapp_limit : 0,
            'limit_device'                  => $request->limit_device,
            'device_limit'                  => $request->limit_device == 'yes' ? $request->device_limit : 0,
            'limit_template'                => $request->limit_template,
            'template_limit'                => $request->limit_template == 'yes' ? $request->template_limit : 0,
            'limit_ai_training'             => $request->limit_ai_training,
            'ai_training_limit'             => $request->limit_ai_training == 'yes' ? $request->ai_training_limit : 0,
            'limit_chatbot'                 => $request->limit_chatbot,
            'chatbot_limit'                 => $request->limit_chatbot == 'yes' ? $request->chatbot_limit : 0,
        ]);
    }

    public function createDetails(Request $request, Package $package)
    {

        $package->details()->delete();

        $i  = 0;
        while ($i < count($request->name)) {
            PackageDetail::create([
                'package_id'        => $package->id,
                'name'              => $request->detail_name[$i],
                'status'            => $request->detail_status[$i],
            ]);

            $i++;
        }
    }


    public function deleteData(Package $package)
    {
        $package->details()->delete();
        $package->delete();
    }
}
