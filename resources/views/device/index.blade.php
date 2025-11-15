@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/responsive.bootstrap.min.css')}}">
@endsection


@section('button')
<div class="btn-list">
    <span class="d-none d-sm-inline">
        <a href="{{route('device.message')}}" class="btn btn-dark">
            <i class="ti ti-send me-1"></i> Kirim Pesan Single
        </a>
    </span>
    <a href="{{route('device.create')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-circle-plus"></i>
        {{__('general.add_data')}}
    </a>
    <a href="{{route('device.create')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('general.add_data')}}">
        <i class="ti ti-circle-plus"></i>
    </a>
</div>
@endsection

@section('content')
<div class="row">

    <div class="col-md-6 mb-2 col-xl-4">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="bx bx-store icon fs-25"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($summary['all'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('customer.total_device')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-2 col-xl-4">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="bx bx-store icon fs-25"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($summary['active'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('master.device.connected_device')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-2 col-xl-4">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <i class="bx bx-store icon fs-25"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{number_format($summary['not_active'])}}
                        </div>
                        <div class="text-secondary">
                            {{__('master.device.disconnected_device')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-xl-12 mb-3">
        <div class="card custom-card">
            <div class="card-header p-2">
                <div class="card-title">
                    {{__('general.filter_data')}}
                </div>
            </div>
            <form action="{{route('device')}}" method="GET" class="card-body p-2 row">
                <div class="col-lg-6 col-sm-12">
                    <label class="form-label">{{__('general.status')}}</label>
                    <select class="form-control" name="status">
                        <option value="">{{__('general.all')}}</option>
                        <option value="active" @if(request()->get('status') == 'active') selected @endif>{{__('master.device.connected_device')}}</option>
                        <option value="no_active" @if(request()->get('status') == 'no_active') selected @endif>{{__('master.device.disconnected_device')}} </option>
                    </select>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label class="form-label">{{__('master.device.daily_limit')}}</label>
                    <div class="input-group mb-3">
                        <select class="form-control" name="limit">
                            <option value="">{{__('general.all')}}</option>
                            <option value="limit" @if(request()->get('limit') == 'limit') selected @endif >{{__('master.device.reaching_limit')}}</option>
                            <option value="no_limit" @if(request()->get('no_limit') == 'limit') selected @endif>{{__('master.device.not_reaching_limit')}}</option>
                        </select>
                        <button class="btn btn-primary" type="submit">
                            <i class="bx bx-search text-white"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="col-xl-12">
        <x-validation-component></x-validation-component>
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">
                    {{__('master.device.list_device')}}
                </div>
            </div>
            <div class="card-body">
                <table id="whatsappData" class="table table-bordered text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">{{__('general.number')}}</th>
                            <th scope="col">{{__('general.name')}}</th>
                            <th scope="col">{{__('general.wa_phone')}}</th>
                            <th scope="col">{{__('master.device.daily_sent')}}</th>
                            <th scope="col">{{__('master.device.limit_sent')}}</th>
                            <th scope="col">{{__('general.status')}}</th>
                            <th scope="col">{{__('general.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($device as $w)
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $w->name; ?></td>
                            <td><?= $w->phone; ?></td>
                            <td class="text-center">
                                <span class="badge bg-azure text-azure-fg"> <?= number_format($w->daily_send); ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-azure text-azure-fg"> <?= number_format($w->limit_per_day); ?></span>
                            </td>
                            <td> <?= $w->status == 'active' ? __('general.active') : __('general.no_active'); ?></td>
                            <td>
                                <a href="<?= route('device.scan', $w->id); ?>" class="btn btn-sm btn-info ">
                                    <i class="bx bx-qr"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="copyId('<?= $w->id; ?>')" class="btn btn-sm btn-dark ">
                                    <i class="ti ti-unlink"></i>
                                </a>
                                @if($w->status == 'active')
                                <a href="/app/device/chat-app/blank/<?= $w->id; ?>" target="_blank" class="btn btn-sm btn-primary ">
                                    <i class="ti ti-message-plus"></i>
                                </a>
                                @endif
                                <a href="<?= route('device.setting', $w->id); ?>" class="btn btn-sm btn-info">
                                    <i class="bx bx-cog"></i>
                                </a>
                                <a href="<?= route('device.update', $w->id); ?>" class="btn btn-sm btn-warning ">
                                    <i class="bx bx-pencil"></i>
                                </a>
                                <a href="<?= route('device.delete', $w->id); ?>" class="btn btn-sm btn-danger deletebutton">
                                    <i class="bx bx-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/libs/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatable/js/dataTables.responsive.min.js')}}"></script>
<script>
    function copyId(id) {
        document.execCommand("copy");

        const tempInput = document.createElement("textarea");
        tempInput.value = id;
        document.body.appendChild(tempInput);

        tempInput.select();
        document.execCommand("copy");

        document.body.removeChild(tempInput);

        toastr.success("{{__('master.device.copied_device_id')}}", {
            timeOut: 5e3,
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            positionClass: 'toast-top-right',
            preventDuplicates: !0,
            onclick: null,
            showDuration: '100',
            hideDuration: '1000',
            extendedTimeOut: '1000',
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
            tapToDismiss: !1,
        })
    }

    $(function(e) {
        'use strict';

        $('#whatsappData').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: '{{__("master.device.search")}}',
                sSearch: '',
            },
            "pageLength": 10,
        });

    });
</script>
@endsection