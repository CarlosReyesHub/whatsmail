@extends('layouts.app')

@section('styles')
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet">
@endsection

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
                <form action="{{route('waba.general.update',$device->id)}}" method="POST" class="col-12 col-md-10 d-flex flex-column">
                    @csrf
                    <div class="card-body">
                        <h2 class="mb-4">{{__('package.general_information')}}</h2>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-2 d-flex justify-content-between">
                                            {{__('waba.verified_name')}} : <strong>{{$data['verified_name']}}</strong>
                                        </div>
                                        <div class="mb-2 d-flex justify-content-between">
                                            {{__('waba.phone_connected')}} : <strong>{{$data['display_phone_number']}}</strong>
                                        </div>
                                        <div class="mb-2 d-flex justify-content-between">
                                            {{__('waba.message_limit')}} : <strong>{{$data['messaging_limit_tier']}}</strong>
                                        </div>
                                        <div class="mb-2 d-flex justify-content-between">
                                            {{__('waba.number_status')}} : <strong>{{$data['number_status']}}</strong>
                                        </div>
                                        <div class="mb-2 d-flex justify-content-between">
                                            {{__('waba.waba_id')}} : <strong>{{$data['waba_id']}}</strong>
                                        </div>
                                        <div class="mb-2 d-flex justify-content-between">
                                            {{__('waba.business_verify')}} : <strong>{{$data['quality_rating']}}</strong>
                                        </div>
                                        <div class="mb-2 d-flex justify-content-between">
                                            {{__('waba.account_status')}} : <strong>{{$data['account_review_status']}}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-4">
                            <div class="col-md">
                                <label class="form-label">WebHook Url ( {{__('general.optional')}} ) </label>
                                <input class="form-control" name="webhook" value="<?= old('webhook', $device->webhook); ?>" type="url">
                            </div>
                            <div class="col-md">
                                <label class="form-label">{{__('master.device.daily_limit')}}</label>
                                <select class="form-control daily_limit" name="daily_limit" required>
                                    <option value="no" @if($device->daily_limit == 'no') selected @endif>{{__('master.device.limit_no')}}</option>
                                    <option value="yes" @if($device->daily_limit == 'yes') selected @endif>{{__('master.device.limit_yes')}} </option>
                                </select>
                            </div>
                            <div class="col-md @if($device->daily_limit == 'no') d-none @endif" id="daily_limit">
                                <label class="form-label">{{__('master.device.insert_daily_limit')}}</label>
                                <input class="form-control" name="limit" value="<?= old('limit', $device->limit_per_day); ?>" type="number">
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

@section('scripts')
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
<script>
    $(".daily_limit").on("change", function() {
        if ($(this).val() == 'yes') {
            $("#daily_limit").removeClass('d-none');
        } else {
            $("#daily_limit").addClass('d-none');
        }
    })
</script>
@endsection