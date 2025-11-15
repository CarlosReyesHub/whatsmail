<?php

namespace App\Http\Controllers\Whatsapp\Waba;

use App\Http\Controllers\Controller;
use App\Http\Requests\Whatsapp\Official\TemplateRequest;
use App\Models\Master\MessageTemplate;
use App\Models\WhatsappKeyAccount;
use App\Observers\Master\TemplateObserver;
use App\Observers\WhatsappOfficial\WhatsappOfficialServiceObserver;
use App\Observers\WhatsappOfficial\WhatsappTemplateServiceObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WhatsappTemplateController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Message Template
    |--------------------------------------------------------------------------
    */

    protected $templateObserver;
    protected $templateServiceObserver;
    protected $whatsappServiceObserver;

    public function __construct(TemplateObserver $templateObserver, WhatsappTemplateServiceObserver $templateServiceObserver, WhatsappOfficialServiceObserver $whatsappServiceObserver)
    {
        $this->templateObserver             = $templateObserver;
        $this->templateServiceObserver      = $templateServiceObserver;
        $this->whatsappServiceObserver      = $whatsappServiceObserver;
    }

    /*
    |--------------------------------------------------------------------------
    | 1. List Template Page
    |--------------------------------------------------------------------------
    */

    public function index(Request $request, WhatsappKeyAccount $device)
    {
        $templates     = $this->templateObserver->getData($request)->where('type', 'whatsapp')->where("waba_device_id", $device->id)->where("for_waba", 'yes')->get(['id', 'name', 'image', 'type_content', 'category', 'lang', 'waba_status_template']);
        return view('waba.template.index', ['page' => __('page.template.page'), 'breadcumb' => true], compact('templates', 'device'));
    }

    /*
    |--------------------------------------------------------------------------
    | 2. Create Template Page
    |--------------------------------------------------------------------------
    */

    public function create(WhatsappKeyAccount $device)
    {
        return view('waba.template.create', ['page' => __('page.template.add'), 'breadcumb' => true], compact('device'));
    }

    /*
    |--------------------------------------------------------------------------
    | 3. Update Template Page
    |--------------------------------------------------------------------------
    */

    public function update(WhatsappKeyAccount $device, MessageTemplate $template)
    {
        return view('waba.template.update', ['page' => __('page.template.update'), 'breadcumb' => true], compact('device'));
    }

    /*
    |--------------------------------------------------------------------------
    | 4. Store Template Data
    |--------------------------------------------------------------------------
    */

    public function store(TemplateRequest $request, WhatsappKeyAccount $device)
    {

        $validationCheck = $this->templateObserver->checkLimit();

        if ($validationCheck == false) {
            return response([
                'status'    => false,
                'message'   =>  __('validation.template_limit')
            ], 422);
        }


        $template = $this->templateServiceObserver->createData($request, $device);

        if ($template['status'] == false) {
            return response([
                'status'    => false,
                'message'   => $template['message']
            ], 422);
        } else {
            return response([
                'status'    => false,
                'message'   => __('general.success_add_data')
            ], 200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | 5. Update Template Data
    |--------------------------------------------------------------------------
    */

    public function edit(TemplateRequest $request, WhatsappKeyAccount $device,  MessageTemplate $template)
    {


        $template = $this->templateServiceObserver->updateData($request, $device, $template);

        if ($template['status'] == false) {
            return response([
                'status'    => false,
                'message'   => $template['message']
            ], 422);
        } else {
            return response([
                'status'    => false,
                'message'   => __('general.success_update')
            ], 200);
        } 
 
    }

    /*
    |--------------------------------------------------------------------------
    | 6. Delete Template Data
    |--------------------------------------------------------------------------
    */

    public function delete(WhatsappKeyAccount $device, MessageTemplate $template)
    {
        $response = $this->templateServiceObserver->deleteTemplate($template, $device);
        if (!$response->success) {
            return redirect()->back()->with(['gagal'    => $response->message]);
        }

        return redirect()->back()->with(['flash'    => __('general.success_deleted')]);
    }

    /*
    |--------------------------------------------------------------------------
    | 8. Syncronize Data
    |--------------------------------------------------------------------------
    */

    public function syncData(Request $request, WhatsappKeyAccount $device)
    {

        try {

            DB::beginTransaction();

            $config = $device->meta_data;
            $config = $config ? json_decode($config, true) : [];

            $response = $this->whatsappServiceObserver->syncTemplates($config['whatsapp']['access_token'], $config['whatsapp']['waba_id'], $device);

            if ($response->success == false) {
                return redirect()->back()->with(['gagal'    => $response->message]);
            }

            DB::commit();
            return redirect()->back()->with(['flash' => __('general.success_add_data')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['gagal'    => $e->getMessage()]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | 9. Get Details
    |--------------------------------------------------------------------------
    */

    public function details(WhatsappKeyAccount $device, MessageTemplate $template)
    {
        return response([
            'status'    => true,
            'id'        => $template->id,
            'meta_id'   => $template->meta_id,
            'meta'      => array(
                'name'      => $template->name,
                'category'  => $template->category,
                'lang'      => $template->lang,
            ),
            'details'   => json_decode($template->message, true)
        ], 200);
    }
}
