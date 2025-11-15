@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/responsive.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/buttons.bootstrap5.min.css')}}">
@endsection


@section('button')
<div class="btn-list">
    <span class="d-none d-sm-inline">
        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalImport" class="btn btn-dark">
            <i class="ti ti-upload me-1"></i> {{__('general.import')}}
        </a>
    </span>
    <a href="{{route('directory.province.create')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-circle-plus"></i>
        {{__('general.add_data')}}
    </a>
    <a href="{{route('directory.province.create')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('general.add_data')}}">
        <i class="ti ti-circle-plus"></i>
    </a>
</div>
@endsection

@section('content')
<!-- List Data -->
<div class="row">
    <div class="col-xl-12">
        <x-validation-component></x-validation-component>
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">
                    {{__('page.state.page')}}
                </div>
            </div>
            <div class="card-body">
                <table id="provinceData" class="table table-bordered text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">{{__('general.id')}}</th>
                            <th scope="col">{{__('general.name')}}</th>
                            <th scope="col">{{__('general.status')}}</th>
                            <th scope="col">{{__('master.directory.total_city')}}</th>
                            <th scope="col">{{__('general.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($provinces as $province)
                        <tr>
                            <td><?= $province->id; ?></td>
                            <td><?= $province->name; ?></td>
                            <td>
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" onclick="activationData('<?= $province->id; ?>',this)" <?= $province->status == 'active' ? 'checked' : ''; ?>>
                                </label>
                            </td>
                            <td>
                                <a class="text-info" href="<?= route('directory.cities'); ?>?province=<?= $province->id; ?>">
                                    {{number_format($province->cities->count())}} {{__('master.directory.city')}}
                                </a>
                            </td>
                            <td>
                                <a href="<?= route('directory.province.update', $province->id); ?>" class="btn btn-outline-warning btn-icon fs-16 ">
                                    <i class="bx bx-pencil"></i>
                                </a>
                                <a href="<?= route('directory.province.delete', $province->id); ?>" class="btn btn-outline-danger btn-icon fs-16 deletebutton">
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
<!-- End List Data -->

<!-- Import Data -->
<div class="modal fade" id="modalImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= route('directory.province.import'); ?>" enctype="multipart/form-data" method="post" class="modal-content">
            @csrf
            <div class="modal-header">
                <h6 class="modal-title" id="modalImportLabel">{{__('master.directory.import_state')}} </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body row p-5">
                <div class="col-12">
                    <label class="form-label">{{__('general.upload_file')}}</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{asset('assets/xlsx/import_state.xlsx')}}" class="btn btn-outline-info" download>{{__('general.download_sample')}}</a>
                <button type="submit" class="btn btn-outline-primary">{{__('general.import')}}</button>
            </div>
        </form>
    </div>
</div>
<!-- End Import Data -->
@endsection


@section('scripts')

<script src="{{asset('assets/libs/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatable/js/dataTables.responsive.min.js')}}"></script>

<script>
    function activationData(id, thisdata) {
        $.ajax({
            url: `/app/master/directory/status/province/${id}`,
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

                $(thisdata).removeClass('on');

            },
            cache: false,
            contentType: false,
            processData: false,
        })
    }

    $(function(e) {
        'use strict';

        $('#provinceData').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: '{{__("master.directory.search_state")}}',
                sSearch: '',
            },
            "pageLength": 25,
        });

    });
</script>
@endsection