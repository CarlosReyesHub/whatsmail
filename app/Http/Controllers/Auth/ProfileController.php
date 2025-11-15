<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Observers\UserObserver;
use App\Process\MasterData\UploadImageProcess;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    protected $userObserver;
    protected $uploadImageProcess;

    public function __construct(UserObserver $userObserver, UploadImageProcess $uploadImageProcess)
    {
        $this->userObserver         = $userObserver;
        $this->uploadImageProcess   = $uploadImageProcess;
    }


    public function index()
    {
        return view('profile', ['page'   => __('page.my_profile'), 'breadcumb' => true]);
    }

    public function profile(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|unique:users,email,' . auth()->user()->id,
            'phone'     => 'required|unique:users,phone,' . auth()->user()->id,
            'image'     => 'mimes:jpg,jpeg,png',
            'gender'    => 'required|in:male,female'
        ]);

        $image  = '';

        if ($request->image) {
            $this->unlinkFile(auth()->user()->photo);
            $image =  $this->uploadImage($request, 'image', 'users');
        }

        $this->userObserver->updateData($request, auth()->user(), $image);
        return redirect()->back()->with(['flash'    => __('general.success_update')]);
    }

    public function password(Request $request)
    {
        $this->validate($request, [
            'old_password'  => 'required',
            'password'      => 'required|min:8',
            'confirm'       => 'required',
        ]);

        if ($request->password != $request->confirm) {
            return back()->with(['gagal' => __('validation.password_must_same')]);
        }

        $passwordCheck  = $this->userObserver->getCheckUserPassword($request, auth()->user());

        if (!$passwordCheck) {
            return back()->with(['gagal'    => 'Password Lama Anda Salah']);
        }

        $this->userObserver->changePassword($request, auth()->user());
        return redirect()->back()->with(['flash'    => __('general.success_update')]);
    }
}
