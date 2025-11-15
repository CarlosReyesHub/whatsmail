<?php

namespace App\Http\Controllers;

use App\Observers\Blash\BlashWhatsappObserver;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $blastWhatsappObserver;

    public function __construct(BlashWhatsappObserver $blashWhatsappObserver)
    {
        $this->blastWhatsappObserver        = $blashWhatsappObserver;
    }


    public function index(Request $request)
    {
        $devices        = $this->blastWhatsappObserver->getStatisticData($request);
        return view('logs.statistic', ['page'   => 'Statistik Laporan Pengiriman Device', 'breadcumb' => true], compact('devices'));
    }
}
