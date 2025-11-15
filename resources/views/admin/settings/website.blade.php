@extends('layouts.admin')

@section('content')
<!-- Start::app-content -->
<div class="row">
    <div class="col-lg-12">
        <x-validation-component></x-validation-component>

        <form action="<?= route('website.settings.store'); ?>" enctype="multipart/form-data" method="POST" class="card custom-card">
            @csrf
            <div class="card-header">
                <div class="card-title">
                    {{$page}}
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <label class="form-label fs-15">{{__('setting.web_template')}}</label>
                    </div>
                    <div class="col-md-9 col-sm-12 text-start">
                        <select class="form-control" name="web_template">
                            <option value="template1">Template 01</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <label class="form-label fs-15">{{__('setting.footer')}}</label>
                    </div>
                    <div class="col-md-9 col-sm-12 text-start">
                        <select class="form-control" name="footer_web">
                            <option value="yes" @if($setting->footer_web == 'yes') selected @endif >{{__('general.yes')}}</option>
                            <option value="no" @if($setting->footer_web == 'no') selected @endif>{{__('general.no')}}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <label class="form-label fs-15">Footer Text 1</label>
                    </div>
                    <div class="col-md-9 col-sm-12 text-start">
                        <input class="form-control" name="footer_1" value="<?= $setting->footer_1; ?>" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <label class="form-label fs-15">Footer Text 2</label>
                    </div>
                    <div class="col-md-9 col-sm-12 text-start">
                        <input class="form-control" name="footer_2" value="<?= $setting->footer_2; ?>" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <label class="form-label fs-15">Footer Text 3</label>
                    </div>
                    <div class="col-md-9 col-sm-12 text-start">
                        <input class="form-control" name="footer_3" value="<?= $setting->footer_3; ?>" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <label class="form-label fs-15">Copyright</label>
                    </div>
                    <div class="col-md-9 col-sm-12 text-start">
                        <input class="form-control" name="copyright" value="<?= $setting->copyright; ?>" type="text">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <label class="form-label fs-15">{{__('blog.meta_keyword')}}</label>
                    </div>
                    <div class="col-md-9 col-sm-12 text-start">
                        <input class="form-control" name="keyword" value="<?= $setting->meta_keyword; ?>" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <label class="form-label fs-15">{{__('blog.meta_description')}}</label>
                    </div>
                    <div class="col-md-9 col-sm-12 text-start">
                        <textarea class="form-control" name="description">{{$setting->meta_description}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <label class="form-label fs-15">Footer Text</label>
                    </div>
                    <div class="col-md-9 col-sm-12 text-start">
                        <textarea class="form-control" name="footer">{{$setting->footer_description}}</textarea>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col col-lg-2 col-sm-6 mt-3 text-center">
                        <label class="form-label fs-14">{{__('setting.web_option')}}</label>
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input" name="frontend" type="checkbox" value="yes" @if($setting->frontend == 'yes') checked="" @endif>
                        </div>
                    </div>
                    <div class="col col-lg-2 col-sm-6 mt-3 text-center">
                        <label class="form-label fs-14">{{__('setting.register_option')}}</label>
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input" name="register" type="checkbox" value="yes" @if($setting->register == 'yes') checked="" @endif>
                        </div>
                    </div>
                    <div class="col col-lg-2 col-sm-6 mt-3 text-center">
                        <label class="form-label fs-14">{{__('setting.price_option')}}</label>
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input" name="pricing" type="checkbox" value="yes" @if($setting->pricing == 'yes') checked="" @endif>
                        </div>
                    </div>
                    <div class="col col-lg-2 col-sm-6 mt-3 text-center">
                        <label class="form-label fs-14">{{__('setting.contact_option')}}</label>
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input" name="contact" type="checkbox" value="yes" @if($setting->contact == 'yes') checked="" @endif>
                        </div>
                    </div>
                    <div class="col col-lg-2 col-sm-6 mt-3 text-center">
                        <label class="form-label fs-14">{{__('setting.blog_option')}}</label>
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input" name="blog" type="checkbox" value="yes" @if($setting->blog == 'yes') checked="" @endif>
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
<!-- End::app-content -->

@endsection