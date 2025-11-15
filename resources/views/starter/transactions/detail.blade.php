@extends('layouts.starter')


@section('content')
<div class="row">
    <div class="col-12">
        <x-validation-component></x-validation-component>
    </div>
    @if($transaction->status == 'pending')
    <div class="col-lg-8 col-sm-12">
        <form action="{{route('starter.transactions.pay',$transaction->id)}}" method="POST" enctype="multipart/form-data" class="card custom-card">
            @csrf
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">
                    {{__('starter.pay_bill')}}
                </div>
            </div>
            <div class="card-body p-3 row">
                <div class="col-lg-6 col-sm-12 mt-3">
                    <label class="form-label">{{__('starter.insert_bank_name')}}</label>
                    <input class="form-control" name="bank_name" value="{{old('bank_name')}}" type="text">
                </div>

                <div class="col-lg-6 col-sm-12 mt-3">
                    <label class="form-label">{{__('starter.insert_bank_number')}}</label>
                    <input class="form-control" name="bank_number" value="{{old('bank_number')}}" type="text">
                </div>

                <div class="col-lg-6 col-sm-12 mt-3">
                    <label class="form-label">{{__('starter.insert_amount')}}</label>
                    <input class="form-control" name="amount" value="{{old('amount')}}" type="number">
                </div>

                <div class="col-lg-6 col-sm-12 mt-3">
                    <label class="form-label">{{__('starter.upload_file')}}</label>
                    <input class="form-control" name="image" type="file">
                </div>

                <div class="col-12 border-bottom mt-4">
                    <h4>{{__('starter.choose_to_bank')}}</h4>
                </div>

                <div class="col-12 row mt-4">
                    @foreach ($banks as $b)

                    <div class="col-lg-6 mb-3">
                        <label class="form-selectgroup-item flex-fill">
                            <input id="choose-bank" name="to_bank" value="{{$b->id}}" type="radio" class="form-selectgroup-input">
                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                <div class="me-3">
                                    <span class="form-selectgroup-check"></span>
                                </div>
                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                    <span class="avatar me-3" style="background-image: url(<?= asset($b->logo); ?>)"></span>
                                    <div>
                                        <div class="font-weight-medium">{{$b->number}}</div>
                                        <div class="text-secondary">{{$b->name}}</div>
                                    </div>
                                </div>
                            </div>
                        </label>

                    </div>
                    @endforeach

                </div>

                <div class="col-xl-6">

                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">{{__('starter.send_payment')}}</button>
            </div>
        </form>
    </div>
    @else
    <div class="col-lg-8 col-sm-12">
        <div class="card custom-card">
            <div class="card-body text-center">
                @if($transaction->status == 'process')
                <img src="{{asset('assets/img/icons/waiting.svg')}}" class="w-50">
                <h6>{{__('starter.process_payment')}} </h6>
                @endif

                @if($transaction->status == 'success')
                <img src="{{asset('assets/img/icons/connected.svg')}}" class="w-50">
                <h6>{{__('starter.complete_payment')}}</h6>
                @endif
            </div>
        </div>
    </div>
    @endif

    <div class="col-12 col-lg-4">
        <div class="card card-md">
            <div class="ribbon ribbon-top ribbon-bookmark bg-green">
                {{number_format($transaction->add_days)}} {{__('starter.days')}}
            </div>

            <div class="card-body">
                <div class="text-uppercase text-secondary font-weight-medium text-center">{{$transaction->package->name ?? ''}}</div>
                <div class="display-6 fw-bold my-3 text-center">
                    @if((int)($transaction->price ?? 0) > 0)
                    {{platform_currency()->currency_position == 'start' ? platform_currency()->currency : '' }} {{number_format($transaction->price)}} {{platform_currency()->currency_position == 'end' ? platform_currency()->currency : '' }}
                    @else
                    Free
                    @endif
                </div>
                <ul class="list-group simple-list">
                    <li class="list-group-item font-weight-normal">
                        @if($transaction->limit_user_option == 'yes' && $transaction->users_limit == 0)
                        <span class="text-danger">
                            <i class="bx bx-x-circle"></i>
                        </span>
                        @else
                        <span class="text-success">
                            <i class="bx bx-check-circle"></i>
                        </span>
                        @endif

                        {{__('sidebar.users')}}
                        <span class="font-weight-bolder"> ( {{$transaction->limit_user_option == 'yes' ? number_format($transaction->users_limit) : __('starter.unlimited') }} ) </span>
                    </li>
                    <li class="list-group-item font-weight-normal">
                        @if($transaction->limit_device == 'yes' && $transaction->device_limit == 0)
                        <span class="text-danger">
                            <i class="bx bx-x-circle"></i>
                        </span>
                        @else
                        <span class="text-success">
                            <i class="bx bx-check-circle"></i>
                        </span>
                        @endif

                        {{__('sidebar.wa_device')}}
                        <span class="font-weight-bolder"> ( {{$transaction->limit_device == 'yes' ? number_format($transaction->device_limit) : __('starter.unlimited') }} ) </span>
                    </li>
                    <li class="list-group-item font-weight-normal">
                        @if($transaction->limit_whatsapp_option == 'yes' && $transaction->whatsapp_limit == 0)
                        <span class="text-danger">
                            <i class="bx bx-x-circle"></i>
                        </span>
                        @else
                        <span class="text-success">
                            <i class="bx bx-check-circle"></i>
                        </span>
                        @endif

                        {{__('sidebar.wa_blash')}}
                        <span class="font-weight-bolder"> ( {{$transaction->limit_whatsapp_option == 'yes' ? number_format($transaction->whatsapp_limit) : __('starter.unlimited') }} {{$transaction->whatsapp_priode != '' ? '/' : ''}} {{$transaction->whatsapp_priode}} ) </span>
                    </li>
                    <li class="list-group-item font-weight-normal">
                        @if($transaction->limit_email_option == 'yes' && $transaction->email_limit == 0)
                        <span class="text-danger">
                            <i class="bx bx-x-circle"></i>
                        </span>
                        @else
                        <span class="text-success">
                            <i class="bx bx-check-circle"></i>
                        </span>
                        @endif
                        {{__('sidebar.email_blash')}}
                        <span class="font-weight-bolder"> ( {{$transaction->limit_email_option == 'yes' ? number_format($transaction->email_limit) : __('starter.unlimited') }} {{$transaction->email_priode != '' ? '/' : ''}} {{$transaction->email_priode}} ) </span>
                    </li>
                    <li class="list-group-item font-weight-normal">
                        @if($transaction->limit_scrapp_option == 'yes' && $transaction->scrapp_limit == 0)
                        <span class="text-danger">
                            <i class="bx bx-x-circle"></i>
                        </span>
                        @else
                        <span class="text-success">
                            <i class="bx bx-check-circle"></i>
                        </span>
                        @endif
                        {{__('sidebar.scrapp_data')}}
                        <span class="font-weight-bolder"> ( {{$transaction->limit_scrapp_option == 'yes' ? number_format($transaction->scrapp_limit) : __('starter.unlimited') }} {{$transaction->scrapping_priode != '' ? '/' : ''}} {{$transaction->scrapping_priode}} ) </span>
                    </li>
                    <li class="list-group-item font-weight-normal">
                        @if($transaction->limit_template == 'yes' && $transaction->template_limit == 0)
                        <span class="text-danger">
                            <i class="bx bx-x-circle"></i>
                        </span>
                        @else
                        <span class="text-success">
                            <i class="bx bx-check-circle"></i>
                        </span>
                        @endif

                        {{__('sidebar.message_template')}}
                        <span class="font-weight-bolder"> ( {{$transaction->limit_template == 'yes' ? number_format($transaction->template_limit) : __('starter.unlimited') }} ) </span>
                    </li>
                    <li class="list-group-item font-weight-normal">
                        @if($transaction->limit_ai_training == 'yes' && $transaction->ai_training_limit == 0)
                        <span class="text-danger">
                            <i class="bx bx-x-circle"></i>
                        </span>
                        @else
                        <span class="text-success">
                            <i class="bx bx-check-circle"></i>
                        </span>
                        @endif

                        {{__('master.device.ai_training')}}
                        <span class="font-weight-bolder"> ( {{$transaction->limit_ai_training == 'yes' ? number_format($transaction->ai_training_limit) : __('starter.unlimited') }} ) </span>
                    </li>
                    <li class="list-group-item font-weight-normal">
                        @if($transaction->limit_chatbot == 'yes' && $transaction->chatbot_limit == 0)
                        <span class="text-danger">
                            <i class="bx bx-x-circle"></i>
                        </span>
                        @else
                        <span class="text-success">
                            <i class="bx bx-check-circle"></i>
                        </span>
                        @endif

                        {{__('sidebar.chatbot')}}
                        <span class="font-weight-bolder"> ( {{$transaction->limit_chatbot == 'yes' ? number_format($transaction->chatbot_limit) : __('starter.unlimited') }} ) </span>
                    </li>
                </ul>
            </div>
            <div class="card-footer px-4 pb-4 ">
                <ul class="list-group simple-list">
                    <li class="list-group-item font-weight-normal d-flex justify-content-between">
                        <span>{{__('starter.tax')}}</span>
                        <span>{{number_format($transaction->tax)}}</span>
                    </li>
                    <li class="list-group-item font-weight-normal d-flex justify-content-between">
                        <span>{{__('starter.total')}}</span>
                        <span>{{number_format($transaction->final_total)}}</span>
                    </li>
                    <li class="list-group-item font-weight-normal d-flex justify-content-between">
                        <span>{{__('starter.estimate_expire_date')}}</span>
                        <span>{{substr($transaction->expire_date,0,10)}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>

</script>
@endsection