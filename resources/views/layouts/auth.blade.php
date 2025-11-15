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
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <div class="page page-center">
        <div class="container container-tight py-4">
            @yield('content')
        </div>
    </div>

    @yield('scripts')
    <script src="{{asset('assets/js/show-password.js')}}" defer></script>

</body>

</html>