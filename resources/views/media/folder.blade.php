@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/datatable/css/responsive.bootstrap.min.css')}}">
@endsection

@section('button')
<div class="btn-list">
    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalAdd" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-circle-plus"></i>
        {{__('media.add_folder')}}
    </a>
    @if($current_folder)
    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#uploadMedia" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-circle-plus"></i>
        {{__('media.upload_media')}}
    </a>
    @endif
    @if($current_folder)
    <a href="{{route('folder.delete',$current_folder->id)}}" class="btn btn-danger d-none d-sm-inline-block deletebutton">
        <i class="ti ti-trash"></i>
        {{__('media.delete_folder')}}
    </a>
    @endif
    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalAdd" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('general.add_data')}}">
        <i class="ti ti-circle-plus"></i>
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <x-validation-component></x-validation-component>
    </div>

    @if ($sub_folders->count() > 0 || count($directory) > 0)
    <div class="col-12">
        <div class="card">
            @if(count($directory) > 0)
            <div class="card-header">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @foreach ($directory as $index => $value)
                        @php
                        $pathSegment = implode('/', array_slice($directory, 0, $index + 1));
                        @endphp
                        <li class="breadcrumb-item">
                            <a href="{{ route('folders', ['path' => $pathSegment]) }}">{{ $value }}</a>
                        </li>
                        @endforeach
                    </ol>
                </nav>
            </div>
            @endif
            @if ($sub_folders->count() > 0)
            <div class="card-body">
                <div class="row g-5 row-cols-5">
                    @foreach ($sub_folders as $folder)
                    <div class="col">
                        <div class="row">
                            <div class="col-auto">
                                <span class="payment payment-provider-2c2p d-flex justify-content-center  align-items-center">
                                    <i class="ti ti-folder" style="font-size: 25px;"></i>
                                </span>
                            </div>
                            <a href="{{ route('folders', ['path' => ltrim(($path ?? '') . '/' . $folder->slug, '/')]) }}" class="col">
                                <strong class="d-block">{{$folder->name}}</strong>
                                <div class="mt-1">
                                    <code>F {{number_format($folder->subs->count())}} / M {{number_format($folder->media->count())}} </code>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif

    @if(count($media) > 0)
    <div class="row row-cards">
        @foreach ($media as $m)
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body p-4 text-center">
                    <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(<?= asset($m->path); ?>)"></span>
                    <h3 class="m-0 mb-1"><a href="#">{{$m->name}}</a></h3>
                    <div class="text-secondary">{{$m->format}} </div>
                </div>
                <div class="d-flex">
                    <a href="<?=asset($m->path);?>" target="_blank" class="card-btn">
                        <i class="ti ti-click fs-16"></i>
                    </a>
                    <a href="javascript:void(0)" onclick="copyUrl('<?=asset($m->path);?>')" class="card-btn">
                        <i class="ti ti-link fs-16"></i>
                    </a>
                    <a href="{{route('media.delete',$m->id)}}" class="card-btn deletebutton">
                        <i class="ti ti-trash fs-16"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    @endif
</div>

<div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= route('folder.create'); ?>" enctype="multipart/form-data" method="post" class="modal-content">
            @csrf
            <div class="modal-header">
                <h6 class="modal-title" id="modalAddLabel">  {{__('media.add_folder')}} </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body row p-5">
                <div class="col-12">
                    <label class="form-label">  {{__('media.folder_name')}}</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}" required />
                    <input type="hidden" name="folder_id" value="<?= $current_folder ? $current_folder->id : ''; ?>" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary">{{__('general.add_data')}}</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="uploadMedia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= route('media.create'); ?>" enctype="multipart/form-data" method="post" class="modal-content">
            @csrf
            <div class="modal-header">
                <h6 class="modal-title" id="modalAddLabel">{{__('media.upload_media')}} </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body row p-5">
                <div class="col-12">
                    <input type="file" class="form-control" name="file" required />
                    <input type="hidden" name="folder_id" value="<?= $current_folder ? $current_folder->id : ''; ?>" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary">{{__('general.upload_file')}}</button>
            </div>
        </form>
    </div>
</div>
@endsection


@section('scripts')
<script>
    function copyUrl(url) {
        document.execCommand("copy");

        const tempInput = document.createElement("textarea");
        tempInput.value = url;
        document.body.appendChild(tempInput);

        tempInput.select();
        document.execCommand("copy");

        document.body.removeChild(tempInput);

        toastr.success("{{__('general.success_copied')}}", {
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
    }
</script>
@endsection