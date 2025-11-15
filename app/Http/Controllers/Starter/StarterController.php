<?php

namespace App\Http\Controllers\Starter;

use App\Http\Controllers\Controller;
use App\Models\InternalSetting;
use App\Models\Package\Package;
use App\Models\Package\PackageTransaction;
use App\Observers\Saas\BankObserver;
use App\Observers\Saas\NotificationObserver;
use App\Observers\Saas\PricingObserver;
use App\Observers\Saas\TransactionObserver;
use App\Observers\WhatsappServiceObserver;
use App\Process\MasterData\UploadImageProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StarterController extends Controller
{
    protected $pricingObserver;
    protected $transactionObserver;
    protected $banksObserver;
    protected $uploadImageProcess;
    protected $notificationObserver;
    protected $whatsappServiceObserver;

    public function __construct(PricingObserver $pricingObserver, TransactionObserver $transactionObserver, BankObserver $bankObserver, UploadImageProcess $uploadImageProcess, NotificationObserver $notificationObserver, WhatsappServiceObserver $whatsappServiceObserver)
    {
        $this->pricingObserver      = $pricingObserver;
        $this->transactionObserver  = $transactionObserver;
        $this->banksObserver        = $bankObserver;
        $this->uploadImageProcess   = $uploadImageProcess;
        $this->notificationObserver = $notificationObserver->getData();
        $this->whatsappServiceObserver  = $whatsappServiceObserver;
    }

    public function index(Request $request)
    {
        $packages   = $this->pricingObserver->getData($request)->get();
        return view('starter.packages.index', ['page'  => __('starter.package_plan_price'), 'breadcumb'   => false], compact('packages'));
    }

    public function package(Request $request, Package $package)
    {
        $banks      = $this->banksObserver->getData($request)->get();
        return view('starter.packages.detail', ['page'   => __('starter.transaction_history'), 'breadcumb'   => false], compact('package', 'banks'));
    }

    public function createTransaction(Package $package)
    {

        if (auth()->user()->merchant->transaction_package_pending == false) {
            return redirect()->back()->with(['gagal' => __('starter.validation_package')]);
        }

        if (auth()->user()->merchant->package_transaction->count() > 0 && $package->trial_version == 'yes') {
            return redirect()->back()->with(['gagal' => __('starter.validation_trial')]);
        }


        $internalSetting    = InternalSetting::first(['app_name']);

        try {

            DB::beginTransaction();

            $transaction = $this->transactionObserver->createData(auth()->user()->merchant, $package);


            if ($this->notificationObserver->whatsapp_buy_package == 'yes' && $this->notificationObserver->device) {
                if ($this->notificationObserver->buy_package_template_whatsapp) {
                    $message    = $this->notificationObserver->buy_package_template_whatsapp->message;
                    $file       = $this->notificationObserver->buy_package_template_whatsapp->image;
                    $type       = $this->notificationObserver->buy_package_template_whatsapp->type_content;
                    $datas      = json_decode($this->notificationObserver->buy_package_template_whatsapp->button_or_list, true);
                    $message    = str_replace(
                        ['{business_name}', '{name}', '{package_name}', '{subtotal}', '{date}', '{app_name}'],
                        [($transaction->merchant->name ?? ''), auth()->user()->name, ($transaction->package->name ?? ''), number_format($transaction->final_total), substr($transaction->created_at, 0, 10), $internalSetting->app_name],
                        $message
                    );

                    $messageVariable = array(
                        'message'           => urldecode($message),
                        'template_body'     => array(),
                        'whatsapp_key'      => $this->notificationObserver->device->id,
                        'whatsapp_session'  => $this->notificationObserver->device->id,
                        'file'              => $file != null ? asset($file) : '',
                        'phone'             => $this->notificationObserver->received_notification
                    );

                    if ($messageVariable['phone'] != null) {
                        $this->whatsappServiceObserver->sendMessage($messageVariable['phone'], $messageVariable['whatsapp_key'], $messageVariable['message'], $messageVariable['file'], $type, $datas);
                    }
                }
            }

            if ($this->notificationObserver->email_buy_package == 'yes') {

                if ($this->notificationObserver->buy_package_template_email) {
                    $message    = $this->notificationObserver->buy_package_template_email->html;
                    $message    = str_replace(
                        ['{business_name}', '{name}', '{package_name}', '{subtotal}', '{date}', '{app_name}'],
                        [($transaction->merchant->name ?? ''), auth()->user()->name, ($transaction->package->name ?? ''), number_format($transaction->final_total), substr($transaction->created_at, 0, 10), $internalSetting->app_name],
                        $message
                    );

                    $this->whatsappServiceObserver->sendEmail($this->notificationObserver->received_email_notification, $message, $this->notificationObserver->buy_package_template_email);
                }
            }

            DB::commit();

            return redirect()->route('starter.transactions')->with(['flash' => __('starter.transaction_created')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['gagal' => $e->getMessage()]);
        }
    }


    public function transactions(Request $request)
    {
        $transactions   = $this->transactionObserver->getData($request)->where('merchant_id', auth()->user()->merchant_id ?? null)->get(['id', 'created_at', 'package_id', 'merchant_id', 'price', 'tax', 'final_total', 'ref_no', 'status']);
        return view('starter.transactions.index', ['page' => __('starter.transaction_history'), 'breadcumb'   => false], compact('transactions'));
    }

    public function detail(Request $request, PackageTransaction $transaction)
    {
        if ($transaction->merchant->id != auth()->user()->merchant_id) {
            return redirect()->back()->with(['gagal'    => 'No Access']);
        }

        $banks  = $this->banksObserver->getData($request)->get();
        return view('starter.transactions.detail', ['page'   => __('starter.detail_transaction'), 'breadcumb'   => false], compact('transaction', 'banks'));
    }

    public function payTransaction(Request $request, PackageTransaction $transaction)
    {

        if ($transaction->merchant->id != auth()->user()->merchant_id) {
            return redirect()->back()->with(['gagal'    => 'No Access']);
        }

        $this->validate($request, [
            'amount'            => 'required|numeric',
            'to_bank'           => 'required',
            'bank_name'         => 'required',
            'bank_number'       => 'required',
            'image'             => 'mimes:jpg,jpeg,png',
        ]);


        if ($transaction->status == 'process') {
            return redirect()->back()->with(['gagal'    => __('starter.payment_v_process')]);
        }

        if ($transaction->status == 'success') {
            return redirect()->back()->with(['gagal'    => __('starter.payment_v_success')]);
        }

        $internalSetting    = InternalSetting::first(['app_name']);
        try {

            DB::beginTransaction();

            $image  = '';

            if ($request->image) {
                $image =  $this->uploadImage($request, 'image', 'payments');
            }

            $payment    = $this->transactionObserver->createPayment($request, $transaction, $image);

            $transaction->update([
                'status'        => 'process'
            ]);

            if ($this->notificationObserver->whatsapp_package_payment == 'yes' && $this->notificationObserver->device) {
                if ($this->notificationObserver->package_payment_template_whatsapp) {
                    $message    = $this->notificationObserver->package_payment_template_whatsapp->message;
                    $file       = $this->notificationObserver->package_payment_template_whatsapp->image;
                    $type       = $this->notificationObserver->package_payment_template_whatsapp->type_content;
                    $datas      = json_decode($this->notificationObserver->package_payment_template_whatsapp->button_or_list, true);
                    $message    = str_replace(
                        ['{business_name}', '{name}', '{package_name}', '{payment_amount}', '{date}', '{app_name}', '{from_bank}', '{to_bank}'],
                        [($transaction->merchant->name ?? ''), auth()->user()->name, ($transaction->package->name ?? ''), number_format($payment->amount), substr($transaction->created_at, 0, 10), $internalSetting->app_name, $payment->bank_name, ($payment->bank->name ?? '')],
                        $message
                    );

                    $messageVariable = array(
                        'message'           => urldecode($message),
                        'template_body'     => array(),
                        'whatsapp_key'      => $this->notificationObserver->device->id,
                        'whatsapp_session'  => $this->notificationObserver->device->id,
                        'file'              => $file != null ? asset($file) : '',
                        'phone'             => $this->notificationObserver->received_notification
                    );

                    if ($messageVariable['phone'] != null) {
                        $this->whatsappServiceObserver->sendMessage($messageVariable['phone'], $messageVariable['whatsapp_key'], $messageVariable['message'], $messageVariable['file'], $type, $datas);
                    }
                }
            }

            if ($this->notificationObserver->email_package_payment == 'yes') {

                if ($this->notificationObserver->package_payment_template_email) {
                    $message    = $this->notificationObserver->package_payment_template_email->html;
                    $message    = str_replace(
                        ['{business_name}', '{name}', '{package_name}', '{payment_amount}', '{date}', '{app_name}', '{from_bank}', '{to_bank}'],
                        [($transaction->merchant->name ?? ''), auth()->user()->name, ($transaction->package->name ?? ''), number_format($payment->amount), substr($transaction->created_at, 0, 10), $internalSetting->app_name, $payment->bank_name, ($payment->bank->name ?? '')],
                        $message
                    );

                    $this->whatsappServiceObserver->sendEmail($this->notificationObserver->received_email_notification, $message, $this->notificationObserver->package_payment_template_email);
                }
            }

            if ($this->notificationObserver->whatsapp_package_user == 'yes' && $this->notificationObserver->device) {
                if ($this->notificationObserver->package_user_template_whatsapp) {
                    $message    = $this->notificationObserver->package_user_template_whatsapp->message;
                    $file       = $this->notificationObserver->package_user_template_whatsapp->image;
                    $type       = $this->notificationObserver->package_user_template_whatsapp->type_content;
                    $datas      = json_decode($this->notificationObserver->package_user_template_whatsapp->button_or_list, true);
                    $message    = str_replace(
                        ['{business_name}', '{name}', '{package_name}', '{payment_amount}', '{date}', '{app_name}', '{from_bank}', '{to_bank}'],
                        [($transaction->merchant->name ?? ''), auth()->user()->name, ($transaction->package->name ?? ''), number_format($payment->amount), substr($transaction->created_at, 0, 10), $internalSetting->app_name, $payment->bank_name, ($payment->bank->name ?? '')],
                        $message
                    );

                    $messageVariable = array(
                        'message'           => urldecode($message),
                        'template_body'     => array(),
                        'whatsapp_key'      => $this->notificationObserver->device->id,
                        'whatsapp_session'  => $this->notificationObserver->device->id,
                        'file'              => $file != null ? asset($file) : '',
                        'phone'             => $transaction->merchant->owner->phone ?? null
                    );

                    if ($messageVariable['phone'] != null) {
                        $this->whatsappServiceObserver->sendMessage($messageVariable['phone'], $messageVariable['whatsapp_key'], $messageVariable['message'], $messageVariable['file'], $type, $datas);
                    }
                }
            }

            if ($this->notificationObserver->email_package_user == 'yes') {

                if ($this->notificationObserver->package_user_template_email) {
                    $message    = $this->notificationObserver->package_user_template_email->html;
                    $message    = str_replace(
                        ['{business_name}', '{name}', '{package_name}', '{payment_amount}', '{date}', '{app_name}', '{from_bank}', '{to_bank}'],
                        [($transaction->merchant->name ?? ''), auth()->user()->name, ($transaction->package->name ?? ''), number_format($payment->amount), substr($transaction->created_at, 0, 10), $internalSetting->app_name, $payment->bank_name, ($payment->bank->name ?? '')],
                        $message
                    );

                    $this->whatsappServiceObserver->sendEmail($transaction->merchant->owner->email ?? null, $message, $this->notificationObserver->package_user_template_email);
                }
            }

            DB::commit();
            return redirect()->route('starter.transactions')->with(['flash'    => __('general.success_add_data')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['gagal' => $e->getMessage()]);
        }
    }

    public function delete(PackageTransaction $transaction)
    {

        if ($transaction->merchant->id != auth()->user()->merchant_id) {
            return redirect()->back()->with(['gagal'    => 'No Access']);
        }

        if ($transaction->status == 'process') {
            return redirect()->back()->with(['gagal'    => __('starter.payment_v_process')]);
        }

        if ($transaction->status == 'success') {
            return redirect()->back()->with(['gagal'    => __('starter.cant_delete')]);
        }


        $transaction->delete();
        return redirect()->back()->with(['flash'    => __('general.success_deleted')]);
    }
}
