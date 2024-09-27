    
    <header class="@if (get_setting('header_stikcy') == 'on') sticky-top @endif  @if (Route::currentRouteName() == 'home' || Route::currentRouteName() == '/') main-page @endif z-1020">
        <div class="position-relative logo-bar-area z-1025">
            <div class="container">
                <div class="d-flex align-items-end">
                    <!-- top menu sidebar button -->
                    <button type="button" class="btn d-lg-none mr-3 mr-sm-4 p-0 active" data-toggle="class-toggle"
                        data-target=".aiz-top-menu-sidebar">
                        <svg id="Component_43_1" data-name="Component 43 – 1" xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" viewBox="0 0 16 16">
                            <rect id="Rectangle_19062" data-name="Rectangle 19062" width="16" height="2"
                                transform="translate(0 7)" fill="#919199" />
                            <rect id="Rectangle_19063" data-name="Rectangle 19063" width="16" height="2"
                                fill="#919199" />
                            <rect id="Rectangle_19064" data-name="Rectangle 19064" width="16" height="2"
                                transform="translate(0 14)" fill="#919199" />
                        </svg>

                    </button>
                    <!-- Header Logo -->
                    <div class="col-auto pl-0 pr-3 d-flex align-items-center">
                        <a class="d-block py-20px mr-3 ml-0" href="{{ route('home') }}">
                            <img src="{{ uploaded_asset(10) }}" alt="{{ env('APP_NAME') }}"
                                 class="mw-100 h-30px h-md-40px" height="40">
                        </a>
                    </div>
                    <div class="d-none d-lg-block h-50px">
                    <div class="container h-100">
                        <div class="row h-100">
                            <!-- Header Menus -->
                            @php
                                $nav_txt_color = ((get_setting('header_nav_menu_text') == 'light') ||  (get_setting('header_nav_menu_text') == null)) ? 'text-white' : 'text-dark';
                            @endphp
                            <div class="col ml-xl-4 w-100 overflow-hidden">
                                <div class="d-flex align-items-center justify-content-center justify-content-xl-start h-100">
                                    <ul class="list-inline mb-0 pl-0 hor-swipe c-scrollbar-light">
                                        @foreach (get_level_zero_categories()->take(10) as $key => $category)
                                            @php
                                                $category_name = $category->getTranslation('name');
                                            @endphp
                                            <li class="list-inline-item mr-0 animate-underline-white">
                                                <a href="{{ route('products.category', $category->slug) }}"
                                                    class="fs-18 px-3 d-inline-block header_menu_links hov-bg-black-10">
                                                    {{ $category_name }}
                                                </a>
                                            </li>
                                        @endforeach
                                        <li class="list-inline-item mr-0">
                                            <div class="d-flex align-items-center">
                                                <div class="ml-3 mr-0 position-relative">
                                                    <div class="flex-grow-1 front-header-search d-flex align-items-center">
                                                        <div class="position-relative flex-grow-1 px-3 px-lg-0">
                                                            <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                                                                <div class="d-flex position-relative align-items-center">
                                                                    <div class="search-input-box">
                                                                        <input type="text"
                                                                               class="border border-soft-light form-control fs-14 hov-animate-outline"
                                                                               id="search" name="keyword"
                                                                               @isset($query)
                                                                                   value="{{ $query }}"
                                                                               @endisset
                                                                               placeholder="{{ translate('I am shopping for...') }}" autocomplete="off">

                                                                        <svg id="Group_723" data-name="Group 723" xmlns="http://www.w3.org/2000/svg"
                                                                             width="20.001" height="20" viewBox="0 0 20.001 20">
                                                                            <path id="Path_3090" data-name="Path 3090"
                                                                                  d="M9.847,17.839a7.993,7.993,0,1,1,7.993-7.993A8,8,0,0,1,9.847,17.839Zm0-14.387a6.394,6.394,0,1,0,6.394,6.394A6.4,6.4,0,0,0,9.847,3.453Z"
                                                                                  transform="translate(-1.854 -1.854)" fill="#b5b5bf" />
                                                                            <path id="Path_3091" data-name="Path 3091"
                                                                                  d="M24.4,25.2a.8.8,0,0,1-.565-.234l-6.15-6.15a.8.8,0,0,1,1.13-1.13l6.15,6.15A.8.8,0,0,1,24.4,25.2Z"
                                                                                  transform="translate(-5.2 -5.2)" fill="#b5b5bf" />
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100"
                                                                 style="min-height: 200px">
                                                                <div class="search-preloader absolute-top-center">
                                                                    <div class="dot-loader">
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                    </div>
                                                                </div>
                                                                <div class="search-nothing d-none p-3 text-center fs-16">

                                                                </div>
                                                                <div id="search-content" class="text-left">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a class="d-block text-reset" href="javascript:void(0);" data-toggle="class-toggle"
                                                       data-target=".front-header-search" id="search-toggle">
                                                        <i class="las la-search la-flip-horizontal la-2x text-primary d-block"></i>
                                                    </a>
                                                    <script>
                                                        document.addEventListener('click', function(event) {
                                                            var searchBox = document.querySelector('.front-header-search');
                                                            var searchToggle = document.getElementById('search-toggle');
                                                            if (!searchBox.contains(event.target) && event.target !== searchToggle) {
                                                                searchBox.classList.remove('active');
                                                            }
                                                        });
                                                    </script>
                                                </div>

                                                <div class="d-none d-lg-block mr-3" style="margin-left: 26px;">
                                                    <div class="" id="wishlist">
                                                        @include('frontend.partials.wishlist')
                                                    </div>
                                                </div>

                                                <div class="ml-3 mr-0 has-transition d-flex align-items-center"
                                                     style="
                                            font-size: 12px;
                                            font-weight: 400;
                                            height: 45px;
                                            text-align: center;
                                            line-height: 25px;
                                            border-radius: 25px;
                                        "
                                                >
                                                    <div class="nav-cart-box dropdown" id="cart_items" style="width: max-content;">
                                                        @include('frontend.partials.cart.cart')
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-inline-item mr-0">
                                            <div>
                                                <ul class="list-inline d-flex justify-content-between justify-content-lg-start mb-0">
                                                    <!-- Language switcher -->
                                                    @if (get_setting('show_language_switcher') == 'on')
                                                        <li class="list-inline-item dropdown mr-4" id="lang-change">

                                                            <a href="javascript:void(0)" class="dropdown-toggle text-secondary fs-12 py-2"
                                                               data-toggle="dropdown" data-display="static">
                                                                <span class="">{{ $system_language->name }}</span>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-left">
                                                                @foreach (get_all_active_language() as $key => $language)
                                                                    <li>
                                                                        <a href="javascript:void(0)" data-flag="{{ $language->code }}"
                                                                           class="dropdown-item @if ($system_language->code == $language->code) active @endif">
                                                                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                                                 data-src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}"
                                                                                 class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                                                                            <span class="language">{{ $language->name }}</span>
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endif

                                                    <!-- Currency Switcher -->
                                                    @if (get_setting('show_currency_switcher') == 'on')
                                                        <li class="list-inline-item dropdown ml-auto ml-lg-0 mr-0" id="currency-change">
                                                            @php
                                                                $system_currency = get_system_currency();
                                                            @endphp

                                                            <a href="javascript:void(0)" class="dropdown-toggle text-secondary fs-12 py-2"
                                                               data-toggle="dropdown" data-display="static">
                                                                {{ $system_currency->name }}
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                                                @foreach (get_all_active_currency() as $key => $currency)
                                                                    <li>
                                                                        <a class="dropdown-item @if ($system_currency->code == $currency->code) active @endif"
                                                                           href="javascript:void(0)"
                                                                           data-currency="{{ $currency->code }}">{{ $currency->name }}
                                                                            ({{ $currency->symbol }})</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endif

                                                </ul>
                                            </div>
                                        </li>
                                        <li class="list-inline-item mr-0">
                                            <div class="text-right d-none d-lg-flex justify-content-end">
                                                <div class="d-none d-xl-flex justify-content-end align-items-center">
                                                    @auth
                                                        <span
                                                            class="d-flex align-items-center nav-user-info py-20px @if (isAdmin()) ml-5 @endif"
                                                            id="nav-user-info">
                                                <!-- Image -->
                                                            <!-- Name -->
                                                <h4 class="h5 fs-14 fw-700 text-primary ml-4 mb-0">{{ $user->name }}</h4>
                                            </span>
                                                    @else
                                                        <!--Login & Registration -->
                                                        <span class="d-flex align-items-center nav-user-info ml-3">
                                                <!-- Image -->
                                                <a onclick="showLoginModal()"
                                                   class="hov-opacity-100 hov-text-primary fs-18 d-inline-block pr-2 ml-3 text-primary">{{ translate('Sign In') }}</a>
                                            </span>
                                                    @endauth
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Cart -->
                        </div>
                    </div>
                </div>
                    <!-- Search Icon for small device -->

                    <!-- Search field -->
                    <!-- Search box -->
                </div>
            </div>

            <!-- Loged in user Menus -->
            <div class="hover-user-top-menu position-absolute top-0 left-0 right-0 z-3">
                <div class="container">
                    <div class="position-static float-right">
                        <div class="aiz-user-top-menu bg-white rounded-0 border-top shadow-sm" style="width:220px;">
                            <ul class="list-unstyled no-scrollbar mb-0 text-left">
                                @if (isAdmin())
                                    <li class="user-top-nav-element border border-top-0" data-id="1">
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16">
                                                <path id="Path_2916" data-name="Path 2916"
                                                    d="M15.3,5.4,9.561.481A2,2,0,0,0,8.26,0H7.74a2,2,0,0,0-1.3.481L.7,5.4A2,2,0,0,0,0,6.92V14a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V6.92A2,2,0,0,0,15.3,5.4M10,15H6V9A1,1,0,0,1,7,8H9a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H11V9A2,2,0,0,0,9,7H7A2,2,0,0,0,5,9v6H2a1,1,0,0,1-1-1V6.92a1,1,0,0,1,.349-.76l5.74-4.92A1,1,0,0,1,7.74,1h.52a1,1,0,0,1,.651.24l5.74,4.92A1,1,0,0,1,15,6.92Z"
                                                    fill="#b5b5c0" />
                                            </svg>
                                            <span
                                                class="user-top-menu-name has-transition ml-3">{{ translate('Dashboard') }}</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="user-top-nav-element border border-top-0" data-id="1">
                                        <a href="{{ route('dashboard') }}"
                                            class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16">
                                                <path id="Path_2916" data-name="Path 2916"
                                                    d="M15.3,5.4,9.561.481A2,2,0,0,0,8.26,0H7.74a2,2,0,0,0-1.3.481L.7,5.4A2,2,0,0,0,0,6.92V14a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V6.92A2,2,0,0,0,15.3,5.4M10,15H6V9A1,1,0,0,1,7,8H9a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H11V9A2,2,0,0,0,9,7H7A2,2,0,0,0,5,9v6H2a1,1,0,0,1-1-1V6.92a1,1,0,0,1,.349-.76l5.74-4.92A1,1,0,0,1,7.74,1h.52a1,1,0,0,1,.651.24l5.74,4.92A1,1,0,0,1,15,6.92Z"
                                                    fill="#b5b5c0" />
                                            </svg>
                                            <span
                                                class="user-top-menu-name has-transition ml-3">{{ translate('Dashboard') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if (isCustomer())
                                    {{--<li class="user-top-nav-element border border-top-0" data-id="1">
                                        <a href="{{ route('purchase_history.index') }}"
                                            class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16">
                                                <g id="Group_25261" data-name="Group 25261"
                                                    transform="translate(-27.466 -542.963)">
                                                    <path id="Path_2953" data-name="Path 2953"
                                                        d="M14.5,5.963h-4a1.5,1.5,0,0,0,0,3h4a1.5,1.5,0,0,0,0-3m0,2h-4a.5.5,0,0,1,0-1h4a.5.5,0,0,1,0,1"
                                                        transform="translate(22.966 537)" fill="#b5b5bf" />
                                                    <path id="Path_2954" data-name="Path 2954"
                                                        d="M12.991,8.963a.5.5,0,0,1,0-1H13.5a2.5,2.5,0,0,1,2.5,2.5v10a2.5,2.5,0,0,1-2.5,2.5H2.5a2.5,2.5,0,0,1-2.5-2.5v-10a2.5,2.5,0,0,1,2.5-2.5h.509a.5.5,0,0,1,0,1H2.5a1.5,1.5,0,0,0-1.5,1.5v10a1.5,1.5,0,0,0,1.5,1.5h11a1.5,1.5,0,0,0,1.5-1.5v-10a1.5,1.5,0,0,0-1.5-1.5Z"
                                                        transform="translate(27.466 536)" fill="#b5b5bf" />
                                                    <path id="Path_2955" data-name="Path 2955"
                                                        d="M7.5,15.963h1a.5.5,0,0,1,.5.5v1a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1-.5-.5v-1a.5.5,0,0,1,.5-.5"
                                                        transform="translate(23.966 532)" fill="#b5b5bf" />
                                                    <path id="Path_2956" data-name="Path 2956"
                                                        d="M7.5,21.963h1a.5.5,0,0,1,.5.5v1a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1-.5-.5v-1a.5.5,0,0,1,.5-.5"
                                                        transform="translate(23.966 529)" fill="#b5b5bf" />
                                                    <path id="Path_2957" data-name="Path 2957"
                                                        d="M7.5,27.963h1a.5.5,0,0,1,.5.5v1a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1-.5-.5v-1a.5.5,0,0,1,.5-.5"
                                                        transform="translate(23.966 526)" fill="#b5b5bf" />
                                                    <path id="Path_2958" data-name="Path 2958"
                                                        d="M13.5,16.963h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"
                                                        transform="translate(20.966 531.5)" fill="#b5b5bf" />
                                                    <path id="Path_2959" data-name="Path 2959"
                                                        d="M13.5,22.963h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"
                                                        transform="translate(20.966 528.5)" fill="#b5b5bf" />
                                                    <path id="Path_2960" data-name="Path 2960"
                                                        d="M13.5,28.963h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"
                                                        transform="translate(20.966 525.5)" fill="#b5b5bf" />
                                                </g>
                                            </svg>
                                            <span
                                                class="user-top-menu-name has-transition ml-3">{{ translate('Purchase History') }}</span>
                                        </a>
                                    </li>--}}

                                    <li class="user-top-nav-element border border-top-0" data-id="1">
                                        <a href="{{ route('support_ticket.index') }}"
                                            class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16.001"
                                                viewBox="0 0 16 16.001">
                                                <g id="Group_25259" data-name="Group 25259"
                                                    transform="translate(-316 -1066)">
                                                    <path id="Subtraction_184" data-name="Subtraction 184"
                                                        d="M16427.109,902H16420a8.015,8.015,0,1,1,8-8,8.278,8.278,0,0,1-1.422,4.535l1.244,2.132a.81.81,0,0,1,0,.891A.791.791,0,0,1,16427.109,902ZM16420,887a7,7,0,1,0,0,14h6.283c.275,0,.414,0,.549-.111s-.209-.574-.34-.748l0,0-.018-.022-1.064-1.6A6.829,6.829,0,0,0,16427,894a6.964,6.964,0,0,0-7-7Z"
                                                        transform="translate(-16096 180)" fill="#b5b5bf" />
                                                    <path id="Union_12" data-name="Union 12"
                                                        d="M16414,895a1,1,0,1,1,1,1A1,1,0,0,1,16414,895Zm.5-2.5V891h.5a2,2,0,1,0-2-2h-1a3,3,0,1,1,3.5,2.958v.54a.5.5,0,1,1-1,0Zm-2.5-3.5h1a.5.5,0,1,1-1,0Z"
                                                        transform="translate(-16090.998 183.001)" fill="#b5b5bf" />
                                                </g>
                                            </svg>
                                            <span
                                                class="user-top-menu-name has-transition ml-3">{{ translate('Support Ticket') }}</span>
                                        </a>
                                    </li>
                                @endif
                                <li class="user-top-nav-element border border-top-0" data-id="1">
                                    <a href="{{ route('logout') }}"
                                        class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15.999"
                                            viewBox="0 0 16 15.999">
                                            <g id="Group_25503" data-name="Group 25503"
                                                transform="translate(-24.002 -377)">
                                                <g id="Group_25265" data-name="Group 25265"
                                                    transform="translate(-216.534 -160)">
                                                    <path id="Subtraction_192" data-name="Subtraction 192"
                                                        d="M12052.535,2920a8,8,0,0,1-4.569-14.567l.721.72a7,7,0,1,0,7.7,0l.721-.72a8,8,0,0,1-4.567,14.567Z"
                                                        transform="translate(-11803.999 -2367)" fill="#d43533" />
                                                </g>
                                                <rect id="Rectangle_19022" data-name="Rectangle 19022" width="1"
                                                    height="8" rx="0.5" transform="translate(31.5 377)"
                                                    fill="#d43533" />
                                            </g>
                                        </svg>
                                        <span
                                            class="user-top-menu-name text-primary has-transition ml-3">{{ translate('Logout') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Bar -->
    </header>

    <!-- Top Menu Sidebar -->
    <div class="aiz-top-menu-sidebar collapse-sidebar-wrap sidebar-xl sidebar-left d-lg-none z-1035">
        <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle"
            data-target=".aiz-top-menu-sidebar" data-same=".hide-top-menu-bar"></div>
        <div class="collapse-sidebar c-scrollbar-light text-left">
            <button type="button" class="btn btn-sm p-4 hide-top-menu-bar" data-toggle="class-toggle"
                data-target=".aiz-top-menu-sidebar">
                <i class="las la-times la-2x text-primary"></i>
            </button>
            @auth
                <span class="d-flex align-items-center nav-user-info pl-4">
                    <!-- Image -->
                    <span class="size-40px rounded-circle overflow-hidden border border-transparent nav-user-img">
                        @if ($user->avatar_original != null)
                            <img src="{{ $user_avatar }}" class="img-fit h-100" alt="{{ translate('avatar') }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="image" alt="{{ translate('avatar') }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                        @endif
                    </span>
                    <!-- Name -->
                    <h4 class="h5 fs-14 fw-700 text-dark ml-2 mb-0">{{ $user->name }}</h4>
                </span>
            @else
                <!--Login & Registration -->
                <span class="d-flex align-items-center nav-user-info pl-4">
                    <!-- Image -->
                    <span
                        class="size-40px rounded-circle overflow-hidden border d-flex align-items-center justify-content-center nav-user-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19.902" height="20.012"
                            viewBox="0 0 19.902 20.012">
                            <path id="fe2df171891038b33e9624c27e96e367"
                                d="M15.71,12.71a6,6,0,1,0-7.42,0,10,10,0,0,0-6.22,8.18,1.006,1.006,0,1,0,2,.22,8,8,0,0,1,15.9,0,1,1,0,0,0,1,.89h.11a1,1,0,0,0,.88-1.1,10,10,0,0,0-6.25-8.19ZM12,12a4,4,0,1,1,4-4A4,4,0,0,1,12,12Z"
                                transform="translate(-2.064 -1.995)" fill="#91919b" />
                        </svg>
                    </span>
                    <a href="{{ route('user.login') }}"
                        class="text-reset opacity-60 hov-opacity-100 hov-text-primary fs-12 d-inline-block border-right border-soft-light border-width-2 pr-2 ml-3">{{ translate('Login') }}</a>
                    <a href="{{ route('user.registration') }}"
                        class="text-reset opacity-60 hov-opacity-100 hov-text-primary fs-12 d-inline-block py-2 pl-2">{{ translate('Registration') }}</a>
                </span>
            @endauth
            <hr>
            <ul class="mb-0 pl-3 pb-3 h-100">
                @if (get_setting('header_menu_labels') != null)
                    @foreach (json_decode(get_setting('header_menu_labels'), true) as $key => $value)
                        <li class="mr-0">
                            <a href="{{ json_decode(get_setting('header_menu_links'), true)[$key] }}"
                                class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 header_menu_links
                            @if (url()->current() == json_decode(get_setting('header_menu_links'), true)[$key]) active @endif">
                                {{ translate($value) }}
                            </a>
                        </li>
                    @endforeach
                @endif
                @auth
                    @if (isAdmin())
                        <hr>
                        <li class="mr-0">
                            <a href="{{ route('admin.dashboard') }}"
                                class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 header_menu_links">
                                {{ translate('My Account') }}
                            </a>
                        </li>
                    @else
                        <hr>
                        <li class="mr-0">
                            <a href="{{ route('dashboard') }}"
                                class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 header_menu_links
                                {{ areActiveRoutes(['dashboard'], ' active') }}">
                                {{ translate('My Account') }}
                            </a>
                        </li>
                    @endif
                    @if (isCustomer())
                        <li class="mr-0">
                            <a href="{{ route('wishlists.index') }}"
                                class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 header_menu_links
                                {{ areActiveRoutes(['wishlists.index'], ' active') }}">
                                {{ translate('Wishlist') }}
                            </a>
                        </li>
                    @endif
                    <hr>
                    <li class="mr-0">
                        <a href="{{ route('logout') }}"
                            class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-primary header_menu_links">
                            {{ translate('Logout') }}
                        </a>
                    </li>
                @endauth
            </ul>
            <br>
            <br>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script type="text/javascript">
            function show_order_details(order_id) {
                $('#order-details-modal-body').html(null);

                if (!$('#modal-size').hasClass('modal-lg')) {
                    $('#modal-size').addClass('modal-lg');
                }

                $.post('{{ route('orders.details') }}', {
                    _token: AIZ.data.csrf,
                    order_id: order_id
                }, function(data) {
                    $('#order-details-modal-body').html(data);
                    $('#order_details').modal();
                    $('.c-preloader').hide();
                    AIZ.plugins.bootstrapSelect('refresh');
                });
            }
        </script>
    @endsection
