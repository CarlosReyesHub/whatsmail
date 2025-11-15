@extends('layouts.starter')
@section('content')
<div class="row">
    <div class="col-12">
        <x-validation-component></x-validation-component>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter table-bordered table-nowrap card-table">
                    <thead>
                        <tr>
                            <td class="w-50">
                                <h2>{{__('starter.package_plan_price')}}</h2>
                                <div class="text-secondary text-wrap">
                                    {{__('starter.package_plan_desc')}}
                                </div>
                            </td>
                            @foreach ($packages as $package)
                            <td class="text-center"> 
                                <div class="text-uppercase text-secondary font-weight-medium">{{$package->name}}</div>
                                <div class="display-6 fw-bold mt-3">
                                    @if($package->trial_version == 'yes') 
                                    Free 
                                    @else 
                                    {{platform_currency()->currency_position == 'start' ? platform_currency()->currency : '' }} {{number_format($package->price)}} {{platform_currency()->currency_position == 'end' ? platform_currency()->currency : '' }}
                                    @endif 
                                </div>
                                <p class="mt-0"> {{number_format($package->add_days)}} {{__('starter.days')}}</p>
                                <a href="{{route('starter.transactions.create',$package->id)}}" class="btn <?= $package->trial_version == 'yes' ? '' : 'btn-green'; ?> w-100">{{__('starter.choose_package')}}</a>
                            </td>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-light">
                            <th colspan="4" class="subheader">Features</th>
                        </tr>
                        <tr>
                            <td> {{__('sidebar.users')}}</td>
                            @foreach ($packages as $package)
                            <td class="text-center">
                                @if($package->limit_user_option == 'yes' && $package->users_limit == 0)
                                <i class="ti ti-x icon text-red"></i>
                                @else
                                <div class="d-flex justify-content-center">
                                    <i class="ti ti-circle-dashed-check icon text-green" style="margin-right: 5px;"></i>
                                    <span>( {{$package->limit_user_option == 'yes' ? strval(number_format($package->users_limit)) : __('starter.unlimited') }} )</span>
                                </div>
                                @endif
                            </td>
                            @endforeach

                        </tr>
                        <tr>
                            <td>{{__('sidebar.wa_device')}}</td>
                            @foreach ($packages as $package)
                            <td class="text-center">
                                @if($package->limit_device == 'yes' && $package->users_limit == 0)
                                <i class="ti ti-x icon text-red"></i>
                                @else
                                <div class="d-flex justify-content-center">
                                    <i class="ti ti-circle-dashed-check icon text-green" style="margin-right: 5px;"></i>
                                    <span>( {{$package->limit_device == 'yes' ? number_format($package->device_limit) : __('starter.unlimited') }} )</span>
                                </div>
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>{{__('sidebar.wa_blash')}}</td>
                            @foreach ($packages as $package)
                            <td class="text-center">
                                @if($package->limit_whatsapp_option == 'yes' && $package->whatsapp_limit == 0)
                                <i class="ti ti-x icon text-red"></i>
                                @else
                                <div class="d-flex justify-content-center">
                                    <i class="ti ti-circle-dashed-check icon text-green" style="margin-right: 5px;"></i>
                                    <span>( {{$package->limit_whatsapp_option == 'yes' ? number_format($package->whatsapp_limit) : __('starter.unlimited') }} )</span>
                                </div>
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td> {{__('sidebar.email_blash')}}</td>
                            @foreach ($packages as $package)
                            <td class="text-center">
                                @if($package->limit_email_option == 'yes' && $package->email_limit == 0)
                                <i class="ti ti-x icon text-red"></i>
                                @else
                                <div class="d-flex justify-content-center">
                                    <i class="ti ti-circle-dashed-check icon text-green" style="margin-right: 5px;"></i>
                                    <span>( {{$package->limit_email_option == 'yes' ? number_format($package->email_limit) : __('starter.unlimited') }} )</span>
                                </div>
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>{{__('sidebar.scrapp_data')}}</td>
                            @foreach ($packages as $package)
                            <td class="text-center">
                                @if($package->limit_scrapp_option == 'yes' && $package->scrapp_limit == 0)
                                <i class="ti ti-x icon text-red"></i>
                                @else
                                <div class="d-flex justify-content-center">
                                    <i class="ti ti-circle-dashed-check icon text-green" style="margin-right: 5px;"></i>
                                    <span>( {{$package->limit_scrapp_option == 'yes' ? number_format($package->scrapp_limit) : __('starter.unlimited') }} )</span>
                                </div>
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>{{__('sidebar.message_template')}}</td>
                            @foreach ($packages as $package)
                            <td class="text-center">
                                @if($package->limit_template == 'yes' && $package->template_limit == 0)
                                <i class="ti ti-x icon text-red"></i>
                                @else
                                <div class="d-flex justify-content-center">
                                    <i class="ti ti-circle-dashed-check icon text-green" style="margin-right: 5px;"></i>
                                    <span>( {{$package->limit_template == 'yes' ? number_format($package->template_limit) : __('starter.unlimited') }} )</span>
                                </div>
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>{{__('master.device.ai_training')}}</td>
                            @foreach ($packages as $package)
                            <td class="text-center">
                                @if($package->limit_ai_training == 'yes' && $package->ai_training_limit == 0)
                                <i class="ti ti-x icon text-red"></i>
                                @else
                                <div class="d-flex justify-content-center">
                                    <i class="ti ti-circle-dashed-check icon text-green" style="margin-right: 5px;"></i>
                                    <span>( {{$package->limit_ai_training == 'yes' ? number_format($package->ai_training_limit) : __('starter.unlimited') }} )</span>
                                </div>
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>{{__('sidebar.chatbot')}}</td>
                            @foreach ($packages as $package)
                            <td class="text-center">
                                @if($package->limit_chatbot == 'yes' && $package->chatbot_limit == 0)
                                <i class="ti ti-x icon text-red"></i>
                                @else
                                <div class="d-flex justify-content-center">
                                    <i class="ti ti-circle-dashed-check icon text-green" style="margin-right: 5px;"></i>
                                    <span>( {{$package->limit_chatbot == 'yes' ? number_format($package->chatbot_limit) : __('starter.unlimited') }} )</span>
                                </div>
                                @endif
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            @foreach ($packages as $package)
                            <td>
                                <a href="{{route('starter.transactions.create',$package->id)}}" class="btn <?= $package->trial_version == 'yes' ? '' : 'btn-green'; ?> w-100">{{__('starter.choose_package')}}</a>
                            </td>
                            @endforeach
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(".choosepackage").on("click", function(e) {
        e.preventDefault();
        const href = $(this).attr("href");
        Swal.fire({
            title: "{{__('general.are_you_sure')}}",
            text: "{{__('starter.choose_package_alert')}}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ok",
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        });
    })
</script>
@endsection