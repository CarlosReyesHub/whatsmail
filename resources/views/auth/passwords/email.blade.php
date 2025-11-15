@extends('layouts.auth')
@section('content')
<div class="text-center mb-4">
    <a href="<?= route('login'); ?>" class="navbar-brand navbar-brand-autodark d-flex justify-content-center">
        <img src="{{asset($internalSetting->logo)}}" class="w-75">
    </a>
</div>
<form class="card card-md" action="{{ route('password.email') }}" method="POST" autocomplete="on" novalidate>
    @csrf
    <div class="card-body">
        <h2 class="card-title text-center mb-2">{{__('auth.reset_password')}}</h2>
        <p class="text-secondary text-center mb-4">{{__('auth.input_your_mail')}}</p>
        <x-validation-component></x-validation-component>
        <div class="mb-3">
            <label class="form-label">{{__('general.email')}}</label>
            <input type="email" name="email" value="<?= old('email'); ?>" class="form-control" placeholder="{{__('general.insert_email')}}">
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                    <path d="M3 7l9 6l9 -6" />
                </svg>
                {{__('auth.ask_reset_password')}}
            </button>
        </div>
    </div>
</form>
<div class="text-center text-secondary mt-3">
    <a href="{{ route('login') }}">{{__('auth.back_to_login')}}</a>
</div>
@endsection