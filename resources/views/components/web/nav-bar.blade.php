
<link rel="stylesheet" href="{{ asset('css/layouts.css') }}">

@php
$rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

$curr_lang = app()->getLocale();
if(Session::has('site_language')) {
$curr_lang = Session::get('site_language');
}

$isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));

@endphp




{{-- @if (\Request::route()->getName() == 'front.page') --}}
<div class="nav-bar" style="width: 100%;">
    <div class="container">
        <div class="row justify-content-between align-items-center" id="navrow">
            <div class="col-12">
                <div class="leftside d-flex flex-row align-items-center justify-content-start" style="justify-content: space-between !important;">
                    <!-- main logo  -->
                    <div class="main-logo">
                        <a href="/">

                            {{-- <img src="{{ asset('images/logo4.png') }}" alt="Gaza academy CodeTech-logo" height="50"
                                width="180" /> --}}

                            @if(!empty($generalSettings['logo']))
                                <img src="{{ $generalSettings['logo'] }}" alt="Gaza academy CodeTech-logo" height="45"
                                width="160">
                            @endif

                        </a>
                    </div>
                    <!-- primary menu  -->
                    <div class="primary-menu">
                        <ul class="d-flex flex-row flex-wrap justify-content-start align-items-center">
                            @if(!empty($categories) and count($categories))
                                <li class="mr-lg-25">
                                    <div class="menu-category">
                                        <ul>
                                            <li class="cursor-pointer user-select-none d-flex xs-categories-toggle text-dark">
                                                <i  data-feather="grid" width="20" height="20"
                                                    class="mr-10 d-none d-lg-block"></i>
                                                {{ trans('categories.categories') }}

                                                <ul class="cat-dropdown-menu" style="z-index: 999 !important">
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
                                                                        <li style="z-index: 0;">
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

                                    <li >
                                        <a href="{{ $navbarPage['link'] }}" style="color: black;" id="navbarsdesktop"
                                            class="text-decoration-none  d-inline-block px-2">{{ $navbarPage['title'] }}</a>
                                    </li>
                                @endforeach
                            @endif

                            @guest
                                <li>
                                            {{-- <a href="/login" style="color: white;" class="text-decoration-none  d-inline-block px-2">{{ __('navbar.Login as instructor') }}</a> --}}
                                        <a href="/login" style="color: black;" class="text-decoration-none  d-inline-block px-2">{{ __('Login') }}</a>
                                        <a href="/register" style="color: black;" class="text-decoration-none  d-inline-block px-2">{{ __('Register') }}</a>

                                </li>
                            @endguest

                            {{-- <li class="beta">
                                <img src="{{ asset('images/beta.png') }}" alt="beta version" style="height: 2.75rem;"/>

                            </li> --}}

                        </ul>
                    </div>



                    <div class="right-side">
                        <div class="toooltip" x-data="{ openl: false }">
                            <li>
                                <i @click="openl = ! openl" class="kem-top-header-icons-translate" style="font-size: 24px"></i>
                            </li>

                            <div class="toooltip-content"
                                x-show="openl"
                                @click.outside="openl = false"
                                 style="display: none; position: absolute; bottom: -21%;
                                    {{ app()->getLocale() === 'ar' ? 'left: 18%;' : 'right: 18%;' }}">

                                <ul class="languages" style="z-index: 2; position: absolute; width: 200px; background: white;">
                                    @if($langs)
                                        @for ($i = 0; $i < count($langs); $i++)
                                            <li onclick="setLanguage('{{ $langs[$i]['code'] }}')"
                                                class="{{  $langs[$i]['code'] == $curr_lang ? 'langBorder' : '' }}">

                                                <span class="lang-flag">
                                                    <img class="img-fluid"
                                                        src="{{ asset('language-flags/png100px/' . $langs[$i]['code'] . '.png') }}"
                                                        width="20px" alt="">
                                                </span>

                                                {{ $langs[$i]['name'] }}
                                            </li>
                                        @endfor
                                    @endif
                                </ul>
                            </div>
                        </div>

                    </div>


                </div>
            </div>

            <div class="col-auto d-none" x-data="{ open: false }" style="position: relative;">
                <!-- video library -->
                <button class="btn btn-outline-danger rounded-pill video-button" @click="open = ! open">Video
                    Library
                </button>
                <div class="toooltip-content row py-4 px-2" x-show="open" @click.outside="open = false"
                    style="display: none; border-radius: 10px; width: 950px; height:275px; transform: translateX(-75%); background: #e5e7eb;position: absolute; font-size: 1rem;">
                        {{-- <li><i @click="open = ! open" class="fal fa-video"></i></li> --}}
                        {{-- <div class="overflow-hidden flex gap-2 m-3" x-show="open" @click.outside="open = false"
                        style="display: none"> --}}
                        <div class="col-md-4">
                            <div class="border-2 grid grid-cols-1 rounded-md w-[300px]">
                                <div class="text-center p-2" style="height: 60px">
                                    <div>kemedar proptech realstate marketplace Arabic video</div>
                                </div>
                                <div class="p-2">
                                    <a class="btn btn-primary video-btn" data-bs-toggle="modal"
                                        data-src="https://www.youtube.com/embed/qpO5Q_YfiEM" data-bs-target="#myModal">
                                        <img src="https://laravel-kemedar.dev2.kemedar.com/kemedar/assets/images/first-tumbnail.webp"
                                            alt="" class="rounded-lg" style="width: 200px;">
                                    </a>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="border-2 grid grid-cols-1 rounded-md w-[300px]">
                                <div class="text-center p-2" style="height: 60px">
                                    <div>kemedar proptech realstate marketplace English video</div>
                                </div>
                                <div class="p-2">
                                    <a class="btn btn-primary video-btn" data-bs-toggle="modal"
                                        data-src="https://www.youtube.com/embed/qpO5Q_YfiEM" data-bs-target="#myModal">
                                        <img src="https://laravel-kemedar.dev2.kemedar.com/kemedar/assets/images/second-tumbnail.webp"
                                            alt="" class="rounded-lg" style="width: 200px;">
                                    </a>

                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="border-2 grid grid-cols-1 rounded-md w-[300px]">
                                <div class="text-center p-2 " style="height: 60px">
                                    <div>kemedar the best is yet to come</div>
                                </div>
                                <div class="p-2">
                                    <a class="btn btn-primary video-btn" data-bs-toggle="modal"
                                        data-src="https://www.youtube.com/embed/QCvCW9hSvXY" data-bs-target="#myModal">
                                        <img src="https://laravel-kemedar.dev2.kemedar.com/kemedar/assets/images/thirdnew_thmbnail.jpg"
                                            alt="" class="rounded-lg" style="width: 200px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>

            </div>

        </div>
    </div>
