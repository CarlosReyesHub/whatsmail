<?php

namespace App\Http\Controllers\Whatsapp\Waba;

use App\Http\Controllers\Controller;
use App\Http\Resources\Waba\Broadcast\BroadcastDetailResource;
use App\Models\Blash\BlashWhatsapp;
use App\Models\WhatsappKeyAccount;
use App\Observers\Blash\BlashDetailObserver;
use App\Observers\Blash\BlashWhatsappObserver;
use App\Observers\WhatsappOfficial\WhatsappBroadcastObserver;
use App\Observers\WhatsappOfficial\WhatsappOfficialServiceObserver;
use App\Observers\WhatsappOfficial\WhatsappTemplateServiceObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WhatsappBroadcastController extends Controller
{

    protected $whatsappBroadcastOberver;
    protected $whatsappTemplateObserver;
    protected $whatsappServiceObserver;
    protected $blastObserver;
    protected $blastDetailObserver;

    public function __construct(
        WhatsappBroadcastObserver $whatsappBroadcastOberver,
        WhatsappTemplateServiceObserver $whatsappTemplateObserver,
        WhatsappOfficialServiceObserver $whatsappServiceObserver,
        BlashWhatsappObserver $blastObserver,
        BlashDetailObserver $blastDetailObserver
    ) {
        $this->whatsappBroadcastOberver     = $whatsappBroadcastOberver;
        $this->whatsappTemplateObserver     = $whatsappTemplateObserver;
        $this->whatsappServiceObserver      = $whatsappServiceObserver;
        $this->blastObserver                = $blastObserver;
        $this->blastDetailObserver          = $blastDetailObserver;
    }

    /*
    |--------------------------------------------------------------------------
    | 1. Broadcast List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request, WhatsappKeyAccount $device)
    {
        $broadcast     = $this->whatsappBroadcastOberver->getData($request, $device->id)->get();
        return view('waba.broadcast.index', ['page'    => __('page.wa.page'), 'breadcumb' => true], compact('broadcast', 'device'));
    }

    /*
    |--------------------------------------------------------------------------
    | 2. Create Broadcast
    |--------------------------------------------------------------------------
    */

    public function create(WhatsappKeyAccount $device)
    {
        return view('waba.broadcast.create', ['page'   => __('page.wa.add'), 'breadcumb' => true], compact('device'));
    }

    /*
    |--------------------------------------------------------------------------
    | 3. Create Data
    |--------------------------------------------------------------------------
    */

    public function store(WhatsappKeyAccount $device, Request $request)
    {
        $this->validate($request, [
            'category'          => 'required',
            'name'              => 'required',
            'schedule'          => 'required',
            'template'          => 'required',
            'metadata'          => 'required'
        ]);


        try {

            DB::beginTransaction();

            $files  = '';
            if ($request->has('files')) {
                $files  = $this->uploadImage($request, 'files', 'template');
            }

            $this->whatsappBroadcastOberver->createData($request, $device->id, $files);

            DB::commit();

            return response()->json([
                'status'    => true,
                'message'   =>  __('general.success_add_data')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => false,
                'line'      => $e->getLine(),
                'message'   => $e->getMessage()
            ], 422);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | 4. Update Page
    |--------------------------------------------------------------------------
    */

    public function update(WhatsappKeyAccount $device, BlashWhatsapp $blash)
    {
        return view('waba.broadcast.update', ['page' => __('page.wa.update'), 'breadcumb' => true], compact('device', 'blash'));
    }

    /*
    |--------------------------------------------------------------------------
    | 5. Edit Data
    |--------------------------------------------------------------------------
    */

    public function edit(WhatsappKeyAccount $device, BlashWhatsapp $blash, Request $request)
    {
        $this->validate($request, [
            'category'          => 'required',
            'name'              => 'required',
            'schedule'          => 'required',
            'template'          => 'required',
            'metadata'          => 'required'
        ]);


        try {

            DB::beginTransaction();

            $files  = '';
            if ($request->has('files')) {
                $files  = $this->uploadImage($request, 'files', 'template');
            }

            $this->whatsappBroadcastOberver->updateData($request, $blash, $files);

            DB::commit();

            return response()->json([
                'status'    => true,
                'message'   =>  __('general.success_update')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => false,
                'line'      => $e->getLine(),
                'message'   => $e->getMessage()
            ], 422);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | 6. Detail Page
    |--------------------------------------------------------------------------
    */

    public function details(WhatsappKeyAccount $device, BlashWhatsapp $blash)
    {
        return response()->json([
            'status'    => true,
            'detail'    => BroadcastDetailResource::make($blash)
        ], 200);
    }



    /*
    |--------------------------------------------------------------------------
    | 7. Details List
    |--------------------------------------------------------------------------
    */

    public function detail(Request $request, WhatsappKeyAccount $device, BlashWhatsapp $blash)
    {
        return view('waba.broadcast.detail', ['page'  => __('page.wa.detail'), 'breadcumb' => true], compact('blash', 'device'));
    }
}
