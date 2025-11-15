@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/responsive.bootstrap.min.css')}}">
@endsection


@section('button')
<div class="btn-list">
    <a href="{{route('waba.broadcast.create',$device->id)}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-circle-plus"></i>
        {{__('general.add_data')}}
    </a>
    <a href="{{route('waba.broadcast.create',$device->id)}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('general.add_data')}}">
        <i class="ti ti-circle-plus"></i>
    </a>
</div>
@endsection


@section('content')
<div class="row">
    <div class="col-xl-12">
        <x-validation-component></x-validation-component>
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">
                    {{__('page.wa.page')}}
                    <button type="button" id="refresh_button" class="d-none"></button>
                </div>
            </div>
            <div class="card-body">
                <table id="blashData" class="table table-bordered text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">{{__('blash.title')}}</th>
                            <th scope="col">{{__('scrapp.schedule')}}</th>
                            <th scope="col">{{__('sidebar.category')}}</th>
                            <th scope="col">{{__('blash.template')}}</th>
                            <th scope="col">{{__('general.status')}}</th>
                            <th scope="col">{{__('general.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($broadcast as $broad)
                        <tr>
                            <td>{{$broad->name}}</td>
                            <td>{{$broad->schedule}}</td>
                            <td>{{$broad->category->name ?? ''}} </td>
                            <td>{{$broad->template->name ?? ''}} </td>
                            <td>
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" onclick="activationData('<?= $broad->id; ?>',this)" <?= $broad->status == 'success' ? '' : 'checked'; ?>>
                                </label>
                            </td>
                            <td>
                                <a href="<?= route('waba.broadcast.update', [$device->id, $broad->id]); ?>" class="btn btn-outline-warning btn-icon fs-16 ">
                                    <i class="bx bx-pencil"></i>
                                </a>
                                <a href="<?= route('waba.broadcast.detail', [$device->id, $broad->id]); ?>" class="btn btn-outline-info btn-icon fs-16 ">
                                    <i class="bx bx-detail"></i>
                                </a>
                                <a href="<?= route('blash.delete', $broad->id); ?>" class="btn btn-outline-danger btn-icon fs-16 deletebutton">
                                    <i class="bx bx-trash "></i>
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
    $(function(e) {
        'use strict';

        $('#blashData').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: '{{__("blash.search")}}',
                sSearch: '',
            },
            "pageLength": 10,
        });

    });

    function activationData(id, thisdata) {
        $.ajax({
            url: `/app/blash/status/${id}`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                Accept: 'application/json',
                'Content-Type': 'application/json',
                timeout: 0,
            },
            data: '',
            success: function(data) {
                toastr.success(data.message, {
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
                document.getElementById("refresh_button").click();

            },
            cache: false,
            contentType: false,
            processData: false,
        })
    }
</script>
@endsection