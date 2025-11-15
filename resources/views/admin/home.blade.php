@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="bx bx-wallet icon fs-25"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($summary['saldo_int'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('transaction.monthly_earning')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="bx bx-data fs-25 icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($data['stores'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('transaction.contact_total')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="bx bx-refresh fs-25 icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($data['scrapp'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('general.scrapp_this_month')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="bx bx-send fs-25 icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($data['blashs'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('general.blash_this_month')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">{{__('general.blash_analys')}} </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-6">
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="avatar avatar-md br-5 bg-lime text-primary me-2">
                                <i class='bx bx-up-arrow-circle fs-25 text-white'></i>
                            </span>
                            <div class="">
                                <h5 class="mb-0">{{number_format($data['sending'])}}</h5>
                                <p class="mb-0 fw-semibold">{{__('general.sent')}} </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="avatar avatar-md br-5 bg-orange text-secondary me-2">
                                <i class='bx bx-down-arrow-circle fs-25 text-white'></i>
                            </span>
                            <div class="">
                                <h5 class="mb-0">{{number_format($data['not_sending'])}}</h5>
                                <p class="mb-0 fw-semibold">{{__('general.not_sent')}} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="senderAnalisis"></div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="ti ti-user-check icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($summary['merchant_monthly'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('customer.monthly_customer')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="ti ti-user-check icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($summary['merchant_monthly'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('customer.daily_customer')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="ti ti-user-check icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($summary['transactions'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('transaction.monthly_transaction')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="ti ti-user-check icon"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($data['categories'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('general.total_categories')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-6 col-sm-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">{{__('transaction.must_follow_up_customer')}} </div>
            </div>
            <div class="card-body p-2 row">
                <div class="col-12 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{__('general.name')}}</th>
                                <th>{{__('starter.package_plan')}}</th>
                                <th>{{__('starter.estimate_expire_date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mustFollow as $follow)
                            <tr>
                                <td>{{$follow->merchant->name ?? ''}} </td>
                                <td>{{$follow->package->name ?? ''}} </td>
                                <td>{{substr($follow->last_expire_date,0,10)}} </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">{{__('customer.seven_new_customer')}} </div>
            </div>
            <div class="card-body p-2 row">
                <div class="col-12 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{__('general.name')}}</th>
                                <th>{{__('sidebar.category')}}</th>
                                <th>{{__('starter.package_plan')}}</th>
                                <th>{{__('customer.owner')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($merchants as $merchant)
                            <tr>
                                <td>{{$merchant->name ?? ''}} </td>
                                <td>{{$merchant->category->name ?? ''}} </td>
                                <td>{{$merchant->package_active->package->name ?? ''}} </td>
                                <td>{{$merchant->owner->name ?? ''}} </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between align-items-center">
                <div class="card-title">
                    {{__('sidebar.log_wa')}}
                </div>
                <div class="dropdown">
                    <a href="{{route('logs.whatsapp')}}" class="btn-outline-info btn btn-sm">
                        {{__('general.see_all')}}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    @foreach ($logs['whatsapp'] as $whatsapp)
                    <li class="mb-3">
                        <div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-top justify-content-center">

                                    <div>
                                        <p class="mb-0 fw-semibold fs-14">{{$whatsapp->description}}</p>
                                        <p class="mb-0 fs-12">{{$whatsapp->created_at->format('Y-m-d H:i:s')}}</p>
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-success-transparent badge-sm rounded-pill min-w-fit-content ms-1">
                                        <?= $whatsapp->error == null ? __('general.success') : __('general.failed'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    {{__('sidebar.log_email')}}
                </div>
                <div class="dropdown">
                    <a href="{{route('logs.email')}}" class="btn-outline-info btn btn-sm">
                        {{__('general.see_all')}}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    @foreach ($logs['email'] as $email)
                    <li class="mb-3">
                        <div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-top justify-content-center">

                                    <div>
                                        <p class="mb-0 fw-semibold">{{$email->description}}</p>
                                        <p class="mb-0 fs-12">{{$email->created_at->format('Y-m-d H:i:s')}}</p>
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-success-transparent badge-sm rounded-pill min-w-fit-content ms-1">
                                        <?= $email->error == null ? __('general.success') : __('general.failed'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    {{__('sidebar.log_scrapp')}}
                </div>
                <div class="dropdown">
                    <a href="{{route('logs.scrapping')}}" class="btn-outline-info btn btn-sm ">
                        {{__('general.see_all')}}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    @foreach ($logs['scrapp'] as $scrapp)
                    <li class="mb-3">
                        <div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-top justify-content-center">

                                    <div>
                                        <p class="mb-0 fw-semibold">{{$scrapp->description}}</p>
                                        <p class="mb-0  fs-12">{{$scrapp->created_at->format('Y-m-d H:i:s')}}</p>
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-success-transparent badge-sm rounded-pill min-w-fit-content ms-1">
                                        <?= $scrapp->status == 'success' ? __('general.success') : __('general.failed'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
<script>
    let myVarVal, primaryRGB;

    primaryRGB = getComputedStyle(document.documentElement)
        .getPropertyValue("--primary-rgb")
        .trim();

    //get variable
    myVarVal = localStorage.getItem("primaryRGB") || primaryRGB;
    senderAnalisis();

    function senderAnalisis() {
        'use strict'

        setTimeout(() => {
            fetch('/administrator/dashboard/analisis')
                .then(response => response.json())
                .then(data => {
                    // Extract data from the API response
                    const {
                        sender,
                        not_sender,
                        date
                    } = data.analisis_blash;

                    var options = {
                        series: [{
                            name: '{{__("general.not_sent")}}',
                            data: not_sender,
                        }, {
                            name: '{{__("general.sent")}}',
                            data: sender,
                        }],
                        chart: {
                            stacked: true,
                            type: 'bar',
                            height: 380,
                            toolbar: {
                                show: false
                            }
                        },
                        grid: {
                            borderColor: '#f2f6f7',
                        },
                        colors: ["rgba(" + myVarVal + ", 0.95)", "#4876e6"],
                        plotOptions: {
                            bar: {
                                borderRadius: 0,
                                borderRadiusOnAllStackedSeries: true,
                                colors: {
                                    ranges: [{
                                        from: -100,
                                        to: -46,
                                        color: '#4876e6'
                                    }, {
                                        from: -45,
                                        to: 0,
                                        color: '#4876e6'
                                    }]
                                },
                                columnWidth: '25%',
                            }
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        legend: {
                            show: false,
                            position: 'top',
                            fontFamily: "Mulish",
                            markers: {
                                width: 10,
                                height: 10,
                            }
                        },
                        yaxis: {
                            labels: {
                                formatter: function(y) {
                                    return y.toFixed(0) + "";
                                }
                            }
                        },
                        xaxis: {
                            type: 'category',
                            categories: date,
                            axisBorder: {
                                show: true,
                                color: 'rgba(119, 119, 142, 0.05)',
                                offsetX: 0,
                                offsetY: 0,
                            },
                            axisTicks: {
                                show: true,
                                borderType: 'solid',
                                color: 'rgba(119, 119, 142, 0.05)',
                                width: 6,
                                offsetX: 0,
                                offsetY: 0
                            },
                            labels: {
                                rotate: -90
                            }
                        }
                    };

                    document.getElementById('senderAnalisis').innerHTML = '';
                    var chart = new ApexCharts(document.querySelector("#senderAnalisis"), options);
                    chart.render();
                })
                .catch(error => console.error('Error fetching data:', error));
        }, 300);
    }
</script>
@endsection