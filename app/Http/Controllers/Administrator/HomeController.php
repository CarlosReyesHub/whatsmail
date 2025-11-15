<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Blash\BlashDetail;
use App\Models\Master\Category;
use App\Models\Merchant\Merchant;
use App\Models\Package\PackageTransaction;
use App\Models\Store\Store;
use App\Observers\Blash\LogObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    protected $logsObserver;
    public function __construct(LogObserver $logObserver)
    {
        $this->middleware('auth');
        $this->logsObserver     = $logObserver;
    }

    public function home(Request $request)
    {
        $summary    = array(
            'merchant_monthly'      => Merchant::whereYear("created_at", date("Y"))->whereMonth("created_at", date("m"))->count(),
            'merchant_daily'        => Merchant::whereDate("created_at", date("Y-m-d"))->count(),
            'transactions'          => PackageTransaction::where("status", "success")->whereYear("created_at", date("Y"))->whereMonth("created_at", date("m"))->count(),
            'saldo_int'             => PackageTransaction::where("status", "success")->whereYear("created_at", date("Y"))->whereMonth("created_at", date("m"))->sum("final_total"),
        );

        $mustFollow     = PackageTransaction::select('merchant_id', 'package_id', DB::raw('MAX(expire_date) as last_expire_date'))
            ->where("merchant_id", "!=", null)
            ->where("status", "success")
            ->groupBy('merchant_id')
            ->havingRaw('MAX(expire_date) <= DATE_ADD(CURDATE(), INTERVAL 4 DAY)')
            ->havingRaw('MAX(expire_date) >= DATE_ADD(CURDATE(), INTERVAL 0 DAY)')
            ->limit(10)
            ->get();

        $merchantNotPackage = Merchant::where('created_at', '>', now()->subDays(30)->endOfDay())->where(function ($q) {
            return $q->whereHas('transaction', function ($query) {
                return  $query->selectRaw("count(id) as total")->havingRaw('count(id) = ?', [0]);
            });
        })->limit(10)->get();

        $notPayment     = PackageTransaction::where("status", "pending")->where('created_at', '>', now()->subDays(7)->endOfDay())->orderBy("created_at", "desc")->limit(10)->get();
        $merchants      = Merchant::where('created_at', '>', now()->subDays(7)->endOfDay())->limit(10)->get();

        $data = [
            'stores'        => Store::count(),
            'categories'    => Category::count(),
            'blashs'        => BlashDetail::where('created_at', ">=", now()->subDays(30))->where("reports", null)->count(),
            'scrapp'        => Store::where("scrapping_id", "!=", null)->where('created_at', ">=", now()->subDays(30))->count(),
            'sending'       => BlashDetail::where("reports", null)->where('created_at', ">=", now()->subDays(30))->count(),
            'not_sending'   => BlashDetail::where("reports", "!=", null)->where('created_at', ">=", now()->subDays(30))->count(),
        ];

        $logs = [
            'email'         => $this->logsObserver->getData($request, 'email')->limit(10)->get(['description', 'error', 'type', 'status', 'created_at']),
            'whatsapp'      => $this->logsObserver->getData($request, 'whatsapp')->limit(10)->get(['description', 'error', 'type', 'status', 'created_at']),
            'scrapp'        => $this->logsObserver->getData($request, 'scrapping')->limit(10)->get(['description', 'error', 'type', 'status', 'created_at'])
        ];

        return view('admin.home', ['page'  => __('page.dashboard'), 'breadcumb' => false], compact('data', 'logs', 'summary', 'mustFollow', 'merchantNotPackage', 'notPayment', 'merchants'));
    }

    public function analiss(Request $request)
    {
        $senderData     = array();
        $notSenderData  = array();
        $dateData       = array();

        $blashData = BlashDetail::selectRaw('LEFT(created_at, 10) as date, 
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
}