</div>
{{-- @endif --}}

    <!-- mobile navigation bar -->
    <div class="m-nav-bar navbar-yellow p-2" style="background-color: #ffc107 !important;">
        <div class="container">
            <div class="row">

                <div class="col-12 d-flex flex-row justify-content-between align-items-center">

                    <div class="left-side d-flex flex-row justify-content-start align-items-center">

                        <div class="left-menu">
                            <button class="modal-button-left" data-toggle="modal"><i class="far fa-bars"></i></button>
                        </div>

                        <div class="main-logo">
                            <!-- mobile main logo -->
                            <img src="{{ asset('images/logo4.png') }}" alt="Gaza academy codeTech-logo" />
                        </div>

                        {{-- <span class="modal-button d-flex align-items-center ms-2" style="transform: translateY(4px);">
                            <svg class="svg-inline--fa fa-chevron-down fa-w-14"
                                aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""
                                style="height: 1rem;">
                                <path fill="currentColor"
                                    d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z">
                                </path>
                            </svg>
                        </span> --}}

                    </div>

                    <div class="right-side d-flex flex-row justify-content-end align-items-center">
                        <div class="dark-toggle d-inline-block">

                        </div>



                        <!-- new beta button-->
                        <div class="right-menu d-flex">


                            {{-- <img src="{{asset('images/beta.png')}}" class="betamob"
                                style="height: 1.75rem;" /> --}}
                            <button class="main-button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                aria-controls="offcanvasRight" style="height: 1.75rem;color:black">
                                <svg class="svg-inline--fa fa-bars fa-w-14" aria-hidden="true" focusable="false"
                                    data-prefix="far" data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M436 124H12c-6.627 0-12-5.373-12-12V80c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12z">
                                    </path>
                                </svg>
                            </button>
                        </div>

                        @php
                            $direction = in_array(app()->getLocale(), ['ar', 'he', 'fa', 'ur']) ? 'rtl' : 'ltr';
                            $offcanvasDirection = $direction === 'ltr' ? 'offcanvas-start' : 'offcanvas-end';
                        @endphp

                        <div class="offcanvas {{ app()->getLocale() === 'en' ? 'offcanvas-start' : 'offcanvas-end' }}" id="offcanvasRight">

                            <div class="offcanvas-header">
                                <button class="btn-close text-reset " data-bs-dismiss="offcanvas" aria-label="Close"></link>
                            </div>

                            <div class="offcanvas-body">
                                <ul class="menu-list px-2" style="list-style: none; padding: 0; margin: 0; direction: {{ $direction }};">

                                    @if(!empty($categories) && count($categories))
                                        <li style="margin-bottom: 10px;" class="catmob">
                                            <div onclick="toggleSubmenu('main-categories')" style="cursor: pointer; padding: 8px 0;">
                                                {{ trans('categories.categories') }}
                                            </div>

                                            <ul id="main-categories" style="display: none; padding-{{ $direction == 'rtl' ? 'right' : 'left' }}: 15px; margin-top: 5px;">
                                                @foreach($categories as $index => $category)
                                                    <li style="margin-bottom: 8px;">
                                                        <div onclick="toggleSubmenu('subcategory-{{ $index }}', 'arrow-{{ $index }}')" style="cursor: pointer; display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
                                                            <div style="display: flex; align-items: center;">
                                                                @if(!empty($category->icon))
                                                                    <img src="{{ $category->icon }}" alt="{{ $category->title }}" style="width: 20px; height: 20px; margin-{{ $direction == 'rtl' ? 'left' : 'right' }}: 10px;">
                                                                @endif
                                                                <span>{{ $category->title }}</span>
                                                            </div>

                                                            @if(!empty($category->subCategories))
                                                                <svg id="arrow-{{ $index }}" class="arrow-icon" width="18" height="18" viewBox="0 0 24 24" style="transition: transform 0.3s;">
                                                                    <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            @endif
                                                        </div>

                                                        @if(!empty($category->subCategories))
                                                            <ul id="subcategory-{{ $index }}" style="display: none; padding-{{ $direction == 'rtl' ? 'right' : 'left' }}: 15px; margin-top: 5px; background: #f9f9f9; border-radius: 5px;">
                                                                @foreach($category->subCategories as $subCategory)
                                                                    <li style="padding: 5px 0;">
                                                                        <a href="{{ $subCategory->getUrl() }}" style="text-decoration: none; color: #333; display: flex; align-items: center;" class="subs">
                                                                            @if(!empty($subCategory->icon))
                                                                                <img src="{{ $subCategory->icon }}" alt="{{ $subCategory->title }}" style="width: 16px; height: 16px; margin-{{ $direction == 'rtl' ? 'left' : 'right' }}: 8px;">
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
                                    @endif

                                    @foreach($navbarPages as $navbarPage)
                                        <li class="navmob" style="margin-bottom: 10px;">
                                            <a href="{{ $navbarPage['link'] }}" style="text-decoration: none; color: black;">
                                                {{ $navbarPage['title'] }}
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>


                            <script>
                                function toggleSubmenu(menuId, arrowId = null) {
                                    const submenu = document.getElementById(menuId);
                                    const arrow = arrowId ? document.getElementById(arrowId) : null;

                                    const isOpen = submenu.style.display === 'block';
                                    submenu.style.display = isOpen ? 'none' : 'block';
                                    if (arrow) arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(90deg)';
                                }
                            </script>


                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>



