@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/responsive.bootstrap.min.css')}}">
@endsection


@section('button')
<div class="btn-list">
    <a href="{{route('finetunnel.create')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-circle-plus"></i>
        {{__('general.add_data')}}
    </a>
    <a href="{{route('finetunnel.create')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('general.add_data')}}">
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
                    {{__('page.fine_tunnel.page')}}
                </div>
            </div>
            <div class="card-body">
                <table id="finetunnelData" class="table table-bordered text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">{{__("general.name")}}</th>
                            <th scope="col">{{__('finetunnel.dataset')}}</th>
                            <!-- <th scope="col">{{__("finetunnel.status")}}</th> -->
                            <th scope="col">{{__('finetunnel.method')}}</th>
                            <th scope="col">{{__('general.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finetunnels as $finetunnel)
                        <tr>
                            <td>
                                {{$finetunnel->name}}
                            </td>
                            <td>
                                <?= number_format($finetunnel->details->count()); ?>
                            </td>
                            <!-- <td> 
                                @if($finetunnel->status == 'before_upload')
                                <span class="badge bg-orange text-orange-fg">{{__('finetunnel.before_upload')}}</span>
                                @endif

                                @if($finetunnel->status == 'processed')
                                <span class="badge bg-azure text-azure-fg"> {{__('finetunnel.on_process')}}</span>
                                @endif

                                @if($finetunnel->status == 'succeeded')
                                <span class="badge bg-lime text-azure-fg"> {{__('finetunnel.success')}}</span>
                                @endif

                                @if($finetunnel->status == 'error')
                                <span class="badge bg-red text-azure-fg"> {{__('finetunnel.error')}}</span>
                                @endif
                            </td> -->
                            <td>
                                <?= ($finetunnel->method == 'text' ? __('finetunnel.text') : ($finetunnel->method == 'website' ? __('finetunne.from_url') : __('finetunnel.from_file'))); ?>
                            </td>
                            <td>
                                <div class="dropdown me-1">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="10,20">
                                        {{__('general.action')}}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?= route('finetunnel.update', $finetunnel->id); ?>"><i class="bx bx-pencil me-2"></i> {{__('finetunnel.update')}}</a>
                                        <!-- <a class="dropdown-item" href="<?= asset($finetunnel->filejson); ?>" download><i class="bx bx-download me-2"></i> {{__('finetunnel.download_dataset')}}</a> -->
                                        <!-- @if($finetunnel->status == 'before_upload')
                                        <a class="dropdown-item" href="{{route('finetunnel.upload',$finetunnel->id)}}"><i class="bx bx-upload me-2"></i>{{__('finetunnel.upload')}}</a>
                                        @endif -->
                                        <a class="dropdown-item deletebutton" href="{{route('finetunnel.delete',$finetunnel->id)}}"><i class="bx bx-trash me-2"></i> {{__('finetunnel.delete')}}</a>
                                    </div>
                                </div>
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

        $('#finetunnelData').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: '{{__("blash.search_data")}}',
                sSearch: '',
            },
            "pageLength": 10,
        });

    });
</script>
@endsection