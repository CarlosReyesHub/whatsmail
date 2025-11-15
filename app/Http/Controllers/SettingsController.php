<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class SettingsController extends Controller
{

    public function index()
    {
        $setting    = Setting::first();
        return view('settings', ['page'  => __('page.configuration'), 'breadcumb' => true], compact('setting'));
    }

    public function updateConfiguration(Request $request)
    {
        Setting::first()->update([
            'gmap_key'              => $request->gmap_key,
            'whatsapp_sender_notif' => $request->whatsapp_sender_notif,
            'mail_host'             => $request->mail_host,
            'mail_port'             => $request->mail_port,
            'mail_username'         => $request->mail_username,
            'mail_password'         => $request->mail_password,
            'mail_from_address'     => $request->mail_from_address,
            'mail_encryption'       => $request->mail_encryption,
            'mail_from_name'        => $request->mail_from_name,
            'timezone'              => $request->timezone,
            'scrapp_phone'          => $request->scrapp_phone,
            'scrapp_phone_whatsapp' => $request->scrapp_phone_whatsapp,
            'phone_country_code'    => $request->phone_country_code,
            'default_lang'          => $request->default_lang,
            'open_ai_key'           => $request->open_ai_key,
            'api_device_use'        => $request->api_device_use,
            'ai_option'             => $request->ai_option,
            'google_text_to_audio'  => $request->google_text_to_audio
        ]);

        return redirect()->back()->with(['flash'    => __('general.success_update')]);
    }

    public function setLang(String $code)
    {

        Setting::withoutGlobalScopes()->where('merchant_id', auth()->user()->merchant_id)->first()->update([
            'default_lang'      => $code
        ]);

        return redirect()->back();
    }

    public function generateApiKey()
    {

        $newApiKey      = Uuid::uuid4()->toString();
        Setting::first()->update([
            'local_api_key'     => $newApiKey,
        ]);

        return response()->json([
            'message'  => $newApiKey,
        ]);
    }
}
