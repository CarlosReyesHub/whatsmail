<?php

namespace App\Http\Controllers\Whatsapp\Waba;

use App\Http\Controllers\Controller;
use App\Models\Master\MessageTemplate;
use App\Models\WhatsappKeyAccount;
use App\Observers\ChatBot\FineTunnelObserver;
use App\Observers\Master\TemplateObserver;
use App\Observers\WhatsappOfficial\WhatsappOfficialObserver;
use App\Observers\WhatsappOfficial\WhatsappOfficialServiceObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WhatsappWabaController extends Controller
{
    protected $whatsappOfficialObserver;
    protected $whatsappServiceObserver;
    protected $fineTunnelObserver;
    protected $templateObserver;

    public function __construct(WhatsappOfficialObserver $whatsappOfficialObserver, WhatsappOfficialServiceObserver $whatsappServiceObserver, FineTunnelObserver $fineTunnelObserver, TemplateObserver $templateObserver)
    {
        $this->whatsappOfficialObserver     = $whatsappOfficialObserver;
        $this->whatsappServiceObserver      = $whatsappServiceObserver;
        $this->fineTunnelObserver           = $fineTunnelObserver;
        $this->templateObserver             = $templateObserver;
    }

    /*
    |--------------------------------------------------------------------------
    | 1. Whatsapp Device List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $summary    = [
            'all'           => $this->whatsappOfficialObserver->getData($request)->count(),
            'active'        => $this->whatsappOfficialObserver->getData($request)->where('status', 'active')->count(),
            'not_active'    => $this->whatsappOfficialObserver->getData($request)->where('status', 'no_active')->count(),
        ];

        $device     = $this->whatsappOfficialObserver->getData($request)->where(function ($q) use ($request) {
            return $request->status ? $q->where("status", $request->status) : '';
        })->get();

        return view('waba.index', ['page'    => 'Waba Device', 'breadcumb' => true], compact('device', 'summary'));
    }

    /*
    |--------------------------------------------------------------------------
    | 2. Create Page
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('waba.create', ['page'   => __('page.waba.add'), 'breadcumb' => true]);
    }

    /*
    |--------------------------------------------------------------------------
    | 3. Update Auto Reply
    |--------------------------------------------------------------------------
    */

    public function autoreply(Request $request, WhatsappKeyAccount $device)
    {
        $fineTunnels    = $this->fineTunnelObserver->getData($request)->get(['name', 'id']);
        $templates      = $this->templateObserver->getData($request)->where('waba_device_id', $device->id)->get(['id', 'name', 'waba_status_template']);
        return view('waba.update.autoreply', ['page'   => __('page.waba.autoreply'), 'breadcumb' => true], compact('device', 'fineTunnels', 'templates'));
    }

    /*
    |--------------------------------------------------------------------------
    | 4. Update Webhook and Limit
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, WhatsappKeyAccount $device)
    {
        $data           = json_decode($device->meta_data, true);
        $data           = $data['whatsapp'];
        return view('waba.update.index', ['page'   => __('page.waba.general'), 'breadcumb' => true], compact('device', 'data'));
    }


    /*
    |--------------------------------------------------------------------------
    | 5. Update Greeting Message
    |--------------------------------------------------------------------------
    */

    public function greeting(Request $request, WhatsappKeyAccount $device)
    {
        $templates      = $this->templateObserver->getData($request)->where("waba_device_id", $device->id)->get(['id', 'name']);
        return view('waba.update.response', ['page'   => __('page.waba.greeting'), 'breadcumb' => true], compact('device', 'templates'));
    }

    /*
    |--------------------------------------------------------------------------
    | 6. Update Webhook and Limit
    |--------------------------------------------------------------------------
    */

    public function token(Request $request, WhatsappKeyAccount $device)
    {
        $data           = json_decode($device->meta_data, true);
        $data           = $data['whatsapp'];
        return view('waba.update.token', ['page'   => __('waba.access_token'), 'breadcumb' => true], compact('device', 'data'));
    }

    /*
    |--------------------------------------------------------------------------
    | 7. Delete Integrasi
    |--------------------------------------------------------------------------
    */

    public function deleteIntegration(WhatsappKeyAccount $device)
    {
        $config = $device->meta_data ? json_decode($device->meta_data, true) : [];

        try {

            DB::beginTransaction();

            if (isset($config['whatsapp'])) {

                $accessToken        = $config['whatsapp']['access_token'] ?? null;
                $wabaId             = $config['whatsapp']['waba_id'] ?? null;

                $response =   $this->whatsappServiceObserver->unSubscribeToWaba($wabaId, $accessToken);

                if ($response->success != true) {
                    return redirect()->back()->with(['gagal'    => $response->message]);
                }

                if (isset($config['whatsapp'])) {
                    unset($config['whatsapp']);
                }
            }

            //Delete templates
            MessageTemplate::where('waba_device_id', $device->id)->delete();
            $device->delete();

            DB::commit();
            return redirect()->route('waba')->with(['flash' => __('general.success_deleted')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['gagal'    => $e->getMessage()]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | 8. Store Data
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $this->validate($request, [
            'appid'         => 'required',
            'access_token'  => 'required',
            'phoneid'       => 'required',
            'businessid'    => 'required'
        ]);

        try {

            DB::beginTransaction();

            $metadataArray  = $this->saveWhatsappSettings(
                $request->access_token,
                $request->appid,
                $request->phoneid,
                $request->businessid
            );

            if ($metadataArray['status'] == false) {
                return redirect()->back()->with(['gagal'    => $metadataArray['message']]);
            }

            $updatedMetadataJson            = json_encode($metadataArray['data']);
            $device                         = $this->whatsappOfficialObserver->createData($request, $updatedMetadataJson);
            $this->whatsappServiceObserver->syncTemplates($request->access_token, $request->businessid, $device);

            DB::commit();
            return redirect()->route('waba')->with(['flash' => __('general.success_add_data')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['gagal'    => $e->getMessage()]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | 8. Store Data
    |--------------------------------------------------------------------------
    */

    public function saveWebHook(Request $request, WhatsappKeyAccount $device)
    {
        $this->validate($request, [
            'daily_limit'           => 'required|in:yes,no',
            'limit'                 => 'required_if:daily_limit,yes',
        ]);

        $this->whatsappOfficialObserver->setWebookAndLimit($device, $request);
        return redirect()->back()->with(['flash'    => __('general.success_update')]);
    }

    /*
    |--------------------------------------------------------------------------
    | 9. Saving Auto Reply
    |--------------------------------------------------------------------------
    */

    public function saveAutoReply(Request $request, WhatsappKeyAccount $device)
    {
        $this->validate($request, [
            'certain_day'           => 'required|in:yes,no',
            'days'                  => 'required_if:certain_day,yes',
            'certain_time'          => 'required|in:yes,no',
            'start_time'            => 'required_if:certain_time,yes',
            'end_time'              => 'required_if:certain_time,yes',
            'method'                => 'required|in:ai,chatbot',
            'tunnel'                => 'required_if:method,ai',
            'auto_read_chatbot'     => 'required|in:yes,no',
        ]);

        $this->whatsappOfficialObserver->updateData($request, $device);
        return redirect()->back()->with(['flash'    => __('general.success_update')]);
    }


    /*
    |--------------------------------------------------------------------------
    | 10. Saving Greeting
    |--------------------------------------------------------------------------
    */

    public function saveGreeting(Request $request, WhatsappKeyAccount $device)
    {
        $this->validate($request, [
            'reply_chat'        => 'required|in:yes,no',
            'reply_method'      => 'required|in:template,text',
            'reply_template'    => 'required_if:reply_method,template',
            'reply_text'        => 'required_if:reply_method,text',
        ]);

        $this->whatsappOfficialObserver->setAutoReply($device, $request);
        return redirect()->back()->with(['flash'    => __('general.success_update')]);
    }


    /*
    |--------------------------------------------------------------------------
    | 11. Saving Token
    |--------------------------------------------------------------------------
    */

    public function saveToken(Request $request, WhatsappKeyAccount $device)
    {

        $this->validate($request, [
            'token'             => 'required'
        ]);

        $config = $device->meta_data;
        $config = $config ? json_decode($config, true) : [];

        $metadataArray = $this->saveWhatsappSettings(
            $request->token,
            $config['whatsapp']['app_id'] ?? null,
            $config['whatsapp']['phone_number_id'] ?? null,
            $config['whatsapp']['waba_id'] ?? null
        );

        if ($metadataArray['status'] == false) {
            return redirect()->back()->with(['gagal'    => $metadataArray['message']]);
        }

        $device->update([
            'meta_data'     => $metadataArray['data']
        ]);

        return redirect()->back()->with(['flash'    => __('general.success_update')]);
    }

    /*
    |--------------------------------------------------------------------------
    | 12. Refresh Whatsapp
    |--------------------------------------------------------------------------
    */

    public function refresh(WhatsappKeyAccount $device)
    {
        $config = $device->meta_data;
        $config = $config ? json_decode($config, true) : [];

        $metadataArray = $this->saveWhatsappSettings(
            $config['whatsapp']['access_token'] ?? null,
            $config['whatsapp']['app_id'] ?? null,
            $config['whatsapp']['phone_number_id'] ?? null,
            $config['whatsapp']['waba_id'] ?? null
        );

        if ($metadataArray['status'] == false) {
            return redirect()->back()->with(['gagal'    => $metadataArray['message']]);
        }

        $device->update([
            'meta_data'     => $metadataArray['data']
        ]);

        return redirect()->back()->with(['flash'    => __('general.success_update')]);
    }


    /*
    |--------------------------------------------------------------------------
    | 13. Get Meta Data
    |--------------------------------------------------------------------------
    */

    public function saveWhatsappSettings($accessToken, $appId, $phoneId, $wabaID)
    {
        $phoneNumberResponse = $this->whatsappServiceObserver->getPhoneNumberId($accessToken, $wabaID);
        if (!$phoneNumberResponse->success) {
            return array(
                'status'    => false,
                'message'   => $phoneNumberResponse->data->error->message
            );
        }

        //Get Phone Number Status
        $phoneNumberStatusResponse = $this->whatsappServiceObserver->getPhoneNumberStatus($accessToken, $phoneNumberResponse->data->id);
        if (!$phoneNumberStatusResponse->success) {
            return array(
                'status'    => false,
                'message'   => $phoneNumberStatusResponse->data->error->message
            );
        }

        //Get Account Review Status
        $accountReviewStatusResponse = $this->whatsappServiceObserver->getAccountReviewStatus($accessToken, $wabaID);
        if (!$accountReviewStatusResponse->success) {
            return array(
                'status'    => false,
                'message'   => $accountReviewStatusResponse->data->error->message
            );
        }

        //Get business profile
        $businessProfileResponse = $this->whatsappServiceObserver->getBusinessProfile($accessToken, $phoneNumberResponse->data->id);
        if (!$businessProfileResponse->success) {
            return array(
                'status'    => false,
                'message'   => $businessProfileResponse->data->error->message
            );
        }


        $metadataArray['whatsapp']['is_embedded_signup']    = $metadataArray['whatsapp']['is_embedded_signup'] ?? 0;
        $metadataArray['whatsapp']['access_token']          = $accessToken;
        $metadataArray['whatsapp']['app_id']                = $appId;
        $metadataArray['whatsapp']['waba_id']               = $wabaID;
        $metadataArray['whatsapp']['phone_number_id']       = $phoneNumberResponse->data->id;
        $metadataArray['whatsapp']['display_phone_number']  = $phoneNumberResponse->data->display_phone_number;
        $metadataArray['whatsapp']['verified_name']         = $phoneNumberResponse->data->verified_name;
        $metadataArray['whatsapp']['quality_rating']        = $phoneNumberResponse->data->quality_rating;
        $metadataArray['whatsapp']['name_status']           = $phoneNumberResponse->data->name_status;
        $metadataArray['whatsapp']['messaging_limit_tier']  = $phoneNumberResponse->data->messaging_limit_tier ?? NULL;
        $metadataArray['whatsapp']['max_daily_conversation_per_phone'] = NULL;
        $metadataArray['whatsapp']['max_phone_numbers_per_business'] = NULL;
        $metadataArray['whatsapp']['number_status']         = $phoneNumberStatusResponse->data->status;
        $metadataArray['whatsapp']['business_verification'] = '';
        $metadataArray['whatsapp']['account_review_status'] = $accountReviewStatusResponse->data->account_review_status;
        $metadataArray['whatsapp']['business_profile']['about']         = $businessProfileResponse->data->about ?? NULL;
        $metadataArray['whatsapp']['business_profile']['address']       = $businessProfileResponse->data->address ?? NULL;
        $metadataArray['whatsapp']['business_profile']['description']   = $businessProfileResponse->data->description ?? NULL;
        $metadataArray['whatsapp']['business_profile']['industry']      = $businessProfileResponse->data->vertical ?? NULL;
        $metadataArray['whatsapp']['business_profile']['email']         = $businessProfileResponse->data->email ?? NULL;

        return array(
            'status'    => true,
            'data'      => $metadataArray
        );
    }
}
