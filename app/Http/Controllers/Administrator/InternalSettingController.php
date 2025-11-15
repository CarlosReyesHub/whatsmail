<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Observers\Saas\InternalSettingObserver;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class InternalSettingController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Internal Setting Controller
    |--------------------------------------------------------------------------
    */

    protected $internalSettingObserver;

    public function __construct(InternalSettingObserver $internalSettingObserver)
    {
        $this->internalSettingObserver      = $internalSettingObserver;
    }

    /*
    |--------------------------------------------------------------------------
    | 1. System Setting Page
    |--------------------------------------------------------------------------
    */

    public function general()
    {
        $setting    = $this->internalSettingObserver->generalSetting();
        return view('admin.settings.general', ['page'  => __('page.setting.system'), 'breadcumb' => false], compact('setting'));
    }

    /*
    |--------------------------------------------------------------------------
    | 2. Website Setting Page
    |--------------------------------------------------------------------------
    */

    public function website()
    {
        $setting    = $this->internalSettingObserver->webSetting();
        return view('admin.settings.website', ['page'  => __('page.setting.website'), 'breadcumb' => false], compact('setting'));
    }

    /*
    |--------------------------------------------------------------------------
    | 3. General Setting Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $setting    = Setting::where("merchant_id", null)->first();
        return view('admin.settings.index', ['page'  => __('page.setting.general'), 'breadcumb' => false], compact('setting'));
    }

    /*
    |--------------------------------------------------------------------------
    | 4. Update To Database General Setting
    |--------------------------------------------------------------------------
    */

    public function updateGeneral(Request $request)
    {

        $this->validate($request, [
            'name'                  => 'required|string|max:200',
            'logo'                  => 'mimes:jpg,jpeg,png,svg',
            'white_logo'            => 'mimes:jpg,jpeg,png,svg',
            'icon'                  => 'mimes:jpg,jpeg,png,svg',
            'loader'                => 'mimes:jpg,jpeg,png,gif,svg',
            'tax'                   => 'required|numeric',
            'email'                 => 'required|email',
            'phone'                 => 'required',
            'currency'              => 'required',
            'currency_position'     => 'required|in:start,end'
        ]);

        $setting    = $this->internalSettingObserver->generalSetting();
        $logo       = '';
        $white      = '';
        $icon       = '';
        $loader     = '';

        if ($request->logo) {
            $this->unlinkFile($setting->logo);
            $logo   = $this->uploadImage($request, 'logo', 'settings');
        }

        if ($request->white_logo) {
            $this->unlinkFile($setting->white_logo);
            $white  = $this->uploadImage($request, 'white_logo', 'settings');
        }

        if ($request->icon) {
            $this->unlinkFile($setting->icon);
            $icon   = $this->uploadImage($request, 'icon', 'settings');
        }

        if ($request->loader) {
            $this->unlinkFile($setting->loader);
            $loader = $this->uploadImage($request, 'loader', 'settings');
        }

        $this->internalSettingObserver->generalUpdate($request, $white, $logo, $icon, $loader);

        return redirect()->back()->with(['flash'    => __('general.success_update')]);
    }


    /*
    |--------------------------------------------------------------------------
    | 5. Update To Database Website Setting
    |--------------------------------------------------------------------------
    */

    public function updateWebsite(Request $request)
    {
        $this->validate($request, [
            'copyright'             => 'required'
        ]);

        $this->internalSettingObserver->webUpdate($request);

        return redirect()->back()->with(['flash'    => __('general.success_update')]);
    }

    /*
    |--------------------------------------------------------------------------
    | 6. Update Configuration
    |--------------------------------------------------------------------------
    */

    public function updateConfiguration(Request $request)
    {
        Setting::where("merchant_id", null)->first()->update([
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

    /*
    |--------------------------------------------------------------------------
    | 7. Change for Lang
    |--------------------------------------------------------------------------
    */

    public function setLang(String $code)
    {
        Setting::where("merchant_id", null)->first()->update([
            'default_lang'      => $code
        ]);

        return redirect()->back();
    }

    /*
    |--------------------------------------------------------------------------
    | 8. Generate Api Key
    |--------------------------------------------------------------------------
    */

    public function generateApiKey()
    {

        $newApiKey      = Uuid::uuid4()->toString();

        Setting::where("merchant_id", null)->first()->update([
            'local_api_key'     => $newApiKey,
        ]);

        return response()->json([
            'message'  => $newApiKey,
        ]);
    }
}
