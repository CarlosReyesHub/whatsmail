@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/responsive.bootstrap.min.css')}}">
@endsection


@section('button')
<div class="btn-list">
    <span class="d-none d-sm-inline">
        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalImport" class="btn btn-dark">
            <i class="ti ti-upload me-1"></i> {{__('general.import')}}
        </a>
    </span>
    <a href="{{route('directory.district.create')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-circle-plus"></i>
        {{__('general.add_data')}}
    </a>
    <a href="{{route('directory.district.create')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('general.add_data')}}">
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
                    {{__('page.district.page')}}
                </div> 
            </div>
            <div class="card-body">
                <input type="hidden" id="paramsData" value="<?= $params; ?>" />
                <table id="districtData" class="table table-bordered text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">{{__('general.id')}}</th>
                            <th scope="col">{{__('general.name')}}</th>
                            <th scope="col">{{__('sidebar.city')}}</th>
                            <th scope="col">{{__('sidebar.state')}}</th>
                            <th scope="col">{{__('master.directory.total_customer')}}</th>
                            <th scope="col">{{__('general.action')}}</th>
                        </tr>
                    </thead>
                    <tbody> </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Import Data -->
<div class="modal fade" id="modalImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= route('directory.district.import'); ?>" enctype="multipart/form-data" method="post" class="modal-content">
            @csrf
            <div class="modal-header">
                <h6 class="modal-title" id="modalImportLabel">{{__('master.directory.import_district')}} </h6>
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

                <a href="{{asset('assets/xlsx/import_district.xlsx')}}" class="btn btn-outline-info" download>{{__('general.download_sample')}}</a>
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
    $(document).ready(function() {
        const district_table = $('#districtData').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: '{{__("master.directory.seacrh_district")}}',
                sSearch: '',
            },
            "pageLength": 25,
            processing: true,
            serverSide: true,
            aaSorting: [
                [2, 'asc']
            ],
            ajax: {
                "url": '/app/master/directory/districts?' + $("#paramsData").val(),
                "data": function(d) {
                    d = datatable_pasarsafe_callback(d);
                }
            },
            columnDefs: [{
                targets: [2],
                orderable: false,
                searchable: true,
            }, ],
            columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'province',
                    name: 'province'
                },
                {
                    data: 'stores',
                    name: 'stores'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],

        });

    });
</script>
@endsection