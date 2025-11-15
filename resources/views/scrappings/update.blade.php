@extends('layouts.app')

@section('styles')
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet">
@endsection

@section('button')
<div class="btn-list">
    <a href="{{route('scrappings')}}" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-chevron-left"></i>
        {{__('scrapp.back_to')}}
    </a>
    <a href="{{route('scrappings')}}" class="btn btn-primary d-sm-none btn-icon" aria-label="{{__('scrapp.back_to')}}">
        <i class="ti ti-chevron-left"></i>
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
    <x-validation-component></x-validation-component>
        <form action="<?= route('scrappings.edit', $scrapping->id); ?>" method="POST" class="card custom-card">
            @csrf
            <div class="card-header">
                <div class="card-title">{{__('page.scrapp.update')}}</div> 
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('sidebar.state')}}</label>
                        <select class="form-control provinces" name="province" required>
                            <option value="">{{__('master.directory.choose_state')}}</option>
                            @foreach ($provinces as $province)
                            <option value="<?= $province->id; ?>" @if(($scrapping->district->city->province_id ?? '') == $province->id) selected @endif ><?= $province->name; ?></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('sidebar.city')}}</label>
                        <select class="form-control cities" name="city" required>
                            <option value="<?= $scrapping->district->city->id ?? ''; ?>">
                                <?= $scrapping->district->city->type ?? ''; ?>
                                <?= $scrapping->district->city->name ?? ''; ?>
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('sidebar.district')}}</label>
                        <select class="form-control districts" name="district" required>
                            <option value="<?= $scrapping->district_id; ?>"><?= $scrapping->district->name ?? ''; ?></option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('sidebar.category')}}</label>
                        <select class="form-control categories" name="category" required>
                            <option value="">{{__('scrapp.choose_category')}}</option>
                            @foreach ($categories as $category)
                            <option value="<?= $category->id; ?>" @if($category->id == $scrapping->category_id) selected @endif ><?= $category->name; ?></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('general.insert_name')}}</label>
                        <input type="text" class="form-control" name="name" required value="<?= old('name', $scrapping->name); ?>">
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('scrapp.schedule')}}</label>
                        <input type="datetime-local" class="form-control" name="schedule" required value="<?= old('schedule', $scrapping->schedule); ?>">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                 <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy fs-16 me-1"></i>{{__('general.save_change')}}</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.provinces').select2();
        $('.cities').select2();
        $(".districts").select2();
        $(".categories").select2();
    });

    $(".provinces").on("change", function() {

        $(".cities").val("");
        $(".districts").val("");

        $('.cities').select2({
            placeholder: '{{__("master.directory.choose_city")}}',
            ajax: {
                url: `/app/master/components/cities?province=${$(this).val()}`,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.type + ' ' + item.name,
                                id: item.id,
                            }
                        }),
                    }
                },
                cache: false,
            },
        });

    })


    $(".cities").on("change", function() {
        $(".districts").val("");
        $('.districts').select2({
            placeholder: '{{__("master.directory.choose_district")}}',
            ajax: {
                url: `/app/master/components/districts?city=${$(this).val()}`,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id,
                            }
                        }),
                    }
                },
                cache: false,
            },
        });
    })
</script>
@endsection