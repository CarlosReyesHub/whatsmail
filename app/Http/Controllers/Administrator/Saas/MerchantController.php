<?php

namespace App\Http\Controllers\Administrator\Saas;

use App\Http\Controllers\Controller;
use App\Models\Blash\BlashDetail;
use App\Models\ChatBot\ChatBot;
use App\Models\ChatBot\FineTunnel;
use App\Models\Master\Category;
use App\Models\Master\MessageTemplate;
use App\Models\Merchant\Merchant;
use App\Models\Store\Store;
use App\Models\User;
use App\Models\WhatsappDevice;
use App\Observers\Blash\LogObserver;
use App\Observers\Saas\MerchantObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    protected $merchantObserver;
    protected $logsObserver;

    public function __construct(MerchantObserver $merchantObserver, LogObserver $logObserver)
    {
        $this->merchantObserver     = $merchantObserver;
        $this->logsObserver         = $logObserver;
    }

    public function index(Request $request)
    {
        $merchants      = $this->merchantObserver->getData($request)->get();
        return view('admin.merchants.index', ['page'     => __('page.customer.page'), 'breadcumb' => false], compact('merchants'));
    }

    public function getByJquery(Request $request)
    {
        $merchants      = $this->merchantObserver->getData($request)->limit(20)->get(['id', 'name']);
        return response()->json($merchants);
    }

    public function detail(Request $request, Merchant $merchant)
    {

        $data = [
            'stores'        => Store::where("merchant_id", $merchant->id)->count(),
            'categories'    => Category::where("merchant_id", $merchant->id)->count(),
            'blashs'        => BlashDetail::whereHas('parent', function ($q) use ($merchant) {
                return $q->where("merchant_id", $merchant->id);
            })->where('created_at', ">=", now()->subDays(30))->where("reports", null)->count(),
            'scrapp'        => Store::where("merchant_id", $merchant->id)->where("scrapping_id", "!=", null)->where('created_at', ">=", now()->subDays(30))->count(),
            'sending'       => BlashDetail::whereHas('parent', function ($q) use ($merchant) {
                return $q->where("merchant_id", $merchant->id);
            })->where("reports", null)->where('created_at', ">=", now()->subDays(30))->count(),
            'not_sending'   => BlashDetail::whereHas('parent', function ($q) use ($merchant) {
                return $q->where("merchant_id", $merchant->id);
            })->where("reports", "!=", null)->where('created_at', ">=", now()->subDays(30))->count(),
            'template'      => MessageTemplate::where("merchant_id", $merchant->id)->count(),
            'training'      => FineTunnel::where("merchant_id", $merchant->id)->count(),
            'chatbot'       => ChatBot::where("merchant_id", $merchant->id)->count(),
            'device'        => WhatsappDevice::where("merchant_id", $merchant->id)->count(),
            'users'         => User::where("merchant_id", $merchant->id)->count()
        ];

        $logs = [
            'email'         => $this->logsObserver->getData($request, 'email')->where("merchant_id", $merchant->id)->limit(10)->get(['description', 'error', 'type', 'status', 'created_at']),
            'whatsapp'      => $this->logsObserver->getData($request, 'whatsapp')->where("merchant_id", $merchant->id)->limit(10)->get(['description', 'error', 'type', 'status', 'created_at']),
            'scrapp'        => $this->logsObserver->getData($request, 'scrapping')->where("merchant_id", $merchant->id)->limit(10)->get(['description', 'error', 'type', 'status', 'created_at'])
        ];

        return view('admin.merchants.detail', ['page'    => __('page.customer.detail'), 'breadcumb' => true], compact('merchant', 'data', 'logs'));
    }

    public function merchantAnalisis(Merchant $merchant)
    {
        $senderData     = array();
        $notSenderData  = array();
        $dateData       = array();

        $blashData = BlashDetail::whereHas('parent', function ($q) use ($merchant) {
            return $q->where("merchant_id", $merchant->id);
        })->selectRaw('LEFT(created_at, 10) as date, 
        SUM(CASE WHEN reports IS NULL THEN 1 ELSE 0 END) AS sending,
        SUM(CASE WHEN reports IS NOT NULL THEN 1 ELSE 0 END) AS not_sending')
            ->where('created_at', ">=", now()->subDays(30))
            ->groupBy('date')
            ->get();

        foreach ($blashData as $blash) {
            $dateData[]             = Carbon::parse($blash->date, 'Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('d, M Y');
            $senderData[]           = (int)$blash->sending;
            $notSenderData[]        = (int)$blash->not_sending;
        }

        return response()->json([
            'analisis_blash'    => array(
                'sender'            => $senderData,
                'not_sender'        => $notSenderData,
                'date'              => $dateData,
            ),
        ]);
    }

    public function changeStatus(Merchant $merchant)
    {

        $merchant->update([
            'status'        => $merchant->status == 'active' ? 'no' : 'active'
        ]);

        return response()->json([
            'message'   => __('general.success_update'),
            'merchant'  => $merchant->status
        ]);
    }

    public function signIntUser(Merchant $merchant)
    {
        if ($merchant->owner) {
            Auth::login($merchant->owner);
            return redirect()->route('index')->with(['flash' => 'Anda Login Sebagai ' . $merchant->owner->name]);
        }

        return redirect()->back()->with(['gagal'    => __('customer.user_not_found')]);
    }
}
