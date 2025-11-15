@extends('layouts.app')

@section('button')
<div class="btn-list">
    <a href="{{route('finetunnel')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-chevron-left"></i>
        {{__('finetunnel.back_to')}}
    </a>
    <a href="{{route('finetunnel')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('finetunnel.back_to')}}">
        <i class="ti ti-chevron-left"></i>
    </a>
</div>
@endsection


@section('content')
<div class="row">
    <div class="col-xl-12">
        <x-validation-component></x-validation-component>
        <form action="<?= route('finetunnel.store'); ?>" method="POST" enctype="multipart/form-data" class="card custom-card">
            @csrf
            <div class="card-header">
                <div class="card-title">{{__('page.fine_tunnel.add')}}</div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('finetunnel.training_name')}} </label>
                        <input type="text" class="form-control" name="name" required value="<?= old('name'); ?>">
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('finetunnel.method')}}</label>
                        <select class="form-control methodtraining" name="method">
                            <option value="text" @if(old('method')=='text' ) selected @endif>{{__('finetunnel.text')}}</option>
                            <option value="file" @if(old('method')=='file' ) selected @endif>{{__('finetunnel.from_file')}}</option>
                            <option value="website" @if(old('method')=='website' ) selected @endif>{{__('finetunnel.from_url')}}</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('finetunnel.use_audi_message')}}</label>
                        <select class="form-control audiotext" name="option_audio_to_text_ai">
                            <option value="">{{__('general.choose')}} </option>
                            <option value="yes" @if(old('option_audio_to_text_ai')=='yes' ) selected @endif>{{__('general.yes')}}</option>
                            <option value="no" @if(old('option_audio_to_text_ai')=='no' ) selected @endif>{{__('general.no')}}</option>
                        </select>
                    </div>

                    <div class="col-lg-6 col-sm-12 mt-3 audiomin @if(old('option_audio_to_text_ai') != 'yes' ) d-none @endif">
                        <label class="form-label">{{__('finetunnel.min_character')}}</label>
                        <input type="number" name="min_audio" value="{{old('min_audio')}}" class="form-control">
                    </div>

                    <div class="col-12 mt-3 textmethod @if(old('method') != 'text' && old('method') != null) d-none @endif">
                        <label class="form-label">{{__('finetunnel.training_description')}}</label>
                        <textarea class="form-control" style="height: 100px;" name="description">{{old('description')}}</textarea>
                    </div>

                    <div class="col-12 mt-3 filemethod @if(old('method') != 'file' ) d-none @endif">
                        <label class="form-label">{{__('finetunnel.upload_file')}}</label>
                        <input type="file" name="file" class="form-control">
                    </div>

                    <div class="col-12 mt-3 urlmethod @if(old('method') != 'website' ) d-none @endif">
                        <label class="form-label">{{__('finetunnel.insert_web_url')}}</label>
                        <input type="url" name="url" value="{{old('url')}}" class="form-control">
                    </div>

                    <div class="mt-4 col-12 d-flex justify-content-between">
                        <h4>
                            {{__('finetunnel.tarining_dataset')}}
                        </h4>
                        <button id="addData" class="btn btn-info" type="button">
                            <i class="bx bx-plus-circle"></i> {{__('finetunnel.add_dataset')}}
                        </button>
                    </div>

                    <div class="mt-4 class-12 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('finetunnel.question')}}</th>
                                    <th>{{__('finetunnel.answer')}}</th>
                                    <th>{{__('general.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="datasetItem">

                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy fs-16 me-1"></i>{{__('general.add_data')}}</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(".methodtraining").on("change", function() {
        var value = $(this).val();

        if (value == 'text') {
            $(".textmethod").removeClass('d-none');
            $(".filemethod").addClass('d-none');
            $(".urlmethod").addClass('d-none');
        }

        if (value == 'file') {
            $(".textmethod").addClass('d-none');
            $(".filemethod").removeClass('d-none');
            $(".urlmethod").addClass('d-none');
        }

        if (value == 'website') {
            $(".textmethod").addClass('d-none');
            $(".filemethod").addClass('d-none');
            $(".urlmethod").removeClass('d-none');
        }
    });

    $(".audiotext").on("change", function() {
        var value = $(this).val();

        if (value == 'yes') {
            $(".audiomin").removeClass('d-none');
        } else {
            $(".audiomin").addClass('d-none');
        }
    });


    $("#addData").on("click", function() {
        var newItem = `<tr id="datasetItem">
                            <td>
                                <input class="form-control" name="command[]" required>
                            </td>
                            <td>
                                <textarea class="form-control" name="answer[]" required></textarea>
                            </td>
                            <td>
                                <button class="btn btn-outline-danger btn-icon fs-16 deleteItem" type="button">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>`;

        $("#datasetItem").after(newItem);
    })

    $("body").on("click", ".deleteItem", function() {
        $(this).parents("#datasetItem").remove();
    });
</script>
@endsection