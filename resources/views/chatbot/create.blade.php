@extends('layouts.app')

@section('styles')
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet">
@endsection

@section('button')
<div class="btn-list">
    <a href="{{route('chatbot')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-chevron-left"></i>
        {{__('chatbot.back_to')}}
    </a>
    <a href="{{route('chatbot')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('chatbot.back_to')}}">
        <i class="ti ti-chevron-left"></i>
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <x-validation-component></x-validation-component>
        <form action="<?= route('chatbot.store'); ?>" method="POST" class="card custom-card">
            @csrf
            <div class="card-header">
                <div class="card-title">{{__("page.chatbot.add")}}</div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mt-3">
                        <label class="form-label">{{__('chatbot.insert_keyword')}} </label>
                        <input type="text" class="form-control" name="keyword" required value="<?= old('keyword'); ?>">
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('chatbot.choose_device')}}</label>
                        <select class="form-control devices" name="device[]" multiple="multiple" required>
                            @foreach ($devices as $device)
                            <option value="<?= $device->id; ?>"><?= $device->phone; ?></option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__("chatbot.method_reply")}}</label>
                        <select class="form-control methodreply" name="method" required>
                            <option value="template" >{{__('general.template')}}</option>
                            <option value="text">{{__('general.text')}}</option>
                            <option value="image">{{__('chatbot.image')}}</option>
                        </select>
                    </div>


                    <div class="col-lg-6 col-sm-12 mt-3 templateform">
                        <label class="form-label">{{__('sidebar.message_template')}}</label>
                        <select class="form-control templates" name="template">
                            <option value="">{{__('blash.choose_template')}}</option>
                            @foreach ($templates as $template)
                            <option value="<?= $template->id; ?>"><?= $template->name; ?></option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 mt-3 messageform d-none">
                        <label class="form-label">{{__('master.device.whatsapp_messanger')}}</label>
                        <textarea class="form-control" style="height: 300px;" name="message">{{old('message')}}</textarea>
                    </div>

                    <div class="mt-4 col-12 d-flex justify-content-between buttonforimage d-none">
                        <h4>
                           {{__('chatbot.images')}}
                        </h4>
                        <button id="addData" class="btn btn-info" type="button">
                            <i class="bx bx-plus-circle"></i> {{__('chatbot.add_image')}}
                        </button>
                    </div>

                    <div class="mt-4 class-12 table-responsive listImage d-none">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('cms.url')}}</th>
                                    <th>{{__('chatbot.caption')}}</th>
                                    <th>{{__('general.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="imageItem">

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
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.devices').select2();
    });

    $('.methodreply').on("change", function() {
        if ($(this).val() == 'text') {
            $(".templateform").addClass('d-none');
            $(".listImage").addClass('d-none');
            $(".buttonforimage").addClass('d-none');
            $(".messageform").removeClass('d-none');
        } else if($(this).val() == 'template') {
            $(".messageform").addClass('d-none');
            $(".listImage").addClass('d-none');
            $(".buttonforimage").addClass('d-none');
            $(".templateform").removeClass('d-none');
        } else if($(this).val() == 'image') {
            $(".messageform").addClass('d-none');
            $(".templateform").addClass('d-none');
            $(".listImage").removeClass('d-none');
            $(".buttonforimage").removeClass('d-none');
        }
    });

    $("#addData").on("click", function() {
        var newItem = `<tr id="imageItem">
                            <td>
                                <input class="form-control" name="url[]" required>
                            </td>
                            <td>
                                <input class="form-control" name="name[]">
                            </td>
                            <td>
                                <button class="btn btn-outline-danger btn-icon fs-16 deleteItem" type="button">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>`;

        $("#imageItem").after(newItem);
    })

    $("body").on("click", ".deleteItem", function() {
        $(this).parents("#imageItem").remove();
    });
</script>
@endsection