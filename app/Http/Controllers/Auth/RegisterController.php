<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\InternalSetting;
use App\Models\Merchant\Merchant;
use App\Models\Setting;
use App\Models\User;
use App\Observers\Saas\MerchantObserver;
use App\Observers\Saas\NotificationObserver;
use App\Observers\WhatsappServiceObserver;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $merchantObserver;
    protected $notificationObserver;
    protected $whatsappServiceObserver;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MerchantObserver $merchantObserver, NotificationObserver $notificationObserver, WhatsappServiceObserver $whatsappServiceObserver)
    {
        $this->merchantObserver         = $merchantObserver;
        $this->notificationObserver     = $notificationObserver->getData();
        $this->whatsappServiceObserver  = $whatsappServiceObserver;
        $this->middleware('guest');
    }


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(Request $request)
    {
        $internalSetting    = InternalSetting::first(['logo', 'register']);

        if ($internalSetting->register == 'no') {
            return redirect()->route('login');
        }

        $categories         = $this->merchantObserver->businessCategories($request)->get(['id', 'name']);
        return view('auth.register', ['page' => 'Daftar Akun'], compact('categories', 'internalSetting'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'phone'         => ['required', 'numeric', 'min:10', 'unique:users'],
            'gender'        => ['required', 'in:male,female'],
            'business_name' => ['required', 'string', 'max:255'],
            'address'       => ['required'],
            'zip_code'      => ['required'],
            'category'      => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $internalSetting    = InternalSetting::first(['app_name']);
        try {

            DB::beginTransaction();

            $users  = User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'phone'     => $data['phone'],
                'gender'    => $data['gender'],
                'password'  => Hash::make($data['password']),
            ]);

            $businessMerchant = Merchant::create([
                'name'                      => $data['business_name'],
                'merchant_category_id'      => $data['category'],
                'owner_id'                  => $users->id,
                'address'                   => $data['address'],
                'zip_code'                  => $data['zip_code']
            ]);

            Setting::create([
                'mailer'            => 'SMTP',
                'local_api_key'     => Uuid::uuid4()->toString(),
                'mail_encryption'   => 'tls',
                'use_whatsapp'      => 'internal',
                'default_lang'      => 'en',
                'merchant_id'       => $businessMerchant->id
            ]);

            $users->update([
                'merchant_id'   => $businessMerchant->id
            ]);

            if ($this->notificationObserver->whatsapp_register == 'yes' && $this->notificationObserver->device) {

                if ($this->notificationObserver->register_template_whatsapp) {
                    $message    = $this->notificationObserver->register_template_whatsapp->message;
                    $file       = $this->notificationObserver->register_template_whatsapp->image;
                    $type       = $this->notificationObserver->register_template_whatsapp->type_content;
                    $datas      = json_decode($this->notificationObserver->register_template_whatsapp->button_or_list,true);
                    $message    = str_replace(
                        ['{business_name}', '{name}', '{phone}', '{email}', '{date}', '{app_name}'],
                        [$businessMerchant->name, $users->name, $users->phone, $users->email, substr($users->created_at, 0, 10), $internalSetting->app_name],
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

                    $this->whatsappServiceObserver->sendMessage($messageVariable['phone'], $messageVariable['whatsapp_key'], $messageVariable['message'], $messageVariable['file'], $type, $datas);
                }
            }

            if ($this->notificationObserver->email_register == 'yes') {

                if ($this->notificationObserver->register_template_email) {
                    $message    = $this->notificationObserver->register_template_email->html;
                    $message    = str_replace(
                        ['{business_name}', '{name}', '{phone}', '{email}', '{date}', '{app_name}'],
                        [$businessMerchant->name, $users->name, $users->phone, $users->email, substr($users->created_at, 0, 10), $internalSetting->app_name],
                        $message
                    );

                    $this->whatsappServiceObserver->sendEmail($this->notificationObserver->received_email_notification, $message, $this->notificationObserver->register_template_email);
                }
            }

            DB::commit();

            return $users;
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with(['gagal'    => $e->getMessage()]);
        }
    }
}
