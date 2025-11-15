<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Observers\UserObserver;
use App\Process\MasterData\UploadImageProcess;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Users Controllers
    |--------------------------------------------------------------------------
    */

    protected $usersObserver;
    protected $uploadImageProcess;

    public function __construct(UserObserver $userObserver, UploadImageProcess $uploadImageProcess)
    {
        $this->usersObserver        = $userObserver;
        $this->uploadImageProcess   = $uploadImageProcess;
    }

    /*
    |--------------------------------------------------------------------------
    | 1. Users List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $users   = $this->usersObserver->getData($request)->get();
        return view('users.index', ['page'    => __('page.user.page'), 'breadcumb' => true], compact('users'));
    }

    /*
    |--------------------------------------------------------------------------
    | 2. Create Page
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('users.create', ['page'   => __('page.user.add'), 'breadcumb' => true]);
    }

    /*
    |--------------------------------------------------------------------------
    | 3. Update Page
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, User $user)
    {
        return view('users.update', ['page'   => __('page.user.edit'), 'breadcumb' => true], compact('user'));
    }

    /*
    |--------------------------------------------------------------------------
    | 4. Change Password
    |--------------------------------------------------------------------------
    */

    public function changePassword(Request $request, User $user)
    {
        $this->validate($request, [
            'password'      => 'required|min:8',
            'confirm'       => 'required'
        ]);

        if ($request->password != $request->confirm) {
            return redirect()->back()->with(['gagal'    => __('validation.password_must_same')]);
        }

        $this->usersObserver->changePassword($request, $user);
        return redirect()->route('users')->with(['flash' => __('general.success_update')]);
    }

    /*
    |--------------------------------------------------------------------------
    | 5. Delete User
    |--------------------------------------------------------------------------
    */

    public function delete(User $user)
    {

        $this->unlinkFile($user->photo);
        $this->usersObserver->deleteData($user);

        return redirect()->back()->with(['flash'    => __('general.success_deleted')]);
    }


    /*
    |--------------------------------------------------------------------------
    | 6. Store Data to Database
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,NULL,id',
            'phone'         => 'required|numeric|unique:users,phone,NULL,id',
            'password'      => 'required|min:8',
            'photo'         => 'mimes:jpg,jpeg,png',
            'gender'        => 'required|in:male,female'
        ]);

        $validationCheck = $this->usersObserver->checkLimit();

        if ($validationCheck == false) {
            return redirect()->back()->with(['gagal'    => __('user.limit')]);
        }

        $image  = '';

        if ($request->image) {
            $image =  $this->uploadImage($request, 'image', 'users');
        }

        if ($image == '') {
            $image = $this->uploadImageProcess->createDafaultMedia($request->name, 'uploads/users/');
        }

        $device = $this->usersObserver->createData($request, $image);
        return redirect()->route('users', $device->id)->with(['flash' => __('general.success_add_data')]);
    }


    /*
    |--------------------------------------------------------------------------
    | 7. Update Data to Database
    |--------------------------------------------------------------------------
    */

    public function edit(Request $request, User $user)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => "required|email|unique:users,email,{$user->id}",
            'phone'         => "required|numeric|unique:users,phone,{$user->id}",
            'photo'         => 'mimes:jpg,jpeg,png',
            'gender'        => 'required|in:male,female'
        ]);

        $image  = '';

        if ($request->image) {
            $this->unlinkFile($user->photo);
            $image =  $this->uploadImage($request, 'image', 'users');
        }

        $this->usersObserver->updateData($request, $user, $image);
        return redirect()->route('users')->with(['flash' => __('general.success_update')]);
    }
}
