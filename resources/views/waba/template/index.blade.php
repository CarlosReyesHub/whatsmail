@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/responsive.bootstrap.min.css')}}">
@endsection


@section('button')
<div class="btn-list">
    <span class="d-none d-sm-inline">
        <a href="{{route('waba.sync_template',$device->id)}}" class="btn btn-dark">
            <i class="ti ti-refresh me-1"></i> {{__('waba.sync_template')}}
        </a>
    </span>
    <a href="{{route('waba.template.create',$device->id)}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-circle-plus"></i>
        {{__('general.add_data')}}
    </a> 
    <a href="{{route('waba.template.create',$device->id)}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('general.add_data')}}">
        <i class="ti ti-circle-plus"></i>
    </a>
</div>
@endsection


@section('content')
<div class="row">
    <div class="col-xl-12">
        <x-validation-component></x-validation-component>
        <div class="card">
            <div class="row g-0">
                <x-waba-sidebar-update-component idwaba="{{$device->id}}"></x-waba-sidebar-update-component>
                <div class="col-12 col-md-10">
                    <div class="card-body table-responsive">
                        <table id="templateData" class="table table-bordered text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('general.number')}}</th>
                                    <th scope="col">{{__('general.name')}}</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Bahasa</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($templates as $template)
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $template->name; ?></td>
                                    <td><?= $template->category; ?></td>
                                    <td><?= $template->lang; ?></td>
                                    <td><?= $template->waba_status_template; ?></td>
                                    <td>
                                        <a href="<?= route('waba.template.update', [$device->id, $template->id]); ?>" class="btn btn-outline-warning btn-icon fs-16">
                                            <i class="bx bx-pencil "></i>
                                        </a>
                                        <a href="<?= route('waba.template.delete', [$device->id, $template->id]); ?>" class="btn btn-outline-danger btn-icon fs-16 deletebutton">
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

        $('#templateData').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: '{{__("master.template.search")}}',
                sSearch: '',
            },
            "pageLength": 10,
        });

    });
</script>
@endsection