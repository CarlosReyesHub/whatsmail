<?php

namespace App\Observers\Saas;

use App\Models\InternalSetting;
use App\Models\Merchant\Merchant;
use App\Models\Package\Package;
use App\Models\Package\PackageTransaction;
use App\Models\Package\PackageTransactionPayment;
use DateTime;
use Illuminate\Http\Request;

class TransactionObserver
{

    public function getData(Request $request)
    {
        return PackageTransaction::where(function ($q) {
            return auth()->user()->role == 'user' ? $q->where("merchant_id", auth()->user()->merchant_id) : '';
        })->where(function ($q) use ($request) {
            if ($request->end_date && $request->start_date) {
                return $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
            } else {
                return $request->start_date ? $q->whereDate("created_at", $request->start_date) : "";
            }
        })->where(function ($q) use ($request) {
            return $request->status ? $q->where("status", $request->status) : '';
        })->where(function ($q) use ($request) {
            return $request->bank ? $q->where("to_bank", $request->bank) : '';
        })->where(function ($q) use ($request) {
            return $request->merchant ? $q->where("merchant_id", $request->merchant) : '';
        })->orderBy("id", "asc");
    }


    public function createData(Merchant $merchant, Package $package)
    {
        $addExpireDate          = now()->addDays((int)$package->add_days);
        $getLastTransaction     = $this->getLastTransactionBusiness($merchant);
        $getDaysTransaction     = $this->getAddDaysTransaction($package, $getLastTransaction);
        $settings               = InternalSetting::first(['tax']);
        $taxrate                = $settings->tax;
        $taxTotal               = $taxrate > 0 ? $taxrate / 100 * $package->price : 0;
        $invoiceNumber          = $this->generateInvoice();
        $refNo                  = 'SL' . date('Ymd') . '/' . $invoiceNumber;

        if ($getDaysTransaction['status'] == true) {
            $addExpireDate      = $getDaysTransaction['new_date'];
        }
  
        return PackageTransaction::create([
            'invoice'                   => $invoiceNumber,
            'ref_no'                    => $refNo,
            'merchant_id'               => $merchant->id,
            'package_id'                => $package->id,
            'price'                     => $package->price,
            'expire_date'               => $addExpireDate,
            'tax'                       => $taxrate,
            'final_total'               => ($package->price + $taxTotal),
            'add_days'                  => $package->add_days,
            'limit_user_option'         => $package->limit_user_option,
            'users_limit'               => $package->users_limit,
            'limit_whatsapp_option'     => $package->limit_whatsapp_option,
            'limit_whatsapp_priode'     => $package->limit_whatsapp_priode,
            'whatsapp_limit'            => $package->whatsapp_limit,
            'limit_email_option'        => $package->limit_email_option,
            'limit_email_priode'        => $package->limit_email_priode,
            'email_limit'               => $package->email_limit,
            'limit_scrapp_option'       => $package->limit_scrapp_option,
            'limit_scrapp_priode'       => $package->limit_scrapp_priode,
            'scrapp_limit'              => $package->scrapp_limit,
            'limit_device'              => $package->limit_device,
            'device_limit'              => $package->device_limit,
            'limit_template'            => $package->limit_template,
            'template_limit'            => $package->template_limit,
            'limit_ai_training'         => $package->limit_ai_training,
            'ai_training_limit'         => $package->ai_training_limit,
            'limit_chatbot'             => $package->limit_chatbot,
            'chatbot_limit'             => $package->chatbot_limit,
            'status'                    => $package->trial_version == 'yes' ? 'success' : 'pending',
        ]);
    }

    public function createPayment(Request $request, PackageTransaction $transaction, String $image)
    {
        return PackageTransactionPayment::create([
            'package_transaction_id'    => $transaction->id,
            'amount'                    => $request->amount,
            'method'                    => 'bank',
            'to_bank'                   => $request->to_bank,
            'bank_name'                 => $request->bank_name,
            'bank_number'               => $request->bank_number,
            'file'                      => $image,
        ]);
    }

    public function getLastTransactionBusiness(Merchant $merchant)
    {
        return PackageTransaction::where("status", "success")->where("merchant_id", $merchant->id)->orderBy("created_at", "desc")->first(['id', 'expire_date']);
    }

    public function getAddDaysTransaction($package, $getLastTransaction)
    {
 
        if ($getLastTransaction != null) {
            if ($getLastTransaction->expire_date >= now()) {
                $datetime1 = new DateTime($getLastTransaction->expire_date);
                $datetime2 = new DateTime(now());
                $interval = $datetime1->diff($datetime2);

                $totalY     = 0;
                if ($interval->y > 0) {
                    $totalY     = $interval->y * 365;
                }

                $totalM     = 0;
                if ($interval->m > 0) {
                    $totalM     = $interval->m * 30;
                }

                $addDays = $package->add_days + ($interval->d + $totalY + $totalM);
 
                return array(
                    'status'    => true,
                    'new_date'  => now()->addDays($addDays)
                );
            }
        }

        return array(
            'status'    => false
        );
    }

    public function generateInvoice()
    {
        $getTransaction   = PackageTransaction::whereDate("created_at", date("Y-m-d"))->count() + 1;
        $invoiceNumber    = sprintf("%05d", $getTransaction);
        return $invoiceNumber;
    }
}
