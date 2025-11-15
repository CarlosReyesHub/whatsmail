@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/responsive.bootstrap.min.css')}}">
@endsection

@section('button')
<div class="btn-list">
    <a href="{{route('logs.delete')}}" class="btn btn-danger d-none d-sm-inline-block me-1">
        <i class="ti ti-trash"></i>
        {{__('blash.delete_all_log')}}
    </a>
    <a href="{{route('logs.export')}}" class="btn btn-info d-none d-sm-inline-block">
        <i class="ti ti-download"></i>
        {{__('general.export_data')}}
    </a>
    <a href="{{route('logs.delete')}}" class="btn btn-danger d-sm-none btn-icon" aria-label="{{__('general.add_data')}}">
        <i class="ti ti-trash"></i>
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <x-validation-component></x-validation-component>
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">
                    {{$page}}
                </div> 

            </div>
            <div class="card-body table-responsive">
                <table id="resultBlash" class="table table-bordered text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Status</th>
                            <th scope="col">Device</th>
                            <th scope="col">User</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Sent Time</th>
                            <th scope="col">Text</th>
                            <th scope="col">Error</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
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
    $(document).ready(function() {
        const result_blash_table = $('#resultBlash').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Cari Log....',
                sSearch: '',
            },
            "pageLength": 25,
            processing: true,
            serverSide: true,
            aaSorting: [
                [4, 'asc']
            ],
            ajax: {
                "url": '/app/logs/whatsapp',
                "data": function(d) {
                    d = datatable_pasarsafe_callback(d);
                }
            },
            columnDefs: [{
                targets: [4],
                orderable: false,
                searchable: true,
            }, ],
            columns: [{
                    data: 'status_attribute',
                    name: 'status_attribute'
                },
                {
                    data: 'device',
                    name: 'device'
                },
                {
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'sending',
                    name: 'sending'
                },
                {
                    data: 'text_pesan',
                    name: 'text_pesan'
                },
                {
                    data: 'error',
                    name: 'error'
                },
            ],

        });

        $("body").on("click", "#refresh_button", function() {
            result_blash_table.ajax.reload();
        })

    }); 
</script>
@endsection