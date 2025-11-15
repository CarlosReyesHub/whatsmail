@extends('layouts.app')
 
@section('button')
<div class="btn-list">
    <a href="{{route('waba')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-chevron-left"></i>
        {{__('master.device.back_to_device_list')}}
    </a>
    <a href="{{route('waba')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('master.device.back_to_device_list')}}">
        <i class="ti ti-chevron-left"></i>
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <x-validation-component></x-validation-component>
        <form action="<?= route('waba.store'); ?>" enctype="multipart/form-data" method="POST" class="card custom-card">
            @csrf
            <div class="card-header">
                <div class="card-title">
                    {{__('page.add_device')}}
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('waba.id_app')}}</label>
                                <input class="form-control" name="appid" value="<?= old('appid'); ?>" type="text" required>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('waba.access_token')}}</label>
                                <input class="form-control" name="access_token" value="<?= old('access_token'); ?>" type="text" required>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('waba.phone_number_id')}}</label>
                                <input class="form-control" name="phoneid" value="<?= old('phoneid'); ?>" type="text" required>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('waba.waba_id')}}</label>
                                <input class="form-control" name="businessid" value="<?= old('businessid'); ?>" type="text" required>
                            </div>
   
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy fs-16 me-1"></i>{{__('general.add_data')}}</button>
            </div>
        </form>
    </div>
</div>
@endsection 