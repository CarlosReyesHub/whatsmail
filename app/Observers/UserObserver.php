<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    public function getData(Request $request)
    {
        return User::where(function ($q) use ($request) {
            return $request->name ? $q->where('name', 'like', '%' . $request->name . '%') : '';
        })->orderBy('name', 'asc');
    }

    public function checkLimit()
    {
        if(auth()->user()->role == 'user') {
            $transaction = auth()->user()->merchant->package_active;
            if(!$transaction) {
                return false;  
            } 
 
            if($transaction->limit_user_option == 'yes') {
                $allUsers = User::count();
                if($allUsers >= $transaction->users_limit) {
                    return false;
                }
            } 
        }
 

        return true;
    }

    public function createData(Request $request, String $image)
    {
        return User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'phone'             => $request->phone ?? '',
            'password'          => Hash::make($request->password),
            'photo'             => $image,
            'role'              => auth()->user()->role,
            'gender'            => $request->gender
        ]);
    }

    public function updateData(Request $request, User $user, String $image)
    {
        $user->update([
            'name'              => $request->name,
            'email'             => $request->email,
            'phone'             => $request->phone ?? '',
            'photo'             => $image != '' ? $image : $user->photo,
            'gender'            => $request->gender
        ]);
    }

    public function changePassword(Request $request, User $user)
    {
        $user->update([
            'password'          => Hash::make($request->password)
        ]);
    }

    public function getCheckUserPassword(Request $request, User $user)
    {

        return User::where("password", "!=", Hash::check($request->old_password, $user->password))->first();
    }

    public function deleteData(User $user)
    {
        $user->delete();
    }
}