</div>
</div>
</div>
</div>

<!-- mobile model -->
<div class="system-modal" style="width: 80vw; top: 10vh;left: 10vw;height: auto;">
    <span class="close-modal" style="top: 5px;left: auto;right: 20px;z-index: 999"><svg
            style="transform: translate(0px , 10px);" class="svg-inline--fa fa-times fa-w-10" aria-hidden="true"
            focusable="false" data-prefix="far" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 320 512" data-fa-i2svg="">
            <path fill="currentColor"
                d="M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z">
            </path>
        </svg>
    </span>
        {{-- <div class="side-bar p-2" style="width: 100%;height:70vh;background: #e5e7eb; border-radius: 10px">
            <div class="title">
                <h4>{{ __('All Systems')}}</h4>
            </div>
            <div class="accordion">
                @for ($i = 0; $i < count($other_menu); $i++)
                    <div class="accordion-box">
                        <div class="header" style="padding-left: 20px">
                            <!-- @if ($other_menu[$i]['custom'] == 1) -->
                            {{ var_dump($other_menu[$i]['custom']) }}
                                {!!  $other_menu[$i]['icon'] !!}


                                <span class="kem-kemessenger"><span class="path1"></span><span class="path2"></span><span
                                        class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                            <!-- @else -->
                                <span><i class="text-danger {{ $other_menu[$i]['icon'] }}"></i>
                            @endif
                                <span><b>{{ $other_menu[$i]['label'] }}</b> </span></span><span style="padding-left: 10px">
                                <svg class="svg-inline--fa fa-chevron-down fa-w-14" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="chevron-down" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z">
                                    </path>
                                </svg></span>
                        </div>
                        <div class="content pl-2">
                            <p>{{ $other_menu[$i]['sub_title'] }}</p>
                            <div class="content-buttons mt-2 flex flex-col gap-1">
                                <button class="android text-start"><i class="fab fa-android"></i>
                                    {{ __('Download MiniApp')}}</button>
                                <button class="visit text-start"
                                    onclick="window.location.href='{{ $other_menu[$i]['link'] }}'"><i class="fas fa-eye"></i>
                                    {{ __('Homepage')}}</button>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div> --}}
