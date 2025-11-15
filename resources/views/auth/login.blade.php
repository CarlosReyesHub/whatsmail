@extends('layouts.auth')
@section('content')
<div class="text-center mb-4">
    <a href="<?= route('login'); ?>" class="navbar-brand navbar-brand-autodark d-flex justify-content-center">
        <img src="{{asset($internalSetting->logo)}}" class="w-75">
    </a>
</div>
<div class="card card-md">
    <div class="card-body">
        <h2 class="h2 text-center mb-4">Login Menggunakan Akun Anda</h2>
        <x-validation-component></x-validation-component>
        <form action="<?= route('login'); ?>" method="POST" autocomplete="on" novalidate>
            @csrf
            <div class="mb-3">
                <label class="form-label">{{__('general.email')}}</label>
                <input type="email" class="form-control" name="email" value="<?= old('email'); ?>" required autocomplete="on" placeholder="{{__('general.insert_email')}}">
            </div>
            <div class="mb-2">
                <label class="form-label">
                    {{__('general.password')}}
                    <span class="form-label-description">
                        <a href="{{ route('password.request') }}">{{__('auth.forget_password')}}</a>
                    </span>
                </label>
                <div class="input-group input-group-flat">
                    <input type="password" id="user-password" class="form-control" placeholder="{{__('general.insert_password')}}" name="password" required autocomplete="on">
                    <span class="input-group-text">
                        <a href="javascript:void(0);" onclick="createpassword('user-password',this)" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                        </a>
                    </span>
                </div>
            </div>
            <div class="mb-2">
                <label class="form-check">
                    <input type="checkbox" name="remember" <?= old('remember') ? 'checked' : ''; ?> class="form-check-input" />
                    <span class="form-check-label"> {{__('general.save_credencial')}}</span>
                </label>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">{{__('general.login_now')}}</button>
            </div>
        </form>
    </div>
</div>
@if($internalSetting->register == 'yes')
<div class="text-center text-secondary mt-3">
    <a href="{{route('register')}}" tabindex="-1"> {{__('auth.dont_have_account')}}</a>
</div>
@endif


@endsection