@extends('layouts.admin')

@section('button')
<div class="btn-list">
    <a href="{{route('merchants')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-chevron-left"></i>
        {{__('customer.back_to_list')}}
    </a>
    <a href="{{route('merchants')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('customer.back_to_list')}}">
        <i class="ti ti-chevron-left"></i>
    </a>
</div>
@endsection

@section('content')
<div class="row card shadow-lg mx-1 mt-3 mb-4">
    <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <input type="hidden" id="merchantid" value="{{$merchant->id}}">
                    <img src="{{asset($merchant->owner->image_data ?? '')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{$merchant->owner->name ?? ''}}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{__('customer.owner')}}
                    </p>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 mb-2 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 d-flex justify-content-end">
                <div class="h-100 ">
                    <h5 class="mb-1 text-end">
                        {{$merchant->name}}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{__('customer.register_date')}} : {{$merchant->created_at->format('Y-m-d')}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <!-- Total Customers -->
    <div class="col-md-6 mb-2 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-info text-white avatar">
                            <i class="bx bx-store fs-25"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($data['stores'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('general.total_customers')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Templates -->
    <div class="col-md-6 mb-2 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="bx bx-category fs-25"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($data['template'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('customer.total_template')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scrapp This Month -->
    <div class="col-md-6 mb-2 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-info text-white avatar">
                            <i class="bx bx-refresh fs-25"></i>
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

    <!-- Blast This Month -->
    <div class="col-md-6 mb-2 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-danger text-white avatar">
                            <i class="bx bx-send fs-25"></i>
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

    <!-- AI Training -->
    <div class="col-md-6 mb-2 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-info text-white avatar">
                            <i class="bx bx-bot fs-25"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($data['training'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('master.device.ai_training')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Chatbot -->
    <div class="col-md-6 mb-2 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="bx bx-chat fs-25"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($data['chatbot'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('customer.total_chatbot')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Device -->
    <div class="col-md-6 mb-2 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-warning text-white avatar">
                            <i class="bx bxl-whatsapp fs-25"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($data['device'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('customer.total_device')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users -->
    <div class="col-md-6 mb-2 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-danger text-white avatar">
                            <i class="bx bx-user-circle fs-25"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($data['users'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('sidebar.users')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">{{__('general.blash_analys')}} </div>

            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-6">
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="avatar avatar-md br-5 bg-primary-transparent text-primary me-2">
                                <i class='bx bx-up-arrow-circle fs-16'></i>
                            </span>
                            <div class="">
                                <h5 class="mb-0">{{number_format($data['sending'])}}</h5>
                                <p class="mb-0 tx-muted">{{__('general.sent')}} </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="avatar avatar-md br-5 bg-info-transparent text-secondary me-2">
                                <i class='bx bx-down-arrow-circle fs-16'></i>
                            </span>
                            <div class="">
                                <h5 class="mb-0">{{number_format($data['not_sending'])}}</h5>
                                <p class="mb-0 tx-muted">{{__('general.not_sent')}} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="senderAnalisis"></div>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 mb-2 col-sm-12">
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
                                        <?= $whatsapp->reports == null ? 'Berhasil' : 'Error'; ?>
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

    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 mb-2 col-sm-12">
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
                                        <?= $email->reports == null ? 'Berhasil' : 'Error'; ?>
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

    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 mb-2 col-sm-12">
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
                                        <?= $scrapp->status == 'success' ? 'Berhasil' : 'Error'; ?>
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
            fetch(`/administrator/merchants/analisis/${$("#merchantid").val()}`)
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