</div>

@push('scripts_bottom')
    <script src="/assets/default/js/parts/navbar.min.js"></script>

    <script>
        // document.addEventListener("DOMContentLoaded", (event) => {
        //     const toggleMblOthers = document.querySelector("#toggleMblOthers");
        //     toggleMblOthers.addEventListener("click", () => {
        //         var modal = document.querySelector('.system-modal');
        //         modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
        //     });

        //     const closeModal = document.querySelector("#closeModal");
        //     closeModal.addEventListener("click", () => {
        //         var modal = document.querySelector('.system-modal');
        //         modal.style.display = modal.style.display === 'none' ? '' : 'none';
        //     });
        // });

        $(".accordion .accordion-box .header").click(function () {
            $(this).next('.content').slideToggle();
            $(this).find(".fa-chevron-down").toggleClass("rotate");
        });

        $(".close-modal").click(function () {
            $(".system-modal").slideToggle();
        });
        // $(".close-modal-others").click(function () {
        //     $(".system-modal-others").slideToggle();
        // });

        $(".modal-button").click(function () {
            $(".system-modal").slideToggle();
        });
        // $(".modal-button-others").click(function () {
        //     $(".system-modal-others").slideToggle();
        // });



        // $(".main-button").click(function () {
        //     $(".system-modal-others").slideToggle();
        // });

        // $(".modal-button").click(function () {
        //     $(".system-modal-other").slideToggle();
        // });


        $(".modal-button-left").click(function () {
            $(".system-modal-left").slideToggle();
        });

        // $(".modal-button").click(function () {
        //     $(".system-modal").slideToggle();
        // })
    </script>


    <script>


        const setLanguage = (lang) => {
            let url = "{{ route('locale', ['FIXED_LANG']) }}";
            url = url.replace('FIXED_LANG', lang);
            window.open(url, "_self");
        }

    </script>

@endpush
