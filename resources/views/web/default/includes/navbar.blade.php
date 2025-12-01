<style>
    @media only screen and (max-width : 1150px) {
        #navbar {
            display: none !important;
        }
    }

    @media only screen and (min-width : 1150px) {
        #navbarV {
            display: none !important;
        }
    }

    /* شكل الـ tooltip */
    .toooltip {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .toooltip-content {
        display: none;
        position: absolute;
        top: 30px;
        left: -20px;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px;
        z-index: 9999;
        width: 180px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .toooltip:hover .toooltip-content {
        display: block;
    }

    .toooltip-content ul.languages {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .toooltip-content ul.languages li {
        padding: 6px 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        border-radius: 5px;
    }

    .toooltip-content ul.languages li:hover {
        background: #f5f5f5;
    }

    .active-lang {
        border: 2px solid #FDA706 !important;
        border-radius: 5px !important;
        padding: 5px !important;
        font-weight: bold !important;
    }

    .lang-flag img {
        border-radius: 3px;
    }
</style>
@php
    if (empty($authUser) and auth()->check()) {
        $authUser = auth()->user();
    }

    $navBtnUrl = null;
    $navBtnText = null;

    if (request()->is('forums*')) {
        $navBtnUrl = '/forums/create-topic';
        $navBtnText = trans('update.create_new_topic');
    } else {
        $navbarButton = getNavbarButton(!empty($authUser) ? $authUser->role_id : null, empty($authUser));

        if (!empty($navbarButton)) {
            $navBtnUrl = $navbarButton->url;
            $navBtnText = $navbarButton->title;
        }
    }

    $rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

    $curr_lang = app()->getLocale();
    if (Session::has('site_language')) {
        $curr_lang = Session::get('site_language');
    }

    $isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));
    $is_panel = (Request::is('panel') || Request::is('panel/*')) ? 1 : 0;
@endphp

@php
    $curr_lang = app()->getLocale();
    if(Session::has('site_language')) {
        $curr_lang = Session::get('site_language');
    }
@endphp


<div id="navbarV">
    <x-web.navbar lang="{{ $curr_lang }}" />
</div>
<!-- <div id="navbarVacuum">  </div> -->
<nav id="navbar"
    class="navbar navbar-expand-lg navbar-yellow {{ $is_panel == 1 ? (auth()->user()->role_id == 4 ? '' : (!$isRtl ? 'left-margin' : 'right-margin')) : '' }}">
    <div class="{{ (!empty($isPanel) and $isPanel) ? 'container-fluid' : 'container'}}">
        <div class="d-flex align-items-center justify-content-between w-100">

            <a class="navbar-brand navbar-order d-flex align-items-center justify-content-center mr-0 {{ (empty($navBtnUrl) and empty($navBtnText)) ? 'ml-auto' : '' }}"
                href="/" style="{{ $isRtl ? 'margin-right: 5px !important' : '' }}">
                <img src="{{ asset('images/kemecademy-logo.png') }}" height="50" width="180"
                    style="margin-top: -10px !important; margin-left: 20px !important">
            </a>

            <button class="navbar-toggler navbar-order" type="button" id="navbarToggle">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="mx-lg-30 d-none d-lg-flex flex-grow-1 navbar-toggle-content " id="navbarContent">
                <div class="navbar-toggle-header text-right d-lg-none">
                    <button class="btn-transparent" id="navbarClose">
                        <i data-feather="x" width="32" height="32"></i>
                    </button>
                </div>

                <ul class="navbar-nav mr-auto d-flex align-items-center">
                    @if(!empty($categories) and count($categories))
                        <li class="mr-lg-25">
                            <div class="menu-category">
                                <ul>
                                    <li class="cursor-pointer user-select-none d-flex xs-categories-toggle">
                                        <i data-feather="grid" width="20" height="20" class="mr-10 d-none d-lg-block"></i>
                                        {{ trans('categories.categories') }}

                                        <ul class="cat-dropdown-menu">
                                            @foreach($categories as $category)
                                                <li>
                                                    <a href="{{ $category->getUrl() }}"
                                                        class="{{ (!empty($category->subCategories) and count($category->subCategories)) ? 'js-has-subcategory' : '' }}">
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ $category->icon }}"
                                                                class="cat-dropdown-menu-icon mr-10"
                                                                alt="{{ $category->title }} icon">
                                                            {{ $category->title }}
                                                        </div>

                                                        @if(!empty($category->subCategories) and count($category->subCategories))
                                                            <i data-feather="chevron-right" width="20" height="20"
                                                                class="d-none d-lg-inline-block ml-10"></i>
                                                            <i data-feather="chevron-down" width="20" height="20"
                                                                class="d-inline-block d-lg-none"></i>
                                                        @endif
                                                    </a>

                                                    @if(!empty($category->subCategories) and count($category->subCategories))
                                                        <ul class="sub-menu" data-simplebar @if((!empty($isRtl) and $isRtl))
                                                        data-simplebar-direction="rtl" @endif>
                                                            @foreach($category->subCategories as $subCategory)
                                                                <li>
                                                                    <a href="{{ $subCategory->getUrl() }}">
                                                                        @if(!empty($subCategory->icon))
                                                                            <img src="{{ $subCategory->icon }}"
                                                                                class="cat-dropdown-menu-icon mr-10"
                                                                                alt="{{ $subCategory->title }} icon">
                                                                        @endif

                                                                        {{ $subCategory->title }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                @php
                    $navbarPages = array_values(array_filter($navbarPages, function ($item) {
                        if ($item['link'] === '/register') {
                            return auth()->check() && auth()->user()->role_id === 1;
                        }
                        return true;
                    }));
                @endphp

                    @if(!empty($navbarPages) and count($navbarPages))
                        @foreach($navbarPages as $navbarPage)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $navbarPage['link'] }}">{{ $navbarPage['title'] }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>



            <div class="nav-icons-or-start-live navbar-order d-flex align-items-center justify-content-end">



                <div class=" nav-notify-cart-dropdown top-navbar" style="display: flex !important;">
                    @include('web.default.includes.shopping-cart-dropdwon')

                    <div class="border-left mx-15"></div>

                    @include('web.default.includes.notification-dropdown')

                    <div class="border-left mx-15"></div>

                    {{-- <div class="toooltip">
                        <li><i class="kem-top-header-icons-translate"></i></li>
                        <div class="toooltip-content">
                            <ul class="languages">
                                @for ($i = 0; $i < count($lang); $i++)
                                    <li onclick="setLanguage('{{ $lang[$i]['code'] }}')"
                                        data-code="{{ $lang[$i]['code'] }}"
                                        class="{{ $curr_lang == $lang[$i]['code'] ? 'active-lang' : '' }}">
                                        <span class="lang-flag">
                                            <img class="img-fluid" src="{{ asset('language-flags/png100px').'/'.$lang[$i]['code'].'.png' }}" width="20" alt="">
                                        </span>
                                        {{ $lang[$i]['name'] }}
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div> --}}

                    <div class="border-left mx-15"></div>

                    <div class="custom-dropdown navbar-auth-user-dropdown position-relative">
                        <div class="custom-dropdown-toggle d-flex align-items-center navbar-user cursor-pointer">
                            <img id="topnavbar-user"   src="{{ $authUser->getAvatar(32) }}" class="rounded-circle" alt="{{ $authUser->full_name }}">
                            {{-- <span class="font-16 user-name ml-10 text-dark-blue font-14">{{ $authUser->full_name }}</span> --}}
                        </div>

                        <div class="custom-dropdown-body pb-10">

                            <div class="dropdown-user-avatar d-flex align-items-center p-15 m-15 mb-10 rounded-sm border">
                                <div class="size-40 rounded-circle position-relative">
                                    <img src="{{ $authUser->getAvatar() }}" class="img-cover rounded-circle" alt="{{ $authUser->full_name }}">
                                </div>

                                <div class="ml-5">
                                    <div class="font-14 font-weight-bold text-secondary">{{ $authUser->full_name }}</div>
                                    <span class="mt-5 text-gray font-12">{{ $authUser->role->caption }}</span>
                                </div>
                            </div>

                            <ul class="my-8">
                                @if($authUser->isAdmin())
                                    <li class="navbar-auth-user-dropdown-item">
                                        <a href="{{ getAdminPanelUrl() }}" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                            <img src="/assets/default/img/icons/user_menu/dashboard.svg" class="icons">
                                            <span class="ml-5">{{ trans('panel.dashboard') }}</span>
                                        </a>
                                    </li>

                                    <li class="navbar-auth-user-dropdown-item">
                                        <a href="{{ getAdminPanelUrl("/settings") }}" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                            <img src="/assets/default/img/icons/user_menu/settings.svg" class="icons">
                                            <span class="ml-5">{{ trans('panel.settings') }}</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="navbar-auth-user-dropdown-item">
                                        <a href="/panel" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                            <img src="/assets/default/img/icons/user_menu/dashboard.svg" class="icons">
                                            <span class="ml-5">{{ trans('panel.dashboard') }}</span>
                                        </a>
                                    </li>


                                    <li class="navbar-auth-user-dropdown-item">
                                        <a href="{{ ($authUser->isUser()) ? '/panel/webinars/purchases' : '/panel/webinars' }}" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                            <img src="/assets/default/img/icons/user_menu/my_courses.svg" class="icons">
                                            <span class="ml-5">{{ trans('update.my_courses') }}</span>
                                        </a>
                                    </li>

                                    @if(!$authUser->isUser())
                                        <li class="navbar-auth-user-dropdown-item">
                                            <a href="/panel/financial/sales" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                                <img src="/assets/default/img/icons/user_menu/sales_history.svg" class="icons">
                                                <span class="ml-5">{{ trans('financial.sales_history') }}</span>
                                            </a>
                                        </li>
                                    @endif

                                    <li class="navbar-auth-user-dropdown-item">
                                        <a href="/panel/support" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                            <img src="/assets/default/img/icons/user_menu/support.svg" class="icons">
                                            <span class="ml-5">{{ trans('panel.support') }}</span>
                                        </a>
                                    </li>

                                    @if(!$authUser->isUser())
                                        <li class="navbar-auth-user-dropdown-item">
                                            <a href="{{ $authUser->getProfileUrl() }}" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                                <img src="/assets/default/img/icons/user_menu/profile.svg" class="icons">
                                                <span class="ml-5">{{ trans('public.profile') }}</span>
                                            </a>
                                        </li>
                                    @endif

                                    <li class="navbar-auth-user-dropdown-item">
                                        <a href="/panel/setting" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                            <img src="/assets/default/img/icons/user_menu/settings.svg" class="icons">
                                            <span class="ml-5">{{ trans('panel.settings') }}</span>
                                        </a>
                                    </li>
                                @endif

                                <li class="navbar-auth-user-dropdown-item">
                                    <a href="/logout" class="d-flex align-items-center w-100 px-15 py-10 text-danger font-14 bg-transparent">
                                        <img src="/assets/default/img/icons/user_menu/logout.svg" class="icons">
                                        <span class="ml-5">{{ trans('auth.logout') }}</span>
                                    </a>
                                </li>

                            </ul>

                        </div>
                    </div>

                </div>


                <!-- @if(!empty($navBtnUrl))
                    <a href="{{ $navBtnUrl }}" class="d-none d-lg-flex btn btn-sm btn-primary nav-start-a-live-btn">
                        {{ $navBtnText }}
                    </a>

                    <a href="{{ $navBtnUrl }}" class="d-flex d-lg-none text-primary nav-start-a-live-btn font-14">
                        {{ $navBtnText }}
                    </a>
                @endif -->

                <!-- @if(!empty($isPanel))
                    @if($authUser->checkAccessToAIContentFeature())
                        <div class="js-show-ai-content-drawer show-ai-content-drawer-btn d-flex-center mr-40">
                            <div class="d-flex-center size-32 rounded-circle bg-white">
                                <img src="/assets/default/img/ai/ai-chip.svg" alt="ai" class="" width="16px" height="16px">
                            </div>
                            <span class="ml-5 font-weight-500 text-secondary font-14 d-none d-lg-block">{{ trans('update.ai_content') }}</span>
                        </div>
                    @endif
                @endif  -->




            </div>
        </div>
    </div>
</nav>

@push('scripts_bottom')
    <!-- <script src="/assets/default/js/parts/navbar.min.js"></script> -->

<script>
    // دالة تغيير اللغة
    const setLanguage = (lang) => {
        let url = "{{ route('locale', ['FIXED_LANG']) }}";
        url = url.replace('FIXED_LANG', lang);
        window.open(url, "_self");
    }
</script>
@endpush


