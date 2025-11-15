@extends('layouts.auth')
@section('content')
<div class="text-center mb-4">
    <a href="<?= route('login'); ?>" class="navbar-brand navbar-brand-autodark d-flex justify-content-center">
        <img src="{{asset($internalSetting->logo)}}" class="w-75">
    </a>
</div>
<form class="card card-md" method="POST" action="<?= route('register'); ?>" autocomplete="on" novalidate>
    @csrf
    <div class="card-body businessform">
        <h2 class="card-title text-center mb-4">Buat Akun Bisnis</h2>
        <x-validation-component></x-validation-component>
        <div class="mb-3">
            <label for="user-email" class="form-label">{{__('auth.business_name')}}</label>
            <input type="text" name="business_name" value="<?= old('business_name'); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="user-email" class="form-label ">{{__('auth.business_category')}}</label>
            <select class="form-control" name="category" required>
                <option value="">{{__('auth.choose_b_category')}}</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}" @if($category->id == old('category')) selected @endif >{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="user-email" class="form-label ">{{__('auth.zip_code')}}</label>
            <input type="text" name="zip_code" value="<?= old('zip_code'); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="user-email" class="form-label ">{{__('customer.insert_address')}}</label>
            <textarea class="form-control" name="address" required>{{old('address')}}</textarea>
        </div>

        <div class="form-footer">
            <button type="button" class="btn btn-primary w-100 nextbutton">{{__('auth.next')}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-right ms-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                    <path d="M13 18l6 -6" />
                    <path d="M13 6l6 6" />
                </svg>
            </button>
        </div>
    </div>

    <div class="card-body userform d-none">
        <h2 class="card-title text-center mb-4">Informasi Pengguna</h2>
        <x-validation-component></x-validation-component>
        <div class="mb-3">
            <label for="user-email" class="form-label ">{{__('general.insert_name')}}</label>
            <input type="text" name="name" value="<?= old('name'); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="user-email" class="form-label ">{{__('auth.gender')}}</label>
            <select class="form-control" name="gender" required>
                <option value="male" @if(old('gender')=='male' ) selected @endif>{{__('general.male')}}</option>
                <option value="female" @if(old('female')=='male' ) selected @endif>{{__('general.female')}}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="user-email" class="form-label ">{{__('general.insert_wa')}}</label>
            <input type="text" name="phone" value="<?= old('phone'); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="user-email" class="form-label ">{{__('general.email')}}</label>
            <input type="email" name="email" value="<?= old('email'); ?>" class="form-control" required id="user-email" placeholder="{{__('general.insert_email')}}">
        </div>

        <div class="mb-3">
            <label for="user-password" class="form-label  d-block">{{__('general.new_password')}}</label>
            <input type="password" class="form-control" name="password" required placeholder="{{__('general.insert_password')}}">
        </div>
        <div class="mb-3">
            <label for="user-password" class="form-label  d-block">{{__('general.password_confirmation')}}</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="form-footer d-flex justify-content-center">
            <button type="button" class="btn btn-primary w-100 prebutton me-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left me-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                    <path d="M5 12l6 6" />
                    <path d="M5 12l6 -6" />
                </svg>{{__('auth.previous')}}

            </button>
            <button type="submit" class="btn btn-primary w-100 ms-2">{{__('auth.register_account')}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-send ms-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10 14l11 -11" />
                    <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                </svg>
            </button>
        </div>
    </div>
</form>
<div class="text-center text-secondary mt-3">
    <a href="{{route('login')}}">
        {{__('auth.have_account_login')}}
    </a>
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/libs/jquery/jquery-3.6.1.min.js')}}"></script>
<script>
    $(".nextbutton").on("click", function() {
        $(".businessform").addClass('d-none');
        $(".userform").removeClass('d-none');
    })

    $(".prebutton").on("click", function() {
        $(".businessform").removeClass('d-none');
        $(".userform").addClass('d-none');
    })
</script>
@endsection