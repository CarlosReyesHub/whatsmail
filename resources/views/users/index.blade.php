@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/responsive.bootstrap.min.css')}}">
@endsection

@section('button')
<div class="btn-list">
    <a href="{{route('users.create')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-circle-plus"></i>
        {{__('general.add_data')}}
    </a>
    <a href="{{route('users.create')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('general.add_data')}}">
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
                    {{$page}}
                </div>
            </div>
            <div class="card-body">
                <table id="usersData" class="table table-bordered text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">{{__('general.name')}}</th>
                            <th scope="col">{{__('general.email')}}</th>
                            <th scope="col">{{__('auth.gender')}}</th>
                            <th scope="col">{{__('general.photo')}}</th>
                            <th scope="col">{{__('general.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td><?= $user->name; ?></td>
                            <td>{{$user->email}} </td>
                            <td>{{$user->gender == 'male' ? __('general.male') : __('general.female')}} </td>
                            <td>
                                <img src="<?= asset($user->image_data); ?>" style="max-width: 100px;" />
                            </td>

                            <td>
                                <a href="<?= route('users.update', $user->id); ?>" class="btn btn-outline-warning btn-icon fs-16 ">
                                    <i class="bx bx-pencil"></i>
                                </a>
                                <a href="<?= route('users.delete', $user->id); ?>" class="btn btn-outline-danger btn-icon fs-16 deletebutton">
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

        $('#usersData').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: '{{__("user.search")}}',
                sSearch: '',
            },
            "pageLength": 10,
        });

    });
</script>
@endsection