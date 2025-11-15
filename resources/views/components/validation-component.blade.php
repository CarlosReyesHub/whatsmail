@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger"> {{ $error }}</div>
@endforeach
@endif

@if ($message = Session::get('flash'))
<div class="flash-data" data-flashdata="{{ $message }}"></div>
@endif

@if ($message = Session::get('success'))
<div class="flash-data" data-flashdata="{{ $message }}"></div>
@endif

@if ($message = Session::get('gagal'))
<div class="gagal" data-gagal="{{ $message }}"></div>
@endif


@if ($message = Session::get('gagal'))
<div class="alert alert-danger"> {{ $message }}</div>
@endif

@if ($message = Session::get('flash'))
<div class="alert alert-success"> {{ $message }}</div>
@endif

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif