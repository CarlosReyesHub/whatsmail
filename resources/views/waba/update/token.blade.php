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
        <div class="card">
            <div class="row g-0">
                <x-waba-sidebar-update-component idwaba="{{$device->id}}"></x-waba-sidebar-update-component>
                <form action="<?= route('waba.token.update', $device->id); ?>" enctype="multipart/form-data" method="POST" class="col-12 col-md-10 d-flex flex-column">
                    @csrf
                    <div class="card-body">

                        <div class="row g-3 mt-4">
                            <div class="col-12 mt-3">
                                <label class="form-label">{{__('waba.access_token')}}</label>
                                <input type="text" value="<?=$data['access_token'];?>" class="form-control" name="token" required>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer bg-transparent mt-auto">
                        <div class="btn-list justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy fs-16 me-1"></i>{{__('general.save_change')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection