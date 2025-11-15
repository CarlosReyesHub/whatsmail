<header class="navbar navbar-expand-md navbar-overlap d-print-none" data-bs-theme="dark">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{route('starter.packages')}}">
                <img src="{{asset($internalSetting->white_logo)}}" class="navbar-brand-image" alt="{{$internalSetting->app_name}}">
            </a>
        </div>
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
                <a href="{{request()->url()}}?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
                    data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                    </svg>
                </a>
                <a href="{{request()->url()}}?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
                    data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg>
                </a>
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show Lang">
                        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-flag">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 5a5 5 0 0 1 7 0a5 5 0 0 0 7 0v9a5 5 0 0 1 -7 0a5 5 0 0 0 -7 0v-9z" />
                            <path d="M5 21v-7" />
                        </svg>
                    </a>
                    <div class="dropdown-menu ">
                        <a class="dropdown-item @if($settings->default_lang == 'id') active @endif" href="{{route('setlang','id')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Indonesia" data-bs-original-title="Indonesia">
                                    <span class="flag flag-country-id"></span>
                                </span>
                            </span>
                            {{__('sidebar.indonesia')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'en') active @endif" href="{{route('setlang','en')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="United States of America" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-us"></span>
                                </span>
                            </span>
                            {{__('sidebar.english')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'hi') active @endif" href="{{route('setlang','hi')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="India" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-in"></span>
                                </span>
                            </span>
                            {{__('sidebar.india')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'pt') active @endif " href="{{route('setlang','pt')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Portugal" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-pt"></span>
                                </span>
                            </span>
                            {{__('sidebar.portugal')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'ru') active @endif " href="{{route('setlang','ru')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Russian" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-ru"></span>
                                </span>
                            </span>
                            {{__('sidebar.russian')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'es') active @endif " href="{{route('setlang','es')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Spanish" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-es"></span>
                                </span>
                            </span>
                            {{__('sidebar.spanish')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'de') active @endif " href="{{route('setlang','de')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="German" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-de"></span>
                                </span>
                            </span>
                            {{__('sidebar.german')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'tr') active @endif " href="{{route('setlang','tr')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Turkish" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-tr"></span>
                                </span>
                            </span>
                            {{__('sidebar.turkish')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'ar') active @endif" href="{{route('setlang','ar')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Saudi Arabia" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-sa"></span>
                                </span>
                            </span>
                            {{__('sidebar.arab')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'ja') active @endif" href="{{route('setlang','ja')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Japan" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-jp"></span>
                                </span>
                            </span>
                            {{__('sidebar.japan')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'nl') active @endif" href="{{route('setlang','nl')}}">
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
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">{{__('sidebar.signout')}}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->is('app/starter/packages*')  ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('starter.packages')}}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-rosette-discount-check">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12.01 2.011a3.2 3.2 0 0 1 2.113 .797l.154 .145l.698 .698a1.2 1.2 0 0 0 .71 .341l.135 .008h1a3.2 3.2 0 0 1 3.195 3.018l.005 .182v1c0 .27 .092 .533 .258 .743l.09 .1l.697 .698a3.2 3.2 0 0 1 .147 4.382l-.145 .154l-.698 .698a1.2 1.2 0 0 0 -.341 .71l-.008 .135v1a3.2 3.2 0 0 1 -3.018 3.195l-.182 .005h-1a1.2 1.2 0 0 0 -.743 .258l-.1 .09l-.698 .697a3.2 3.2 0 0 1 -4.382 .147l-.154 -.145l-.698 -.698a1.2 1.2 0 0 0 -.71 -.341l-.135 -.008h-1a3.2 3.2 0 0 1 -3.195 -3.018l-.005 -.182v-1a1.2 1.2 0 0 0 -.258 -.743l-.09 -.1l-.697 -.698a3.2 3.2 0 0 1 -.147 -4.382l.145 -.154l.698 -.698a1.2 1.2 0 0 0 .341 -.71l.008 -.135v-1l.005 -.182a3.2 3.2 0 0 1 3.013 -3.013l.182 -.005h1a1.2 1.2 0 0 0 .743 -.258l.1 -.09l.698 -.697a3.2 3.2 0 0 1 2.269 -.944zm3.697 7.282a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{__('starter.package_plan')}}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('app/starter/transactions*')  ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('starter.transactions')}}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card-pay">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
                                    <path d="M3 10h18" />
                                    <path d="M16 19h6" />
                                    <path d="M19 16l3 3l-3 3" />
                                    <path d="M7.005 15h.005" />
                                    <path d="M11 15h2" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{__('starter.transaction_list')}}
                            </span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</header>