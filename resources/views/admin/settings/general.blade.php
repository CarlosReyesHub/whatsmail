@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/libs/dropify/css/dropify.min.css')}}">
@endsection

@section('content')
<!-- Start::app-content -->
<div class="row">
    <div class="col-lg-12">
        <x-validation-component></x-validation-component>
        <form action="<?= route('general.settings.store'); ?>" enctype="multipart/form-data" method="POST" class="card custom-card">
            @csrf
            <div class="card-header">
                <div class="card-title">
                    {{$page}}
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.platform_name')}}</label>
                        <input class="form-control" name="name" value="<?= $setting->app_name; ?>" type="text">
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.email_contact')}}</label>
                        <input class="form-control" name="email" value="<?= $setting->email_contact; ?>" type="email">
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.phone_contact')}}</label>
                        <input class="form-control" name="phone" value="<?= $setting->phone_contact; ?>" type="number">
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.tax_package')}}</label>
                        <input class="form-control" max="100" name="tax" value="<?= (int)$setting->tax; ?>" type="number">
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.currency')}}</label>
                        <select class="form-control" name="currency">
                            <option value="">{{__('general.choose')}}</option>
                            <option value="Rp" @if($setting->currency == 'Rp') selected @endif>IDR - Rupiah</option>
                            <option value="$" @if($setting->currency == '$') selected @endif>USD - United States Dollar</option>
                            <option value="€" @if($setting->currency == '€') selected @endif>EUR - Euro</option>
                            <option value="¥" @if($setting->currency == '¥') selected @endif>JPY - Japanese Yen</option>
                            <option value="£" @if($setting->currency == '£') selected @endif>GBP - British Pound Sterling</option>
                            <option value="₹" @if($setting->currency == '₹') selected @endif>INR - Indian Rupee</option>
                            <option value="₩" @if($setting->currency == '₩') selected @endif>KRW - South Korean Won</option>
                            <option value="C$" @if($setting->currency == 'C$') selected @endif>CAD - Canadian Dollar</option>
                            <option value="AU$" @if($setting->currency == 'AU$') selected @endif>AUD - Australian Dollar</option>
                            <option value="CHF" @if($setting->currency == 'CHF') selected @endif>CHF - Swiss Franc</option>
                            <option value="CN¥" @if($setting->currency == 'CN¥') selected @endif>CNY - Chinese Yuan</option>
                            <option value="R$" @if($setting->currency == 'R$') selected @endif>BRL - Brazilian Real</option>
                            <option value="₽" @if($setting->currency == '₽') selected @endif>RUB - Russian Ruble</option>
                            <option value="ZAR" @if($setting->currency == 'ZAR') selected @endif>ZAR - South African Rand</option>
                            <option value="SAR" @if($setting->currency == 'SAR') selected @endif>SAR - Saudi Riyal</option>
                            <option value="AED" @if($setting->currency == 'AED') selected @endif>AED - UAE Dirham</option>
                            <option value="SGD" @if($setting->currency == 'SGD') selected @endif>SGD - Singapore Dollar</option>
                            <option value="MYR" @if($setting->currency == 'MYR') selected @endif>MYR - Malaysian Ringgit</option>
                            <option value="THB" @if($setting->currency == 'THB') selected @endif>THB - Thai Baht</option>
                            <option value="Rs" @if($setting->currency == 'Rs') selected @endif>PKR - Rupee</option>
                        </select>
                    </div>

                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.currency_position')}}</label>
                        <select class="form-control" name="currency_position">
                            <option value="">{{__('general.choose')}}</option>
                            <option value="start" @if($setting->currency_position == 'start') selected @endif>{{__('setting.start_position')}}</option>
                            <option value="end" @if($setting->currency_position == 'end') selected @endif>{{__('setting.end_position')}}</option>
                        </select>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">{{__('setting.contact_address')}}</label>
                        <textarea class="form-control" name="address">{{$setting->contact_address}}</textarea>
                    </div>
                    <div class="col-lg-3 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.logo')}}</label>
                        <input class="dropify" type="file" id="logo" name="logo" data-default-file="{{asset($setting->logo)}}">
                    </div>
                    <div class="col-lg-3 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.loader_icon')}}</label>
                        <input class="dropify" type="file" id="loader-logo" name="loader" data-default-file="{{asset($setting->loader)}}">
                    </div>
                    <div class="col-lg-3 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.white_logo')}}</label>
                        <input class="dropify" type="file" id="white" name="white_logo" data-default-file="{{asset($setting->white_logo)}}">
                    </div>
                    <div class="col-lg-3 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.icon')}}</label>
                        <input class="dropify" type="file" id="icon" name="icon" data-default-file="{{asset($setting->icon)}}">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy fs-16 me-1"></i>{{__('general.save_change')}}</button>
            </div>
        </form>
    </div>
</div>
<!-- End::app-content -->

@section('scripts')
<script src="{{ asset('assets/libs/dropify/js/dropify.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify();
    });
</script>
@endsection
@endsection