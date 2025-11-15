@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/responsive.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/buttons.bootstrap5.min.css')}}">
@endsection

@section('content')
<!-- List Data -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <x-validation-component></x-validation-component>
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">
                    {{$page}}
                </div>
                <div>

                </div>
            </div>
            <div class="card-body">
                <table id="merchantData" class="table table-bordered text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">{{__('customer.register_date')}}</th>
                            <th scope="col">{{__('general.name')}}</th>
                            <th scope="col">{{__('customer.owner')}}</th>
                            <th scope="col">{{__('starter.package_plan')}}</th>
                            <th scope="col">{{__('general.status')}}</th>
                            <th scope="col">{{__('general.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($merchants as $merchant)
                        <tr>
                            <td><?= $merchant->created_at->format('Y-m-d'); ?></td>
                            <td><?= $merchant->name; ?></td>
                            <td><?= $merchant->owner->name ?? ''; ?></td>
                            <td>
                                @if($merchant->package_active)
                                {{$merchant->package_active->package->name ?? ''}} ( {{substr($merchant->package_active->expire_date,0,10)}} )
                                @else
                                {{__('customer.no_active_package')}}
                                @endif
                            </td>
                            <td>
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" onclick="activationData('<?= $merchant->id; ?>',this)" <?= $merchant->status == 'active' ? 'checked' : ''; ?>> 
                                </label> 
                            </td>
                            <td>
                                <a href="<?= route('merchants.detail', $merchant->id); ?>" class="btn btn-outline-info btn-icon fs-16 me-1">
                                    <i class="bx bx-list-check"></i>
                                </a>

                                <a href="<?= route('merchants.signin', $merchant->id); ?>" class="btn btn-outline-warning btn-icon fs-16 ">
                                    <i class="bx bx-key"></i>
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
@endsection


@section('scripts')

<script src="{{asset('assets/libs/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatable/js/dataTables.responsive.min.js')}}"></script>

<script>
    function activationData(id, thisdata) {
        $.ajax({
            url: `/administrator/merchants/status/${id}`,
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

                if (data.merchant == 'no') {
                    $(thisdata).removeAttr('checked');
                } else {
                    $(thisdata).attr('checked');
                }


            },
            cache: false,
            contentType: false,
            processData: false,
        })
    }

    $(function(e) {
        'use strict';

        $('#merchantData').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: '{{__("customer.search")}}',
                sSearch: '',
            },
            "pageLength": 25,
        });

    });
</script>
@endsection