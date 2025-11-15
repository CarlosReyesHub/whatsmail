<?php

namespace App\Http\Controllers;

use App\Observers\Saas\InternalSettingObserver;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    protected $internalSettingObserver;

    public function __construct(InternalSettingObserver $internalSettingObserver)
    {
        $this->internalSettingObserver      = $internalSettingObserver;
    }

    public function system()
    {
        $setting    = $this->internalSettingObserver->generalSetting();
        return response()->json([
            'name'          => $setting->app_name,
            'server_url'    => env('WHATSAPP_SERVER_URL'),
            'icon'          => asset($setting->icon)
        ], 200);
    }
}
