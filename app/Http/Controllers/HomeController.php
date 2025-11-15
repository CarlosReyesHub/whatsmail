<?php

namespace App\Http\Controllers;

use App\Models\Blash\BlashDetail;
use App\Models\InternalSetting;
use App\Models\Master\Category;
use App\Models\Store\Store;
use App\Observers\Blash\LogObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{


    protected $logsObserver;
    public function __construct(LogObserver $logObserver)
    { 
        $this->logsObserver     = $logObserver;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.index');
            }

            if (auth()->user()->role == 'user') {
                return redirect()->route('index');
            }
        }

        return redirect()->route('login');
    }

    public function redirect()
    {
        $setting = InternalSetting::first(['frontend']); 
        if ($setting) {
            if ($setting->frontend == 'yes') {
                return redirect()->route('web.home');
            }
        }

        return redirect()->route('login');
    }


    public function home(Request $request)
    {
        $data = [
            'stores'        => Store::count(),
            'categories'    => Category::count(),
            'blashs'        => BlashDetail::whereHas('parent', function ($q) {
                return $q->where("merchant_id", auth()->user()->merchant_id);
            })->where('created_at', ">=", now()->subDays(30))->where("reports", null)->count(),
            'scrapp'        => Store::where("scrapping_id", "!=", null)->where('created_at', ">=", now()->subDays(30))->count(),
            'sending'       => BlashDetail::whereHas('parent', function ($q) {
                return $q->where("merchant_id", auth()->user()->merchant_id);
            })->where("reports", null)->where('created_at', ">=", now()->subDays(30))->count(),
            'not_sending'   => BlashDetail::whereHas('parent', function ($q) {
                return $q->where("merchant_id", auth()->user()->merchant_id);
            })->where("reports", "!=", null)->where('created_at', ">=", now()->subDays(30))->count(),
        ];

        $logs = [
            'email'         => $this->logsObserver->getData($request, 'email')->limit(10)->get(['description', 'error', 'type', 'status', 'created_at']),
            'whatsapp'      => $this->logsObserver->getData($request, 'whatsapp')->limit(10)->get(['description', 'error', 'type', 'status', 'created_at']),
            'scrapp'        => $this->logsObserver->getData($request, 'scrapping')->limit(10)->get(['description', 'error', 'type', 'status', 'created_at'])
        ];

        return view('home', ['page'  => __('page.dashboard'), 'breadcumb'   => false], compact('data', 'logs'));
    }

    public function analiss(Request $request)
    {
        $senderData     = array();
        $notSenderData  = array();
        $dateData       = array();

        $blashData = BlashDetail::whereHas('parent', function ($q) {
            return $q->where("merchant_id", auth()->user()->merchant_id);
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

    public function logs(Request $request)
    {
        $logs   = $this->logsObserver->getData($request, $request->type)->limit(10)->get(['description', 'error', 'type', 'status', 'created_at']);
        return response()->json($logs);
    }
}
