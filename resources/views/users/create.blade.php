@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/libs/dropify/css/dropify.min.css')}}">
@endsection

@section('button')
<div class="btn-list">
    <a href="{{route('users')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-chevron-left"></i>
        {{__('user.back_to_list')}}
    </a>
    <a href="{{route('users')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('user.back_to_list')}}">
        <i class="ti ti-chevron-left"></i>
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <x-validation-component></x-validation-component>
        <form action="<?= route('users.store'); ?>" enctype="multipart/form-data" method="POST" class="card custom-card">
            @csrf
            <div class="card-header">
                <div class="card-title">{{$page}}</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('general.full_name')}}</label>
                                <input class="form-control" name="name" value="{{old('name')}}" type="text" required>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('general.email')}}</label>
                                <input class="form-control" name="email" value="{{old('email')}}" type="email" required>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('general.wa_phone')}}</label>
                                <input class="form-control" name="phone" value="{{old('phone')}}" type="number" required>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('general.new_password')}}</label>
                                <input class="form-control" name="password" type="password" required>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('general.password_confirmation')}}</label>
                                <input class="form-control" name="confirm" type="password" required>
                            </div>
                            <div class="col-12 mt-3">
                                <label class="form-label">{{__('auth.gender')}}</label>
                                <select class="form-control" name="gender">
                                    <option value="male">{{__('general.male')}}</option>
                                    <option value="female">{{__('general.female')}}</option>
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <label class="form-label">{{__('general.photo')}}</label>
                                <input class="dropify" type="file" id="image" name="image" data-default-file="">
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

@section('scripts')
<script src="{{ asset('assets/libs/dropify/js/dropify.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify();
    });
</script>
@endsection