<style>
    .content-buttons {
        font-family: 'Lato' !important;
        font-size: 11px;
    }
</style>
{{-- @if (\Request::route()->getName() == 'front.page') --}}
    <div class="nav-bar">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <div class="leftside d-flex flex-row align-items-center justify-content-start">
                        <!-- main logo  -->
                        <div class="main-logo">
                            <a href="/">
                                <img src="{{ asset('images/logo4.png') }}" alt="Gaza academy CodeTech-logo" height="50" width="180" />
                            </a>
                        </div>
                        <!-- primary menu  -->
                        <div class="primary-menu">
                            <ul class="d-flex flex-row flex-wrap justify-content-start align-items-center">
                                {{-- @foreach ($system_menu as $sysMenu)
                                    <li><a href="{{ $sysMenu['link'] }}#how-it-works" class="text-decoration-none text-white font-weight-bold d-inline-block px-2">{{ $sysMenu['label'] }}</a>
                                    </li>
                                @endforeach --}}

                                @if(!empty($categories) and count($categories))
                                    <li class="mr-lg-25">
                                        <div class="menu-category">
                                            <ul>
                                                <li class="cursor-pointer user-select-none d-flex xs-categories-toggle">
                                                    <i data-feather="grid" width="20" height="20" class="mr-10 d-none d-lg-block"></i>
                                                    {{ trans('categories.categories') }}

                                                    <ul class="cat-dropdown-menu" style="z-index: 2 !important">
                                                        @foreach($categories as $category)
                                                            <li>
                                                                <a href="{{ $category->getUrl() }}" class="{{ (!empty($category->subCategories) and count($category->subCategories)) ? 'js-has-subcategory' : '' }}">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="{{ $category->icon }}" class="cat-dropdown-menu-icon mr-10" alt="{{ $category->title }} icon">
                                                                        {{ $category->title }}
                                                                    </div>

                                                                    @if(!empty($category->subCategories) and count($category->subCategories))
                                                                        <i data-feather="chevron-right" width="20" height="20" class="d-none d-lg-inline-block ml-10"></i>
                                                                        <i data-feather="chevron-down" width="20" height="20" class="d-inline-block d-lg-none"></i>
                                                                    @endif
                                                                </a>

                                                                @if(!empty($category->subCategories) and count($category->subCategories))
                                                                    <ul class="sub-menu" data-simplebar @if((!empty($isRtl) and $isRtl)) data-simplebar-direction="rtl" @endif>
                                                                        @foreach($category->subCategories as $subCategory)
                                                                            <li>
                                                                                <a href="{{ $subCategory->getUrl() }}">
                                                                                    @if(!empty($subCategory->icon))
                                                                                        <img src="{{ $subCategory->icon }}" class="cat-dropdown-menu-icon mr-10" alt="{{ $subCategory->title }} icon">
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

                                @if(!empty($navbarPages) and count($navbarPages))
                                    @foreach($navbarPages as $navbarPage)
                                        {{-- <li class="nav-item">
                                            <a class="nav-link" href="{{ $navbarPage['link'] }}">{{ $navbarPage['title'] }}</a>
                                        </li> --}}
                                        <li>
                                            <a href="{{ $navbarPage['link'] }}" class="text-decoration-none text-white font-weight-bold d-inline-block px-2">{{ $navbarPage['title'] }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-auto d-none" x-data="{ open: false }" style="position: relative;">
                    <!-- video library -->
                    <button class="btn btn-outline-danger rounded-pill video-button" @click="open = ! open">Video
                        Library</button>
                    <div class="toooltip-content row py-4 px-2" x-show="open" @click.outside="open = false"
                        style="display: none; border-radius: 10px; width: 950px; height:275px; transform: translateX(-75%); background: #e5e7eb;position: absolute; font-size: 1rem;">
                        {{--                    <li><i @click="open = ! open" class="fal fa-video"></i></li> --}}
                        {{--                            <div class="overflow-hidden flex gap-2 m-3" x-show="open" @click.outside="open = false" style="display: none"> --}}
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
                        {{--                            </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- @endif --}}

<!-- mobile navigation bar -->
<div class="m-nav-bar navbar-yellow p-2">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-row justify-content-between align-items-center">
                <div class="left-side d-flex flex-row justify-content-start align-items-center">
                    <div class="left-menu">
                        <button class="modal-button-left" data-toggle="modal"><i class="far fa-bars"></i></button>
                    </div>
                    <div class="main-logo">
                        <!-- mobile main logo -->
                        <img src="{{ asset('images/logo4.png') }}" alt="Gaza academy CodeTech" />
                    </div>
                </div>
                <div class="right-side d-flex flex-row justify-content-end align-items-center">
                    <div class="dark-toggle d-inline-block">
                        {{--                        <button class="border border-0 bg-transparent outline-none shadow-none"><i --}}
                        {{--                                class="fad fa-moon"></i></button> --}}
                    </div>
                    <div class="right-menu d-inline-block">
                        <button id="toggleMblOthers" class="modal-button" data-toggle="modal">Other Systems <i class="far fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- mobile model -->
<div class="system-modal" style="width: 80vw; top: 10vh;left: 10vw;height: auto; display: none !important">
    <span class="close-modal" id="closeModal" style="top: 5px;left: auto;right: 20px; z-index: 99999 !important"><i class="far fa-times"></i></span>
    <div class="side-bar p-2" style="width: 100%;height:70vh;background: #e5e7eb; border-radius: 10px">
        <div class="title">
            <h4>Other Systems</h4>
        </div>
        <div class="accordion">
            @for ($i = 0; $i < count($other_menu); $i++)
                <div class="accordion-box">
                    <div class="header">

                        @if ($other_menu[$i]['custom'] == 1)
                            {{-- {{ $other_menu[$i]['icon'] }} --}}

                            {{-- invoking html via api restricted --}}

                            <span class="kem-kemessenger"><span class="path1"></span><span class="path2"></span><span
                                    class="path3"></span><span class="path4"></span><span
                                    class="path5"></span></span>
                        @else
                            <span><i class="text-danger {{ $other_menu[$i]['icon'] }}"></i>
                        @endif
                        <span><b>{{ $other_menu[$i]['label'] }}</b> </span></span><span style="padding-left: 10px"> <i
                                class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="content pl-2">
                        <p>{{ $other_menu[$i]['sub_title'] }}</p>
                        <div class="content-buttons">
                            <button class="android mb-1"><i class="fab fa-android"></i> Download Miniapp</button>
                            <button class="visit mb-1"><i class="fas fa-eye"></i> Homepage</button>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>

@push('scripts_bottom')
    <script src="/assets/default/js/parts/navbar.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            const toggleMblOthers = document.querySelector("#toggleMblOthers");
            toggleMblOthers.addEventListener("click", () => {
                var modal = document.querySelector('.system-modal');
                modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
            });

            // const closeModal = document.querySelector("#closeModal");
            // closeModal.addEventListener("click", () => {
            //     var modal = document.querySelector('.system-modal');
            //     modal.style.display = modal.style.display === 'none' ? '' : 'none';
            // });
        });

        $(".accordion .accordion-box .header").click(function() {
            $(this).next('.content').slideToggle();
            $(this).find(".fa-chevron-down").toggleClass("rotate");
        });

        $(".close-modal").click(function(){
            $(".system-modal").slideToggle();
        });
    </script>
@endpush
