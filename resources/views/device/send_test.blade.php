@extends('layouts.app')

@section('styles')
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet">
@endsection


@section('button')
<div class="btn-list">
    <a href="{{route('device')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-chevron-left"></i>
        {{__('master.device.back_to_device_list')}}
    </a>
    <a href="{{route('device')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('master.device.back_to_device_list')}}">
        <i class="ti ti-chevron-left"></i>
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <x-validation-component></x-validation-component>
        <form action="<?= route('device.message.store'); ?>" enctype="multipart/form-data" method="POST" class="card custom-card">
            @csrf 
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">From Device</label>
                                <select class="form-control device" name="device" required>
                                    <option value="">{{__('general.choose')}} </option>
                                    @foreach ($devices as $device)
                                    <option value="{{$device->id}}" @if($device->id == old('device')) selected @endif >{{$device->name}} - {{$device->phone}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">Type</label>
                                <select class="form-control" name="type" required>
                                    <option value="personal" @if('personal'==old('type')) selected @endif>{{__('general.personal')}} </option>
                                    <option value="group" @if('group'==old('type')) selected @endif>{{__('general.group')}} </option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">To Number / Group ID</label>
                                <input class="form-control" name="phone" value="<?= old('phone'); ?>" type="number" required>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('sidebar.message_template')}}</label>
                                <select class="form-control template" name="template" required>
                                    <option value="">{{__('general.choose')}} </option>
                                    @foreach ($templates as $template)
                                    <option value="{{$template->id}}" @if($template->id == old('template')) selected @endif >{{$template->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy fs-16 me-1"></i>Kirim Pesan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.device').select2();
        $('.template').select2();
    });
</script>
@endsection