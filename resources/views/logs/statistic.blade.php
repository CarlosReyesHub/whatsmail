@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/responsive.bootstrap.min.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 mb-2">
        <div class="card custom-card">
            <div class="card-header p-2">
                <div class="card-title">
                    Filter Data
                </div>
            </div>
            <form action="{{route('reports.statistic')}}" method="GET" class="card-body p-2 row">
                <div class="col-lg-6 col-sm-12">
                    <label class="form-label">Mulai Tanggal</label>
                    <input class="form-control" name="start_date" value="<?= request()->get('start_date'); ?>" type="date">
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label class="form-label">Sampai Tanggal</label>
                    <div class="input-group mb-3">
                        <input class="form-control" name="end_date" value="<?= request()->get('end_date'); ?>" type="date">
                        <button class="btn btn-primary" type="submit" >
                            <i class="bx bx-search text-white"></i>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    {{$page}}
                </div>
            </div>
            <div class="card-body">
                <table id="logData" class="table table-bordered text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Device</th>
                            <th scope="col">Sent</th>
                            <th scope="col">Delivered</th>
                            <th scope="col">Not Delivered</th>
                            <th scope="col">Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($devices as $device)
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $device->device->name ?? ''; ?></td>
                            <td><?= number_format($device->sent); ?></td>
                            <td><?= number_format($device->delivered); ?></td>
                            <td><?= number_format($device->not_delivered); ?> </td>
                            <td><?= number_format($device->percent); ?>% </td>
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

        $('#logData').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Cari Device',
                sSearch: '',
            },
            "pageLength": 25,
        });

    });
</script>
@endsection