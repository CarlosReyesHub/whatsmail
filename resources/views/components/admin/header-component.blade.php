<header class="navbar navbar-expand-md  d-print-none" data-bs-theme="dark">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{route('admin.index')}}">
                <img src="{{asset($internalSetting->white_logo)}}" class="navbar-brand-image" alt="{{$internalSetting->app_name}}">
            </a>
        </div>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                    <a href="{{route('index')}}" class="btn border-info me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-switch-3">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 17h2.397a5 5 0 0 0 4.096 -2.133l.177 -.253m3.66 -5.227l.177 -.254a5 5 0 0 1 4.096 -2.133h3.397" />
                            <path d="M18 4l3 3l-3 3" />
                            <path d="M3 7h2.397a5 5 0 0 1 4.096 2.133l4.014 5.734a5 5 0 0 0 4.096 2.133h3.397" />
                            <path d="M18 20l3 -3l-3 -3" />
                        </svg>
                        {{__("sidebar.switch_to_app")}}
                    </a>
                    <a href="{{route('transactions')}}" class="btn border-info">
                        {{__('starter.transaction_list')}}
                    </a>
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
                        <a class="dropdown-item @if($settings->default_lang == 'id') active @endif" href="{{route('admin.setlang','id')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Indonesia" data-bs-original-title="Indonesia">
                                    <span class="flag flag-country-id"></span>
                                </span>
                            </span>
                            {{__('sidebar.indonesia')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'en') active @endif" href="{{route('admin.setlang','en')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="United States of America" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-us"></span>
                                </span>
                            </span>
                            {{__('sidebar.english')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'hi') active @endif" href="{{route('admin.setlang','hi')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="India" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-in"></span>
                                </span>
                            </span>
                            {{__('sidebar.india')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'pt') active @endif " href="{{route('admin.setlang','pt')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Portugal" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-pt"></span>
                                </span>
                            </span>
                            {{__('sidebar.portugal')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'ru') active @endif " href="{{route('admin.setlang','ru')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Russian" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-ru"></span>
                                </span>
                            </span>
                            {{__('sidebar.russian')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'es') active @endif " href="{{route('admin.setlang','es')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Spanish" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-es"></span>
                                </span>
                            </span>
                            {{__('sidebar.spanish')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'de') active @endif " href="{{route('admin.setlang','de')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="German" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-de"></span>
                                </span>
                            </span>
                            {{__('sidebar.german')}}
                        </a>

                        <a class="dropdown-item  @if($settings->default_lang == 'tr') active @endif " href="{{route('admin.setlang','tr')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Turkish" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-tr"></span>
                                </span>
                            </span>
                            {{__('sidebar.turkish')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'ar') active @endif" href="{{route('admin.setlang','ar')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Saudi Arabia" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-sa"></span>
                                </span>
                            </span>
                            {{__('sidebar.arab')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'ja') active @endif" href="{{route('admin.setlang','ja')}}">
                            <span class="avatar avatar-xs rounded me-2">
                                <span title="Japan" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <span class="flag flag-country-jp"></span>
                                </span>
                            </span>
                            {{__('sidebar.japan')}}
                        </a>

                        <a class="dropdown-item @if($settings->default_lang == 'nl') active @endif" href="{{route('admin.setlang','nl')}}">
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
                    <a href="{{ route('admin.profile') }}" class="dropdown-item">{{__('sidebar.profile')}} </a>
                    <a href="{{ route('index') }}" class="dropdown-item">{{__("sidebar.switch_to_app")}} </a>
                    <a href="{{ route('transactions') }}" class="dropdown-item">{{__('starter.transaction_list')}} </a>
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
<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <div class="row flex-fill align-items-center">
                    <div class="col-12">
                        <ul class="navbar-nav">
                            <li class="nav-item {{ request()->is('administrator') ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('admin.index')}}">
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
                            <li class="nav-item dropdown {{ request()->is('administrator/merchants*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-merchant" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
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
                                        {{__('sidebar.customers')}}
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item {{ request()->is('administrator/merchants') || request()->is('administrator/merchants/detail*')  ? 'active' : '' }}" href="{{route('merchants')}}" rel="noopener">
                                        {{__('sidebar.customer_list')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('administrator/merchants/categories*')  ? 'active' : '' }}" href="{{route('merchant.categories')}}">
                                        {{__('sidebar.customer_category')}}
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown {{ request()->is('administrator/banks*') || request()->is('administrator/transactions*') || request()->is('administrator/packages*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-saas" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cash-register">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M21 15h-2.5c-.398 0 -.779 .158 -1.061 .439c-.281 .281 -.439 .663 -.439 1.061c0 .398 .158 .779 .439 1.061c.281 .281 .663 .439 1.061 .439h1c.398 0 .779 .158 1.061 .439c.281 .281 .439 .663 .439 1.061c0 .398 -.158 .779 -.439 1.061c-.281 .281 -.663 .439 -1.061 .439h-2.5" />
                                            <path d="M19 21v1m0 -8v1" />
                                            <path d="M13 21h-7c-.53 0 -1.039 -.211 -1.414 -.586c-.375 -.375 -.586 -.884 -.586 -1.414v-10c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h2m12 3.12v-1.12c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2" />
                                            <path d="M16 10v-6c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-4c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414v6m8 0h-8m8 0h1m-9 0h-1" />
                                            <path d="M8 14v.01" />
                                            <path d="M8 17v.01" />
                                            <path d="M12 13.99v.01" />
                                            <path d="M12 17v.01" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{__('sidebar.saas_fitur')}}
                                    </span>
                                </a>
                                <div class="dropdown-menu {{ request()->is('administrator/banks*')  ? 'active' : '' }}">
                                    <a class="dropdown-item" href="{{route('banks')}}" rel="noopener">
                                        {{__('sidebar.master_bank')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('administrator/transactions*')  ? 'active' : '' }}" href="{{route('transactions')}}">
                                        {{__('starter.transaction_list')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('administrator/packages*')  ? 'active' : '' }}" href="{{route('packages')}}">
                                        {{__('starter.package_plan')}}
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown {{ request()->is('administrator/web-app*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-cms" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-layout">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M4 13m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M14 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{__('sidebar.cms_website')}}
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item {{ request()->is('administrator/web-app/pages*')  ? 'active' : '' }}" href="{{route('pages')}}" rel="noopener">
                                        {{__('sidebar.web_page')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('administrator/web-app/blog-categories*')  ? 'active' : '' }}" href="{{route('blog.categories')}}">
                                        {{__('sidebar.blog_category')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('administrator/web-app/blogs*')  ? 'active' : '' }}" href="{{route('blogs')}}">
                                        {{__('sidebar.blog_list')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('administrator/web-app/links*')  ? 'active' : '' }}" href="{{route('links')}}">
                                        {{__('sidebar.web_link')}}
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown {{ request()->is('administrator/settings*') || request()->is('upgrade-versions*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-settings" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{__('sidebar.general_config')}}
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item {{ request()->is('administrator/settings/general') ? 'active' : '' }}" href="{{route('general.settings')}}" rel="noopener">
                                        {{__('sidebar.system_setting')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('administrator/settings/website') ? 'active' : '' }}" href="{{route('website.settings')}}">
                                        {{__('sidebar.web_setting')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('administrator/settings') ? 'active' : '' }}" href="{{route('admin.settings')}}">
                                        {{__('sidebar.general_setting')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('administrator/settings/notifications') ? 'active' : '' }}" href="{{route('notification.settings')}}">
                                        {{__('sidebar.notification_setting')}}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('upgrade-versions') ? 'active' : '' }}" href="{{route('upgrade.versions')}}">
                                        {{__('sidebar.application_update')}}
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