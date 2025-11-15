@extends('layouts.auth')
@section('content')
<div class="text-center mb-4">
    <a href="<?= route('login'); ?>" class="navbar-brand navbar-brand-autodark d-flex justify-content-center">
        <img src="{{asset($internalSetting->logo)}}" class="w-75">
    </a>
</div>
<form class="card card-md" action="{{ route('password.update') }}" method="POST" autocomplete="on" novalidate>
    @csrf
    <div class="card-body">
        <x-validation-component></x-validation-component>
        <div class="mb-3">
            <label class="form-label">{{__('general.email')}}</label>
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="email" name="email" value="{{ $email ?? old('email') }}" class="form-control" placeholder="{{__('general.insert_email')}}">
        </div>
        <div class="mb-3">
            <label class="form-label">{{__('general.new_password')}}</label>
            <input type="password" class="form-control" name="password" required id="user-password" placeholder="{{__('general.insert_password')}}">
        </div>
        <div class="mb-3">
            <label class="form-label">{{__('general.password_confirmation')}}</label>
            <input type="password" class="form-control" name="password_confirmation" required id="user-password">
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">
                {{__('general.save_change')}}
            </button>
        </div>
    </div>
</form> 
@endsection