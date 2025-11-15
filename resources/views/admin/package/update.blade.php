@extends('layouts.admin')

@section('button')
<div class="btn-list">
    <a href="{{route('packages')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-chevron-left"></i>
        {{__('package.back_to')}}
    </a>
    <a href="{{route('packages')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('package.back_to')}}">
        <i class="ti ti-chevron-left"></i>
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <form action="<?= route('packages.edit', $package->id); ?>" enctype="multipart/form-data" method="POST" class="card custom-card">
            @csrf
            <div class="card-header">
                <div class="card-title">{{$page}}</div>
                <x-validation-component></x-validation-component>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                        <!-- General Information -->
                        <div class="row">
                            <div class="col-12 border-bottom">
                                <blockquote class="blockquote mb-2">
                                    <h4>A. {{__('package.general_information')}}</h4>
                                </blockquote>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('package.name')}}</label>
                                <input class="form-control" name="name" value="{{old('name',$package->name)}}" type="text" required>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('package.add_days')}}</label>
                                <input class="form-control" name="add_days" value="{{old('add_days',(int)$package->add_days)}}" type="number" required>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('package.trial_version')}}</label>
                                <select class="form-control trialversion" name="trial_version">
                                    <option value="">{{__('general.choose')}}</option>
                                    <option value="no" @if(old('trial_version',$package->trial_version) == 'no') selected @endif >{{__('general.no')}}</option>
                                    <option value="yes" @if(old('trial_version',$package->trial_version) == 'yes') selected @endif>{{__('general.yes')}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3 @if(old('trial_version',$package->trial_version) != 'no') d-none @endif formprice">
                                <label class="form-label">{{__('package.price')}}</label>
                                <input class="form-control" name="price" value="{{old('price',(int)$package->price)}}" type="number">
                            </div>
                        </div>
                        <!-- End General Information -->

                        <!-- Users Module -->
                        <div class="row mt-6">
                            <div class="col-12 border-bottom">
                                <blockquote class="blockquote mb-2">
                                    <h4>B. {{__('package.access_user_module')}}</h4>
                                </blockquote>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('package.limit_user')}}</label>
                                <select class="form-control limituser" name="limit_user_option" required>
                                    <option value="">{{__('general.choose')}}</option>
                                    <option value="no" @if(old('limit_user_option',$package->limit_user_option)=='no' ) selected @endif>{{__('package.unlimited')}}</option>
                                    <option value="yes" @if(old('limit_user_option',$package->limit_user_option)=='yes' ) selected @endif>{{__('package.limited')}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3 formlimituser @if(old('limit_user_option',$package->limit_user_option) != 'yes') d-none @endif">
                                <label class="form-label">{{__('package.user_limit')}}</label>
                                <input class="form-control" name="users_limit" value="{{old('users_limit',(int)$package->users_limit)}}" type="number">
                            </div>
                        </div>
                        <!-- End Users Module -->

                        <!-- Whatsapp Module -->
                        <div class="row mt-6">
                            <div class="col-12 border-bottom">
                                <blockquote class="blockquote mb-2">
                                    <h4>C. {{__('package.access_wa_module')}}</h4>
                                </blockquote>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('package.limit_device')}}</label>
                                <select class="form-control limitdevice" name="limit_device" required>
                                    <option value="">{{__('general.choose')}}</option>
                                    <option value="no" @if(old('limit_device',$package->limit_device)=='no' ) selected @endif>{{__('package.unlimited')}}</option>
                                    <option value="yes" @if(old('limit_device',$package->limit_device)=='yes' ) selected @endif>{{__('package.limited')}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('package.send_wa_limit')}}</label>
                                <select class="form-control limitwhatsapp" name="limit_whatsapp_option" required>
                                    <option value="">{{__('general.choose')}}</option>
                                    <option value="no" @if(old('limit_whatsapp_option',$package->limit_whatsapp_option)=='no' ) selected @endif>{{__('package.unlimited')}}</option>
                                    <option value="yes" @if(old('limit_whatsapp_option',$package->limit_whatsapp_option)=='yes' ) selected @endif>{{__('package.limited')}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3 formwhatsapp-priode @if(old('limit_whatsapp_option',$package->limit_whatsapp_option) != 'yes') d-none @endif">
                                <label class="form-label">{{__('package.limit_wa_priode')}}</label>
                                <select class="form-control" name="limit_whatsapp_priode">
                                    <option value="daily" @if(old('limit_whatsapp_priode',$package->limit_whatsapp_priode)=='daily' ) selected @endif>{{__('starter.daily')}}</option>
                                    <option value="monthly" @if(old('limit_whatsapp_priode',$package->limit_whatsapp_priode)=='monthly' ) selected @endif>{{__('starter.monthly')}}</option>
                                    <option value="yearly" @if(old('limit_whatsapp_priode',$package->limit_whatsapp_priode)=='yearly' ) selected @endif>{{__('starter.yearly')}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3 formwhatsapp @if(old('limit_whatsapp_option',$package->limit_whatsapp_option) != 'yes') d-none @endif">
                                <label class="form-label">{{__('package.limit_send_wa')}}</label>
                                <input class="form-control" name="whatsapp_limit" value="{{old('whatsapp_limit',(int)$package->whatsapp_limit)}}" type="number">
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3 @if(old('limit_device',$package->limit_device) != 'yes') d-none @endif formdevice">
                                <label class="form-label">{{__('package.device_limit')}}</label>
                                <input class="form-control" name="device_limit" value="{{old('device_limit',(int)$package->device_limit)}}" type="number">
                            </div>
                        </div>
                        <!-- End Whatsapp Module -->

                        <!-- Email Module -->
                        <div class="row mt-6">
                            <div class="col-12 border-bottom">
                                <blockquote class="blockquote mb-2">
                                    <h4>D. {{__('package.access_email_module')}}</h4>
                                </blockquote>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label ">{{__('package.send_email_limit')}}</label>
                                <select class="form-control emaillimit" name="limit_email_option" required>
                                    <option value="">{{__('general.choose')}}</option>
                                    <option value="no" @if(old('limit_email_option',$package->limit_email_option)=='no' ) selected @endif>{{__('package.unlimited')}}</option>
                                    <option value="yes" @if(old('limit_email_option',$package->limit_email_option)=='yes' ) selected @endif>{{__('package.limited')}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3 formemail-priode @if(old('limit_email_option',$package->limit_email_option) != 'yes') d-none @endif">
                                <label class="form-label">{{__('package.limit_email_priode')}}</label>
                                <select class="form-control" name="limit_email_priode">
                                    <option value="daily" @if(old('limit_email_priode',$package->limit_email_priode)=='daily' ) selected @endif>{{__('starter.daily')}}</option>
                                    <option value="monthly" @if(old('limit_email_priode',$package->limit_email_priode)=='monthly' ) selected @endif>{{__('starter.monthly')}}</option>
                                    <option value="yearly" @if(old('limit_email_priode',$package->limit_email_priode)=='yearly' ) selected @endif>{{__('starter.yearly')}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3 formemail @if(old('limit_email_option',$package->limit_email_option) != 'yes') d-none @endif">
                                <label class="form-label">{{__('package.limit_send_email')}}</label>
                                <input class="form-control" name="email_limit" value="{{old('email_limit',$package->email_limit)}}" type="number">
                            </div>
                        </div>
                        <!-- End Email Module -->

                        <!-- Scrapping Module -->
                        <div class="row mt-6">
                            <div class="col-12 border-bottom">
                                <blockquote class="blockquote mb-2">
                                    <h4>E. {{__('package.access_scrapp_module')}}</h4>
                                </blockquote>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('package.scrapp_data_limit')}}</label>
                                <select class="form-control scrappinglimit" name="limit_scrapp_option" required>
                                    <option value="">{{__('general.choose')}}</option>
                                    <option value="no" @if(old('limit_scrapp_option',$package->limit_scrapp_option)=='no' ) selected @endif>{{__('package.unlimited')}}</option>
                                    <option value="yes" @if(old('limit_scrapp_option',$package->limit_scrapp_option)=='yes' ) selected @endif>{{__('package.limited')}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3 formscrapping-priode @if(old('limit_scrapp_option',$package->limit_scrapp_option) != 'yes') d-none @endif">
                                <label class="form-label">{{__('package.scrapp_priode')}}</label>
                                <select class="form-control" name="limit_scrapp_priode">
                                    <option value="daily" @if(old('limit_scrapp_priode',$package->limit_scrapp_priode)=='daily' ) selected @endif>{{__('starter.daily')}}</option>
                                    <option value="monthly" @if(old('limit_scrapp_priode',$package->limit_scrapp_priode)=='monthly' ) selected @endif>{{__('starter.monthly')}}</option>
                                    <option value="yearly" @if(old('limit_scrapp_priode',$package->limit_scrapp_priode)=='yearly' ) selected @endif>{{__('starter.yearly')}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3 formscrapping @if(old('limit_scrapp_option',$package->limit_scrapp_option) != 'yes') d-none @endif">
                                <label class="form-label">{{__('package.limit_secrapp_data')}}</label>
                                <input class="form-control" name="scrapp_limit" value="{{old('scrapp_limit',(int)$package->scrapp_limit)}}" type="number">
                            </div>
                        </div>
                        <!-- End Scrapping Module -->

                        <!-- Template Module -->
                        <div class="row mt-6">
                            <div class="col-12 border-bottom">
                                <blockquote class="blockquote mb-2">
                                    <h4>F. {{__('package.access_template')}}</h4>
                                </blockquote>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('package.limit_template')}}</label>
                                <select class="form-control templatelimit" name="limit_template" required>
                                    <option value="">{{__('general.choose')}}</option>
                                    <option value="no" @if(old('limit_template',$package->limit_template)=='no' ) selected @endif>{{__('package.unlimited')}}</option>
                                    <option value="yes" @if(old('limit_template',$package->limit_template)=='yes' ) selected @endif>{{__('package.limited')}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3 formtemplate @if(old('limit_template',$package->limit_template) != 'yes') d-none @endif">
                                <label class="form-label">{{__('package.template_limit')}}</label>
                                <input class="form-control" name="template_limit" value="{{old('template_limit',$package->template_limit)}}" type="number">
                            </div>
                        </div>
                        <!-- End Module Template -->

                        <!-- Ai Training Module -->
                        <div class="row mt-6">
                            <div class="col-12 border-bottom">
                                <blockquote class="blockquote mb-2">
                                    <h4>G. {{__('package.access_ai_training')}}</h4>
                                </blockquote>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('package.limit_ai')}}</label>
                                <select class="form-control ailimit" name="limit_ai_training" required>
                                    <option value="">{{__('general.choose')}}</option>
                                    <option value="no" @if(old('limit_ai_training',$package->limit_ai_training)=='no' ) selected @endif>{{__('package.unlimited')}}</option>
                                    <option value="yes" @if(old('limit_ai_training',$package->limit_ai_training)=='yes' ) selected @endif>{{__('package.limited')}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3 formai @if(old('limit_ai_training',$package->limit_ai_training) != 'yes') d-none @endif">
                                <label class="form-label">{{__('package.ai_limit')}}</label>
                                <input class="form-control" name="ai_training_limit" value="{{old('ai_training_limit',(int)$package->ai_training_limit)}}" type="number">
                            </div>
                        </div>
                        <!-- End Ai Training Module -->

                        <!-- Chatbot Auto Reply -->
                        <div class="row mt-6">
                            <div class="col-12 border-bottom">
                                <blockquote class="blockquote mb-2">
                                    <h4>H. {{__('package.access_chatbot')}}</h4>
                                </blockquote>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <label class="form-label">{{__('package.limit_chatbot')}}</label>
                                <select class="form-control chatbotlimit" name="limit_chatbot" required>
                                    <option value="">{{__('general.choose')}}</option>
                                    <option value="no" @if(old('limit_chatbot',$package->limit_chatbot)=='no' ) selected @endif>{{__('package.unlimited')}}</option>
                                    <option value="yes" @if(old('limit_chatbot',$package->limit_chatbot)=='yes' ) selected @endif>{{__('package.limited')}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-3 formchatbot @if(old('limit_chatbot',$package->limit_chatbot) != 'yes') d-none @endif">
                                <label class="form-label">{{__('package.chatbot_limit')}}</label>
                                <input class="form-control" name="chatbot_limit" value="{{old('chatbot_limit',(int)$package->chatbot_limit)}}" type="number">
                            </div>
                        </div>
                        <!-- End ChatBot -->

                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy fs-16 me-1"></i> {{__('general.save_change')}}</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(".trialversion").on("change", function() {
        if ($(this).val() == 'no') {
            $(".formprice").removeClass('d-none');
        } else {
            $(".formprice").addClass('d-none');
        }
    });

    $(".limituser").on("change", function() {
        if ($(this).val() == 'yes') {
            $(".formlimituser").removeClass('d-none');
        } else {
            $(".formlimituser").addClass('d-none');
        }
    });

    $(".limitdevice").on("change", function() {
        if ($(this).val() == 'yes') {
            $(".formdevice").removeClass('d-none');
        } else {
            $(".formdevice").addClass('d-none');
        }
    });

    $(".limitwhatsapp").on("change", function() {
        if ($(this).val() == 'yes') {
            $(".formwhatsapp-priode").removeClass('d-none');
            $(".formwhatsapp").removeClass('d-none');
        } else {
            $(".formwhatsapp-priode").addClass('d-none');
            $(".formwhatsapp").addClass('d-none');
        }
    });

    $(".scrappinglimit").on("change", function() {
        if ($(this).val() == 'yes') {
            $(".formscrapping-priode").removeClass('d-none');
            $(".formscrapping").removeClass('d-none');
        } else {
            $(".formscrapping-priode").addClass('d-none');
            $(".formscrapping").addClass('d-none');
        }
    });

    $(".emaillimit").on("change", function() {
        if ($(this).val() == 'yes') {
            $(".formemail-priode").removeClass('d-none');
            $(".formemail").removeClass('d-none');
        } else {
            $(".formemail-priode").addClass('d-none');
            $(".formemail").addClass('d-none');
        }
    });

    $(".templatelimit").on("change", function() {
        if ($(this).val() == 'yes') {
            $(".formtemplate").removeClass('d-none');
        } else {
            $(".formtemplate").addClass('d-none');
        }
    });

    $(".ailimit").on("change", function() {
        if ($(this).val() == 'yes') {
            $(".formai").removeClass('d-none');
        } else {
            $(".formai").addClass('d-none');
        }
    });

    $(".chatbotlimit").on("change", function() {
        if ($(this).val() == 'yes') {
            $(".formchatbot").removeClass('d-none');
        } else {
            $(".formchatbot").addClass('d-none');
        }
    });
</script>
@endsection