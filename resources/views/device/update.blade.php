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
        <form action="<?= route('device.edit', $device->id); ?>" enctype="multipart/form-data" method="POST" class="card custom-card">
            @csrf
            <div class="card-header">
                <div class="card-title">
                    {{__('page.device.edit')}}
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 mt-3">
                                <label class="form-label">{{__('general.insert_name')}}</label>
                                <input class="form-control" name="name" value="<?= old('name', $device->name); ?>" type="text" required>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">WebHook Url ( {{__('general.optional')}} ) </label>
                                <input class="form-control" name="webhook" value="<?= old('webhook', $device->webhook); ?>" type="url">
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('master.device.auto_reply_method')}}</label>
                                <select class="form-control methodreply" name="method" required>
                                    <option value="all" @if($device->auto_reply_method == 'all') selected @endif>{{__('general.all')}} </option>
                                    <option value="chatbot" @if($device->auto_reply_method == 'chatbot') selected @endif >Chatbot auto Reply ( Manual ) </option>
                                    <option value="ai" @if($device->auto_reply_method == 'ai') selected @endif>Ai</option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('master.device.auto_reply_option')}} </label>
                                <select class="form-control" name="auto_reply_option" required>
                                    <option value="all" @if($device->auto_reply_option == 'all') selected @endif >{{__('general.all')}} </option>
                                    <option value="personal" @if($device->auto_reply_option == 'personal') selected @endif>{{__('general.personal')}}</option>
                                    <option value="group" @if($device->auto_reply_option == 'group') selected @endif>{{__('general.group')}}</option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('master.device.auto_read')}}</label>
                                <select class="form-control" name="auto_read_chatbot" required>
                                    <option value="yes" @if($device->auto_read_before_autorespon == 'yes') selected @endif>{{__('general.yes')}} </option>
                                    <option value="no" @if($device->auto_read_before_autorespon == 'no') selected @endif>{{__('general.no')}}</option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('master.device.auto_read_chatapp')}}</label>
                                <select class="form-control" name="auto_read_chattapp" required>
                                    <option value="yes" @if($device->auto_read_in_chattapp == 'yes') selected @endif>Iya </option>
                                    <option value="no" @if($device->auto_read_in_chattapp == 'no') selected @endif>Tidak</option>
                                </select>
                            </div>

                            <div class="col-12 mt-3 finetunneldata @if($device->auto_reply_method == 'chatbot') d-none @endif ">
                                <label class="form-label">{{__('master.device.ai_training')}} ( Fine Tunnel ) </label>
                                <select class="form-control" name="tunnel">
                                    <option value="">{{__('master.device.choose_ai_training')}}</option>
                                    @foreach ($fineTunnels as $t)
                                    <option value="{{$t->id}}" @if($device->fine_tunnel_id == $t->id) selected @endif>{{$t->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('master.device.just_certain_day')}}</label>
                                <select class="form-control certain_day" name="certain_day" required>
                                    <option value="no" @if($device->auto_reply_certain_day == 'no') selected @endif>{{__('master.device.certain_day_no')}}</option>
                                    <option value="yes" @if($device->auto_reply_certain_day == 'yes') selected @endif>{{__('master.device.certain_day_yes')}} </option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3 @if($device->auto_reply_certain_day == 'no') d-none @endif" id="certain_day">
                                <label class="form-label">{{__('master.device.choose_day')}}</label>
                                <select class="form-control days" name="days[]" multiple>
                                    <option value="mon" {{ in_array('mon', explode(',',$device->days)) ? 'selected' : '' }}>{{__('master.device.monday')}} </option>
                                    <option value="tue" {{ in_array('tue', explode(',',$device->days)) ? 'selected' : '' }}>{{__('master.device.tuesday')}}</option>
                                    <option value="wed" {{ in_array('wed', explode(',',$device->days)) ? 'selected' : '' }}>{{__('master.device.wednesday')}}</option>
                                    <option value="thu" {{ in_array('thu', explode(',',$device->days)) ? 'selected' : '' }}>{{__('master.device.thursday')}}</option>
                                    <option value="fri" {{ in_array('fri', explode(',',$device->days)) ? 'selected' : '' }}>{{__('master.device.friday')}}</option>
                                    <option value="sat" {{ in_array('sat', explode(',',$device->days)) ? 'selected' : '' }}>{{__('master.device.saturday')}}</option>
                                    <option value="sun" {{ in_array('sun', explode(',',$device->days)) ? 'selected' : '' }}>{{__('master.device.sunday')}}</option>
                                </select>
                            </div>


                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('master.device.just_certain_time')}}</label>
                                <select class="form-control certain_time" name="certain_time" required>
                                    <option value="no" @if($device->auto_reply_certain_time == 'no') selected @endif>{{__('master.device.certain_time_no')}}</option>
                                    <option value="yes" @if($device->auto_reply_certain_time == 'yes') selected @endif>{{__('master.device.certain_time_yes')}} </option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3 @if($device->auto_reply_certain_time == 'no') d-none @endif" id="start_time">
                                <label class="form-label">{{__('master.device.start_time')}}</label>
                                <input class="form-control" name="start_time" type="time" value="<?= $device->start_time; ?>">
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3 @if($device->auto_reply_certain_time == 'no') d-none @endif" id="end_time">
                                <label class="form-label">{{__('master.device.end_time')}}</label>
                                <input class="form-control" name="end_time" type="time" value="<?= $device->end_time; ?>">
                            </div>

                            <!-- Option For Daily Limit -->
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('master.device.daily_limit')}}</label>
                                <select class="form-control daily_limit" name="daily_limit" required>
                                    <option value="no" @if($device->daily_limit == 'no') selected @endif>{{__('master.device.limit_no')}}</option>
                                    <option value="yes" @if($device->daily_limit == 'yes') selected @endif>{{__('master.device.limit_yes')}} </option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-sm-12 mt-3 @if($device->daily_limit == 'no') d-none @endif" id="daily_limit">
                                <label class="form-label">{{__('master.device.insert_daily_limit')}}</label>
                                <input class="form-control" name="limit" value="<?= old('limit', $device->limit_per_day); ?>" type="number">
                            </div>
                            <!-- End Option -->

                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy fs-16 me-1"></i>{{__('general.save_change')}}</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.days').select2();
    });

    $(".methodreply").on("change", function() {
        if ($(this).val() == 'ai'  || $(this).val() == 'all') {
            $(".finetunneldata").removeClass('d-none');
        } else if($(this).val() == 'chatbot') {
            $(".finetunneldata").addClass('d-none');
        }
    });

    $(".daily_limit").on("change", function() {
        if ($(this).val() == 'yes') {
            $("#daily_limit").removeClass('d-none');
        } else {
            $("#daily_limit").addClass('d-none');
        }
    })

    $(".certain_day").on("change", function() {
        if ($(this).val() == 'yes') {
            $("#certain_day").removeClass('d-none');
        } else {
            $("#certain_day").addClass('d-none');
        }
    })

    $(".certain_time").on("change", function() {
        if ($(this).val() == 'yes') {
            $("#start_time").removeClass('d-none');
            $("#end_time").removeClass('d-none');
        } else {
            $("#start_time").addClass('d-none');
            $("#end_time").addClass('d-none');
        }
    })
</script>
@endsection