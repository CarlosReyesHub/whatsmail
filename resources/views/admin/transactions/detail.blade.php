@extends('layouts.admin')


@section('styles')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/select2.min.css')}}">
@endsection

@section('button')
<div class="btn-list">
    <a href="{{route('transactions')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-chevron-left"></i>
        {{__('transaction.back_to')}}
    </a>
    <a href="{{route('transactions')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('transaction.back_to')}}">
        <i class="ti ti-chevron-left"></i>
    </a>
</div>
@endsection


@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header d-md-flex d-block">
                <div class="h5 mb-0 d-sm-flex d-bllock align-items-center">
                    <div class="ms-sm-2 ms-0 mt-sm-0 mt-2">
                        <div class="h6 fw-semibold mb-0">{{__('starter.no_ref')}} : <span class="text-primary">#{{$transaction->ref_no}}</span></div>
                    </div>
                </div>
                <div class="ms-auto mt-md-0 mt-2">
                    <!-- <button class="btn btn-secondary me-1">Print<i class="ri-printer-line ms-1 align-middle d-inline-flex"></i></button>
                    <button class="btn btn-info me-1 button-invoice">Export Ke PDF<i class="ri-file-pdf-line ms-1 align-middle d-inline-flex"></i></button> -->
                </div>
            </div>
            <div class="card-body">
                <div class="row gy-3">
                    <div class="col-12 m-0">
                        <x-validation-component></x-validation-component>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <p class="text-muted mb-2">{{__('transaction.from_company')}} : </p>
                                <p class="fw-bold mb-1">{{$setting->app_name}}</p>
                                <p class="mb-1 text-muted">{{$setting->contact_address}}</p>
                                <p class="mb-1 text-muted">{{$setting->email_contect}}</p>
                                <p class="text-muted">{{$setting->phone_contact}}</p>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 ms-auto mt-sm-0 mt-3">
                                <p class="text-muted mb-2">{{__('sidebar.customers')}} : </p>
                                <p class="fw-bold mb-1">{{$transaction->merchant->name ?? ''}} </p>
                                <p class="text-muted mb-1">{{$transaction->merchant->address ?? ''}} </p>
                                <p class="text-muted mb-1">{{$transaction->merchant->owner->phone ?? ''}}</p>
                                <p class="text-muted">{{$transaction->merchant->owner->email ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <p class="fw-semibold text-muted mb-1">{{__('transaction.create_date')}} : </p>
                        <p class="fs-15 mb-1">{{$transaction->created_at->format('Y-m-d')}} - <span class="text-muted fs-12">{{$transaction->created_at->format('H:i:s')}}</span></p>
                    </div>
                    <div class="col-lg-4">
                        <p class="fw-semibold text-muted mb-1">{{__('transaction.payment_date')}} : </p>
                        <p class="fs-15 mb-1">{{$transaction->payment ? $transaction->payment->created_at->format('Y-m-d') : 'Belum Bayar'}}</p>
                    </div>
                    <div class="col-lg-4">
                        <p class="fw-semibold text-muted mb-1">{{__('transaction.status')}} : </p>
                        <p class="fs-16 mb-1 fw-semibold">
                            @if($transaction->status == 'success')
                            {{__('starter.complete')}}
                            @endif

                            @if($transaction->status == 'pending')
                            {{__('starter.pending')}}
                            @endif

                            @if($transaction->status == 'process')
                            {{__('starter.process')}}
                            @endif
                        </p>
                    </div>

                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-sale">
                                <thead>
                                    <tr>
                                        <th>{{__('package.name')}}</th>
                                        <th>{{__('starter.price')}}</th>
                                        <th>{{__('package.add_days')}}</th>
                                        <th>{{__('starter.subtotal')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p class="mb-0" style="font-size: 14px; font-weight: 500;">{{$transaction->package->name ?? ''}} </p>
                                        </td>
                                        <td>
                                            <p class="mb-1">{{number_format($transaction->package->price ?? 0)}}</p>
                                        </td>
                                        <td>
                                            <p class="mb-1">{{number_format($transaction->add_days ?? 0)}}</p>
                                        </td>
                                        <td>
                                            <p class="mb-1"> {{number_format($transaction->package->price ?? 0)}}</p>
                                        </td>

                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="row" colspan="3" class="text-end">{{__('starter.subtotal')}}</th>
                                        <th scope="row"> {{number_format($transaction->package->price ?? 0)}}</th>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3" class="text-end">{{__('starter.tax')}}</th>
                                        <th scope="row"> {{number_format($transaction->tax ?? 0)}}%</th>
                                    </tr>
                                    <tr class="bg-light">
                                        <th colspan="3" class="text-end">{{__('starter.total')}}</th>
                                        <th>{{number_format($transaction->final_total)}} </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($transaction->payment)
    <div class="col-xl-12 mt-4">
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">
                    {{__('transaction.payments')}}
                </div>
            </div>
            <div class="card-body">
                <table id="transactionData" class="table table-bordered text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">{{__('transaction.from_bank')}}</th>
                            <th scope="col">{{__('transaction.to_bank')}}</th>
                            <th scope="col">{{__('transaction.bank_sending')}}</th>
                            <th scope="col">{{__('transaction.amount_payment')}}</th>
                            <th scope="col">{{__('transaction.proof_deliver')}}</th>
                            <th scope="col">{{__('general.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{$transaction->payment->bank_name}} </td>
                            <td>{{$transaction->payment->bank->name ?? ''}}</td>
                            <td>{{$transaction->payment->bank_number}}</td>
                            <td>
                                {{number_format($transaction->payment->amount)}}
                            </td>
                            <td>
                                @if($transaction->payment->file)
                                <a href="{{asset($transaction->payment->file)}}" download class="btn btn-info">
                                    <i class="bx bx-download me-2"></i> {{__('transaction.download_proof')}}
                                </a>
                                @endif
                            </td> 
                            <td>
                                @if($transaction->status == 'process')
                                <a href="<?= route('transactions.payment.approval', $transaction->payment->id); ?>" class="btn btn-success approvebutton">
                                    <i class="bx bx-check-circle text-white"></i> {{__('transaction.approve_payment')}}
                                </a>
                                <a href="<?= route('transactions.payment.rejected', $transaction->payment->id); ?>" class="btn btn-outline-danger btn-icon fs-16 deletebutton">
                                    <i class="bx bx-x-circle text-white"></i> {{__('transaction.reject_payment')}}
                                </a>
                                @endif
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection


@section('scripts')

<script>
$(".approvebutton").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");
    Swal.fire({
        title: "{{__('general.are_you_sure')}}",
        text: "{{__('transaction.warning_action')}}",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ok",
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});
</script>
@endsection