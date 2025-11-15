<header class="navbar navbar-expand-md d-print-none" data-bs-theme="dark">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{route('index')}}">
                <img src="{{asset($internalSetting->white_logo)}}" class="navbar-brand-image" alt="{{$internalSetting->app_name}}">
            </a>
        </div>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                    @if(auth()->user()->role == 'admin')
                    <a href="{{route('admin.index')}}" class="btn border-info me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-switch-3">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 17h2.397a5 5 0 0 0 4.096 -2.133l.177 -.253m3.66 -5.227l.177 -.254a5 5 0 0 1 4.096 -2.133h3.397" />
                            <path d="M18 4l3 3l-3 3" />
                            <path d="M3 7h2.397a5 5 0 0 1 4.096 2.133l4.014 5.734a5 5 0 0 0 4.096 2.133h3.397" />
                            <path d="M18 20l3 -3l-3 -3" />
                        </svg>
                        {{__('general.admin_panel')}}
                    </a>
                    @endif

                    @if(auth()->user()->role == 'user')
                    <a href="{{route('starter.packages')}}" class="btn border-info me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-switch-3">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 17h2.397a5 5 0 0 0 4.096 -2.133l.177 -.253m3.66 -5.227l.177 -.254a5 5 0 0 1 4.096 -2.133h3.397" />
                            <path d="M18 4l3 3l-3 3" />
                            <path d="M3 7h2.397a5 5 0 0 1 4.096 2.133l4.014 5.734a5 5 0 0 0 4.096 2.133h3.397" />
                            <path d="M18 20l3 -3l-3 -3" />
                        </svg>
                        {{__('general.starter_app')}}
                    </a>
                    @endif
                </div>
            </div>
            <div class="d-none d-md-flex">
                <a href="{{request()->url()}}?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
                    data-bs-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                    </svg>
                </a>
                <a href="{{request()->url()}}?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
                    data-bs-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg>
                </a>
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show Lang">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-flag">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 5a5 5 0 0 1 7 0a5 5 0 0 0 7 0v9a5 5 0 0 1 -7 0a5 5 0 0 0 -7 0v-9z" />
                            <path d="M5 21v-7" />
                        </svg>
                    </a>
                    <div class="dropdown-menu ">
                        <a class="dropdown-item @if($settings->default_lang == 'id') active @endif" href="{{ auth()->user()->role == 'admin' ?  route('admin.setlang','id') : route('setlang','id') }}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Indonesia" data-bs-original-title="Indonesia">
                                    <span class="flag flag-country-id"></span>
                                </span>
                            </span>
                            {{__('sidebar.indonesia')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'en') active @endif" href="{{ auth()->user()->role == 'admin' ?  route('admin.setlang','en') : route('setlang','en') }}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="United States of America" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-us"></span>
                                </span>
                            </span>
                            {{__('sidebar.english')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'hi') active @endif" href="{{ auth()->user()->role == 'admin' ?  route('admin.setlang','hi') : route('setlang','hi') }}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="India" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-in"></span>
                                </span>
                            </span>
                            {{__('sidebar.india')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'pt') active @endif " href="{{ auth()->user()->role == 'admin' ?  route('admin.setlang','pt') : route('setlang','pt') }}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Portugal" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-pt"></span>
                                </span>
                            </span>
                            {{__('sidebar.portugal')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'ru') active @endif " href="{{ auth()->user()->role == 'admin' ?  route('admin.setlang','ru') : route('setlang','ru') }}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Russian" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-ru"></span>
                                </span>
                            </span>
                            {{__('sidebar.russian')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'es') active @endif " href="{{ auth()->user()->role == 'admin' ?  route('admin.setlang','es') : route('setlang','es') }}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Spanish" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-es"></span>
                                </span>
                            </span>
                            {{__('sidebar.spanish')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'de') active @endif " href="{{ auth()->user()->role == 'admin' ?  route('admin.setlang','de') : route('setlang','de') }}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="German" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-de"></span>
                                </span>
                            </span>
                            {{__('sidebar.german')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'tr') active @endif " href="{{ auth()->user()->role == 'admin' ?  route('admin.setlang','tr') : route('setlang','tr') }}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Turkish" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-tr"></span>
                                </span>
                            </span>
                            {{__('sidebar.turkish')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'ar') active @endif" href="{{ auth()->user()->role == 'admin' ?  route('admin.setlang','ar') : route('setlang','ar') }}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Saudi Arabia" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-sa"></span>
                                </span>
                            </span>
                            {{__('sidebar.arab')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'ja') active @endif" href="{{ auth()->user()->role == 'admin' ?  route('admin.setlang','ja') : route('setlang','ja') }}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Japan" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-jp"></span>
                                </span>
                            </span>
                            {{__('sidebar.japan')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'nl') active @endif" href="{{ auth()->user()->role == 'admin' ?  route('admin.setlang','nl') : route('setlang','nl') }}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Ducth" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-nl"></span>
                                </span>
                            </span>
                            {{__('sidebar.dutch')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(<?= asset(auth()->user()->image_data); ?>)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{auth()->user()->name}}</div>
                        <div class="mt-1 small text-secondary">{{auth()->user()->email}}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" data-bs-theme="light">
                    @if(auth()->user()->role == 'admin')
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">{{__('sidebar.profile')}}</a>
                    <a class="dropdown-item" href="{{ route('admin.index') }}">{{__('general.admin_panel')}}</a>
                    @endif

                    @if(auth()->user()->role == 'user')
                    <a class="dropdown-item" href="{{ route('profile') }}">{{__('sidebar.profile')}}</a>
                    <a class="dropdown-item" href="{{ route('starter.packages') }}">{{__('general.starter_app')}}</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">{{__('sidebar.signout')}}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<header class="navbar-expand-md ">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <div class="row flex-fill align-items-center">
                    <div class="col-12">
                        <ul class="navbar-nav">
                            <li class="nav-item {{ request()->is('app')  ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('index')}}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{__('sidebar.dashboard')}}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item dropdown {{ request()->is('app/device*') || request()->is('app/waba*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-autoreply" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                                            <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{__('sidebar.wa_device')}}
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item  {{ request()->is('app/device*')  ? 'active' : '' }}" href="{{route('device')}}" rel="noopener">
                                        Unofficial API's
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/waba*')  ? 'active' : '' }}" href="{{route('waba')}}">
                                        Official API's
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown {{ request()->is('app/users*') || request()->is('app/master/directory/provinces*') || request()->is('app/master/directory/cities*') || request()->is('app/master/directory/districts*') || request()->is('app/master/templates*') || request()->is('app/master/email-template*') || request()->is('app/settings*')  ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-master" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-database-edit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3" />
                                            <path d="M4 6v6c0 1.657 3.582 3 8 3c.478 0 .947 -.016 1.402 -.046" />
                                            <path d="M20 12v-6" />
                                            <path d="M4 12v6c0 1.526 3.04 2.786 6.972 2.975" />
                                            <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{__('sidebar.master_data')}}
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item {{ request()->is('app/users*')  ? 'active' : '' }}" href="{{route('users')}}" rel="noopener">
                                        {{__('sidebar.users')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/master/directory/provinces*')  ? 'active' : '' }}" href="{{route('directory.provinces')}}">
                                        {{__('sidebar.state')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/master/directory/cities*')  ? 'active' : '' }}" href="{{route('directory.cities')}}">
                                        {{__('sidebar.city')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/master/directory/districts*')  ? 'active' : '' }}" href="{{route('directory.districts')}}">
                                        {{__('sidebar.district')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/master/categories*')  ? 'active' : '' }}" href="{{route('categories')}}">
                                        {{__('sidebar.category')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/master/templates*')  ? 'active' : '' }}" href="{{route('templates')}}">
                                        {{__('sidebar.whatsapp_template')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/master/email-template*')  ? 'active' : '' }}" href="{{route('templatemail')}}">
                                        {{__('sidebar.email_template')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/master/media-manager*')  ? 'active' : '' }}" href="{{route('folders')}}">
                                       {{__('sidebar.media_manager')}}
                                    </a>
                                    @if(auth()->user()->role == 'user')
                                    <a class="dropdown-item {{ request()->is('app/settings*')  ? 'active' : '' }}" href="{{route('setting')}}">
                                        {{__('sidebar.configuration')}}
                                    </a>
                                    @endif
                                </div>
                            </li>

                            <li class="nav-item dropdown {{ request()->is('app/auto-reply/chatbot*') || request()->is('app/auto-reply/finetunnel*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-autoreply" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-message-chatbot">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                                            <path d="M9.5 9h.01" />
                                            <path d="M14.5 9h.01" />
                                            <path d="M9.5 13a3.5 3.5 0 0 0 5 0" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{__('sidebar.chatbot_and_ai')}}
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item  {{ request()->is('app/auto-reply/chatbot*')  ? 'active' : '' }}" href="{{route('chatbot')}}" rel="noopener">
                                        {{__('sidebar.chabot')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/auto-reply/finetunnel*')  ? 'active' : '' }}" href="{{route('finetunnel')}}">
                                        {{__('master.device.ai_training')}}
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown {{ request()->is('app/scrapping*') || request()->is('app/stores*') || request()->is('app/blash-email*') || request()->is('app/blash*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-main" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-apps">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M14 7l6 0" />
                                            <path d="M17 4l0 6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{__('sidebar.main')}}
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item {{ request()->is('app/scrapping*')  ? 'active' : '' }}" href="{{route('scrappings')}}" rel="noopener">
                                        {{__('sidebar.scrapp_data')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/stores*')  ? 'active' : '' }}" href="{{route('stores')}}">
                                        {{__('sidebar.contact_data')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/blash-email*')  ? 'active' : '' }}" href="{{route('blash_email')}}">
                                        {{__('sidebar.email_blash')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/blash')  ? 'active' : '' }}" href="{{route('blash')}}">
                                        {{__('sidebar.wa_blash')}}
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown {{ request()->is('app/logs*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-settings" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-report">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                                            <path d="M18 14v4h4" />
                                            <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" />
                                            <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                            <path d="M8 11h4" />
                                            <path d="M8 15h3" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{__('sidebar.log_reports')}}
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item  {{ request()->is('app/logs/statistic')  ? 'active' : '' }}" href="{{route('reports.statistic')}}" rel="noopener">
                                        Statistik Pengiriman
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/logs/whatsapp')  ? 'active' : '' }}" href="{{route('logs.whatsapp')}}">
                                        {{__('sidebar.log_wa')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/logs/email')  ? 'active' : '' }}" href="{{route('logs.email')}}">
                                        {{__('sidebar.log_email')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('app/logs/scraping')  ? 'active' : '' }}" href="{{route('logs.scrapping')}}">
                                        {{__('sidebar.log_scrapp')}}
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>