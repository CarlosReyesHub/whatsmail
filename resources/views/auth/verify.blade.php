@extends('layouts.auth')
@section('content')
<div class="text-center mb-4">
    <a href="<?= route('login'); ?>" class="navbar-brand navbar-brand-autodark d-flex justify-content-center">
        <img src="{{asset($internalSetting->logo)}}" class="w-75">
    </a>
</div>
<div class="text-center">
    <div class="my-5">
        <h2 class="h1">{{__('auth.email_verify')}}</h2>
        <p class="fs-h3 text-secondary">
            {{__('auth.verify_desc')}}
        </p>
        @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{__('auth.after_send_verify')}}
        </div>
        @endif
        <x-validation-component></x-validation-component>
    </div>
    <form method="POST" action="<?= route('verification.resend'); ?>" class="text-center text-secondary mt-3">
        @csrf
        <div class="col-xl-12 d-grid mt-3">
            <button type="submit" class="btn btn-lg btn-primary">{{__('auth.send_try_verify')}}</button>
        </div>
    </form>
</div>
@endsection