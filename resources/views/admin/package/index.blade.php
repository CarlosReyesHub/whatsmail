@extends('layouts.admin')


@section('button')
<div class="btn-list">
    <a href="{{route('packages.create')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-circle-plus"></i>
        {{__('general.add_data')}}
    </a>
    <a href="{{route('packages.create')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('general.add_data')}}">
        <i class="ti ti-circle-plus"></i>
    </a>
</div>
@endsection

@section('content')
<div class="row">

    <div class="col-12">
        <x-validation-component></x-validation-component>

        <div class="row text-gray">
            @foreach ($packages as $package)
            <div class="col-sm-12 col-lg-4">
                <div class="card card-md">
                    <div class="ribbon ribbon-top ribbon-bookmark bg-green">
                        {{number_format($package->add_days)}} {{__('starter.days')}}
                    </div>
                    <div class="card-body ">
                        <div class="text-uppercase text-secondary font-weight-medium text-center">{{$package->name}}</div>
                        <div class="display-6 fw-bold my-3 text-center">
                            @if($package->trial_version == 'no')
                            {{platform_currency()->currency_position == 'start' ? platform_currency()->currency : '' }} {{number_format($package->price)}} {{platform_currency()->currency_position == 'end' ? platform_currency()->currency : '' }}
                            @else
                            Free
                            @endif
                        </div>
                        <ul class="list-group simple-list lh-lg">
                            <li class="list-group-item font-weight-normal">
                                @if($package->limit_user_option == 'yes' && $package->users_limit == 0)
                                <span class="text-danger">
                                    <i class="bx bx-x-circle"></i>
                                </span>
                                @else
                                <span class="text-success">
                                    <i class="bx bx-check-circle"></i>
                                </span>
                                @endif

                                {{__('sidebar.users')}}
                                <span class="font-weight-bolder"> ( {{$package->limit_user_option == 'yes' ? number_format($package->users_limit) : __('starter.unlimited') }} ) </span>
                            </li>
                            <li class="list-group-item font-weight-normal">
                                @if($package->limit_device == 'yes' && $package->device_limit == 0)
                                <span class="text-danger">
                                    <i class="bx bx-x-circle"></i>
                                </span>
                                @else
                                <span class="text-success">
                                    <i class="bx bx-check-circle"></i>
                                </span>
                                @endif

                                {{__('sidebar.wa_device')}}
                                <span class="font-weight-bolder"> ( {{$package->limit_device == 'yes' ? number_format($package->device_limit) : __('starter.unlimited') }} ) </span>
                            </li>
                            <li class="list-group-item font-weight-normal">
                                @if($package->limit_whatsapp_option == 'yes' && $package->whatsapp_limit == 0)
                                <span class="text-danger">
                                    <i class="bx bx-x-circle"></i>
                                </span>
                                @else
                                <span class="text-success">
                                    <i class="bx bx-check-circle"></i>
                                </span>
                                @endif
                                {{__('sidebar.wa_blash')}}
                                <span class="font-weight-bolder"> ( {{$package->limit_whatsapp_option == 'yes' ? number_format($package->whatsapp_limit) : __('starter.unlimited') }} {{$package->whatsapp_priode != '' ? '/' : ''}} {{$package->whatsapp_priode}} ) </span>
                            </li>
                            <li class="list-group-item font-weight-normal">
                                @if($package->limit_email_option == 'yes' && $package->email_limit == 0)
                                <span class="text-danger">
                                    <i class="bx bx-x-circle"></i>
                                </span>
                                @else
                                <span class="text-success">
                                    <i class="bx bx-check-circle"></i>
                                </span>
                                @endif
                                {{__('sidebar.email_blash')}}
                                <span class="font-weight-bolder"> ( {{$package->limit_email_option == 'yes' ? number_format($package->email_limit) : __('starter.unlimited') }} {{$package->email_priode != '' ? '/' : ''}} {{$package->email_priode}} ) </span>
                            </li>
                            <li class="list-group-item font-weight-normal">
                                @if($package->limit_scrapp_option == 'yes' && $package->scrapp_limit == 0)
                                <span class="text-danger">
                                    <i class="bx bx-x-circle"></i>
                                </span>
                                @else
                                <span class="text-success">
                                    <i class="bx bx-check-circle"></i>
                                </span>
                                @endif
                                {{__('sidebar.scrapp_data')}}
                                <span class="font-weight-bolder"> ( {{$package->limit_scrapp_option == 'yes' ? number_format($package->scrapp_limit) : __('starter.unlimited') }} {{$package->scrapping_priode != '' ? '/' : ''}} {{$package->scrapping_priode}} ) </span>
                            </li>
                            <li class="list-group-item font-weight-normal">
                                @if($package->limit_template == 'yes' && $package->template_limit == 0)
                                <span class="text-danger">
                                    <i class="bx bx-x-circle"></i>
                                </span>
                                @else
                                <span class="text-success">
                                    <i class="bx bx-check-circle"></i>
                                </span>
                                @endif
                                {{__('sidebar.message_template')}}
                                <span class="font-weight-bolder"> ( {{$package->limit_template == 'yes' ? number_format($package->template_limit) : __('starter.unlimited') }} ) </span>
                            </li>
                            <li class="list-group-item font-weight-normal">
                                @if($package->limit_ai_training == 'yes' && $package->ai_training_limit == 0)
                                <span class="text-danger">
                                    <i class="bx bx-x-circle"></i>
                                </span>
                                @else
                                <span class="text-success">
                                    <i class="bx bx-check-circle"></i>
                                </span>
                                @endif
                                {{__('master.device.ai_training')}}
                                <span class="font-weight-bolder"> ( {{$package->limit_ai_training == 'yes' ? number_format($package->ai_training_limit) : __('starter.unlimited') }} ) </span>
                            </li>
                            <li class="list-group-item font-weight-normal">
                                @if($package->limit_chatbot == 'yes' && $package->chatbot_limit == 0)
                                <span class="text-danger">
                                    <i class="bx bx-x-circle"></i>
                                </span>
                                @else
                                <span class="text-success">
                                    <i class="bx bx-check-circle"></i>
                                </span>
                                @endif

                                {{__('sidebar.chatbot')}}
                                <span class="font-weight-bolder"> ( {{$package->limit_chatbot == 'yes' ? number_format($package->chatbot_limit) : __('starter.unlimited') }} ) </span>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-center mt-4">
                            <a href="{{route('packages.update',$package->id)}}" class="btn btn-orange w-100 me-1">
                             <i class="bx bx-pencil fs-16 me-1"></i> {{__('package.edit')}}
                            </a>
                            <a href="{{route('packages.delete',$package->id)}}" class="btn w-100 btn-red">
                            <i class="bx bx-trash fs-16 me-1"></i>  {{__('package.delete')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div> 
            @endforeach
        </div>
    </div>
</div>
@endsection