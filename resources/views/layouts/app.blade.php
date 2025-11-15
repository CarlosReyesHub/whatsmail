<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title> {{env('APP_NAME')}} - {{$page}} </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-meta-component></x-meta-component>

    <!-- CSS files -->
    <link href="{{asset('assets/css/tabler.min159a.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/tabler-flags.min159a.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/tabler-payments.min159a.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/tabler-vendors.min159a.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/demo.min159a.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/libs/toastr/toastr.min.css')}}">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

    @yield('styles')
</head>

<body>
    <script src="{{asset('assets/js/demo-theme.min159a.js')}}"></script>
    <!-- Loader -->
    <x-loader-component></x-loader-component>
    <!-- End Loader -->

    <div class="page d-none" id="appdata">

        <!-- Header -->
        <x-header-component></x-header-component>
        <!-- End Header -->

        <div class="page-wrapper">

            @if($breadcumb)
            <!-- Page Header -->
            <div class="page-header d-print-none ">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                {{__('general.admin_panel')}}
                            </div>
                            <h2 class="page-title">
                                {{$page}}
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            @yield('button')
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header -->

            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>

            @else
            <!-- Page Header -->
            <div class="page-header d-print-none ">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                {{__('general.admin_panel')}}
                            </div>
                            <h2 class="page-title">
                                {{$page}}
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header -->

            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>
            @endif

            <x-footer-component></x-footer-component>
        </div>
    </div>
    <script src="{{asset('assets/libs/jquery/jquery-3.6.1.min.js')}}"></script>
    <script src="{{asset('assets/js/tabler.min159a.js')}}" defer></script>
    <script src="{{asset('assets/js/demo.min159a.js')}}" defer></script>
    <script src="{{ asset('assets/libs/sweetalert/sweetalert2.all.min.js')}}" defer></script>
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}" defer></script>
    <script src="{{asset('assets/js/main.js')}}" defer></script>
    @yield('scripts')
</body>

</html>