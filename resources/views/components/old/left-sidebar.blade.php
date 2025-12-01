<!-- mobile model -->
{{-- <link href="{{ asset('css/leftsidebar.css') }}" rel="stylesheet">

@if ($alignment == 'rtl')
    <link href="{{ asset('css_rtl/leftsidebar.css') }}" rel="stylesheet">
@endif --}}

{{-- <link href="{{ asset('css_rtl/leftsidebar.css') }}" rel="stylesheet"> --}}


<style>
    .q-item {
        width: 100%;
    }

    .btn-toggle[aria-expanded="true"] {
        transform: rotate(90deg);
    }

    .dpdw-link a:hover {
        background-color: rgb(169, 169, 169);
    }

    .dropdown-menu {
        margin-left: -12px !important;
    }

    .btn-toggle::before {
        width: 1.25em;
        line-height: 0;
        transition: transform .35s ease;
        transform-origin: 0.5em 50%;
    }

    @media only screen and (min-width: 675px) {
        .q-drawer {
            margin-left: 15px;
        }
    }
</style>

@php
    $route = $site;
@endphp

<div class="system-modal-left">
    <span class="close-modal-left"><i class="far fa-times"></i></span>
    <div class="side-bar">


        <div id="q-app">
            <div class="q-layout q-layout--standard" tabindex="-1" style="min-height: 670px;">
                <aside
                    class="q-drawer q-drawer--left q-drawer--bordered fixed q-drawer--on-top q-drawer--mobile q-drawer--top-padding"
                    style="width: 300px; transform: translateX(0px);">
                    <div class="q-drawer__content fit scroll">
                        <div>
                            <div class="bg-[#B92025] p-2">
                                @if (\Request::route()->getName() == 'sidebar.page')
                                    <div class="relative">
                                        <div class="container mb-1 p-1 d-flex justify-content-center"
                                            style="display: flex !important;
                                            align-items: center;
                                            flex-direction: column;">
                                            <img src="{{ asset('images/avatar.png') }}" height="80px" width="80px"
                                                alt="" style="border-radius: 50%;">
                                            <span class="fw-bold">Demo User</span>
                                            <span class="fw-bold">demoemail@kemedar.com</span>
                                            <a href="#" class="btn btn-sm btn-warning fw-bold">SIGN OUT</a>
                                        </div>
                                    </div>
                                @endif
                                @if (\Request::route()->getName() == 'front.page')
                                    <div class="q-gutter row" style="--bs-gutter-x: -0.5rem;">
                                        <a class="q-btn q-btn-item non-selectable no-outline q-btn--standard q-btn--rectangle bg-black text-white q-btn--actionable q-focusable q-hoverable col"
                                            tabindex="0"
                                            href="https://ssoserver.dev2.kemedar.com/sso-login?redirect_uri={{ base64_encode(env('APP_URL')) }}"
                                            style="font-size: 14px;">
                                            <span class="q-focus-helper"></span>
                                            <span
                                                class="q-btn__content text-center col items-center q-anchor--skip justify-center row">
                                                <span class="font-weight-bold">Sign up</span>
                                            </span></a>
                                        <a class="q-btn q-btn-item non-selectable no-outline q-btn--standard q-btn--rectangle q-btn--actionable q-focusable q-hoverable col text-black bg-[#FFC50B]"
                                            tabindex="0"
                                            href="https://ssoserver.dev2.kemedar.com/sso-login?redirect_uri={{ base64_encode(env('APP_URL')) }}"
                                            style="font-size: 14px; margin-left: 8px;">
                                            <span class="q-focus-helper"></span>
                                            <span
                                                class="q-btn__content text-center col items-center q-anchor--skip justify-center row">
                                                <span class="font-weight-bold">Login</span>
                                            </span></a>
                                    </div>

                                    <div class="q-field row  d-flex"
                                        style="height: 38px;
                                background-color: white;
                                border-radius: 3px 3px 0px 0px;
                                margin-top: 10px;
                                width: auto;
                                margin-left: 5px;
                                margin-right: 5px;
                                align-content: space-around;
                                ">
                                        <div class="dropdown">

                                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <span id="showSlBtnLbl">
                                                    @if ($route != '')
                                                        {{ $route }}
                                                    @else
                                                        select a system
                                                    @endif
                                                </span>
                                            </button>
                                            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                                                @for ($i = 0; $i < count($dropdownsidebar); $i++)
                                                    <li class="dpdw-link">
                                                        <a class="dropdown-item {{ $dropdownsidebar[$i]['label'] == $route ? 'active' : '' }}"
                                                            href="{{ $dropdownsidebar[$i]['link'] }}">{{ $dropdownsidebar[$i]['label'] }}</a>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            <div class="relative">
                                @if (isset($sidebar))
                                    @for ($i = 0; $i < count($sidebar); $i++)
                                        <div class="q-item q-item-type row no-wrap " style="--bs-gutter-x: 0.5rem;"
                                            role="listitem">
                                            <div
                                                class="q-item__section column q-item__section--main justify-center bg-[#FFC50B] py-[5px] px-[10px] rounded-md d-flex flex-row justify-between">
                                                <div
                                                    style="display: flex; flex-direction: column; justify-content: center;">
                                                    <div class="q-item__label text-[18px] font-semibold">
                                                        {{ $sidebar[$i]['label'] }}</div>
                                                    {{--                                                <div class="q-item__label text-[14px] text-gray-400 font-semibold"> --}}
                                                    {{--                                                    {{ $sidebar[$i]['sub_title'] }} --}}
                                                    {{--                                                </div> --}}
                                                </div>

                                                @if (!empty($sidebar[$i]['child']))
                                                    <div
                                                        class="q-item__section column q-item__section--side justify-center q-focusable relative-position cursor-pointer">
                                                        <button class="btn btn-toggle align-items-center rounded"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#home-collapse-{{ $sidebar[$i]['id'] }}"
                                                            aria-expanded="false">
                                                            <i class="fa fa-caret-down"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="q-expansion-item q-item-type q-expansion-item--standard text-black"
                                            color="accent">
                                            <div class="q-expansion-item__container relative-position">
                                                {{--                                            <div class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable" --}}
                                                {{--                                                role="button" tabindex="0"> --}}

                                                {{--                                                <div --}}
                                                {{--                                                    class="q-item__section column q-item__section--side justify-center q-item__section--avatar"> --}}
                                                {{--                                                    --}}{{-- <i class="q-icon kem-hp-action-button-find-property"></i> --}}
                                                {{--                                                    <i class="q-icon {{ $sidebar[$i]['icon'] }}"></i> --}}
                                                {{--                                                </div> --}}
                                                {{--                                                <div --}}
                                                {{--                                                    class="q-item__section column q-item__section--main justify-center"> --}}
                                                {{--                                                    <div class="q-item__label">{{ $sidebar[$i]['label'] }}</div> --}}
                                                {{--                                                </div> --}}

                                                {{--                                                @if (!empty($sidebar[$i]['child'])) --}}
                                                {{--                                                    <div --}}
                                                {{--                                                        class="q-item__section column q-item__section--side justify-center q-focusable relative-position cursor-pointer"> --}}
                                                {{--                                                        <button class="btn btn-toggle align-items-center rounded" --}}
                                                {{--                                                            data-bs-toggle="collapse" --}}
                                                {{--                                                            data-bs-target="#home-collapse-{{ $sidebar[$i]['id'] }}" --}}
                                                {{--                                                            aria-expanded="false"> --}}
                                                {{--                                                            <i class="fa fa-caret-down"></i> --}}
                                                {{--                                                        </button> --}}
                                                {{--                                                    </div> --}}
                                                {{--                                                @endif --}}
                                                {{--                                            </div> --}}
                                                @if (!empty($sidebar[$i]['child']))
                                                    <div class="collapse relative-position {{ $i == 0 ? 'show' : '' }}"
                                                        style="margin-left: 10px"
                                                        id="home-collapse-{{ $sidebar[$i]['id'] }}">

                                                        @for ($j = 0; $j < count($sidebar[$i]['child']); $j++)
                                                            <div class="d-flex">
                                                                <a class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable"
                                                                    href="#">

                                                                    <div
                                                                        class="q-item__section column q-item__section--side justify-center q-item__section--avatar">
                                                                        <div
                                                                            class="q-avatar text-black q-chip--colored">
                                                                            <div
                                                                                class="q-avatar__content row flex-center overflow-hidden">
                                                                                @if ($sidebar[$i]['child'][$j]['custom'] == 1)
                                                                                    {!! $sidebar[$i]['icon'] !!}
                                                                                @else
                                                                                    <i
                                                                                        class="q-icon {{ $sidebar[$i]['child'][$j]['icon'] }}"></i>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="q-item__section column q-item__section--main justify-center">
                                                                        {{ $sidebar[$i]['child'][$j]['label'] }}</div>
                                                                </a>
                                                                @if (!empty($sidebar[$i]['child'][$j]['child']))
                                                                    <div
                                                                        class="q-item__section column q-item__section--side justify-center q-focusable relative-position cursor-pointer">
                                                                        <button
                                                                            class="btn btn-toggle align-items-center rounded"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#home-collapse-child-{{ $sidebar[$i]['child'][$j]['id'] }}"
                                                                            aria-expanded="false">
                                                                            <i class="fa fa-caret-down"></i>
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            @if (!empty($sidebar[$i]['child'][$j]['child']))
                                                                <div class="collapse relative-position"
                                                                    style="margin-left: 10px"
                                                                    id="home-collapse-child-{{ $sidebar[$i]['child'][$j]['id'] }}">

                                                                    @for ($k = 0; $k < count($sidebar[$i]['child'][$j]['child']); $k++)
                                                                        <a class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable"
                                                                            href="#">

                                                                            <div class="q-item__section column q-item__section--side justify-center q-item__section--avatar"
                                                                                style="margin-right:-15px">
                                                                                <div
                                                                                    class="q-avatar text-black q-chip--colored">
                                                                                    <div
                                                                                        class="q-avatar__content row flex-center overflow-hidden">
                                                                                        @if ($sidebar[$i]['child'][$j]['child'][$k]['custom'] == 1)
                                                                                            {!! $sidebar[$i]['child'][$j]['icon'] !!}
                                                                                        @else
                                                                                            <i
                                                                                                class="q-icon {{ $sidebar[$i]['child'][$j]['child'][$k]['icon'] }}"></i>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="q-item__section column q-item__section--main justify-center">
                                                                                {{ $sidebar[$i]['child'][$j]['child'][$k]['label'] }}
                                                                            </div>
                                                                        </a>
                                                                    @endfor

                                                                </div>
                                                            @endif
                                                        @endfor

                                                    </div>
                                                @endif
                                            </div>
                                    @endfor
                                @endif
                                @if (isset($sidebarPart2))
                                    @for ($i = 0; $i < count($sidebarPart2); $i++)
                                        <div class="q-item q-item-type row no-wrap " style="--bs-gutter-x: 0.5rem;"
                                            role="listitem">
                                            <div
                                                class="q-item__section column q-item__section--main justify-center bg-[#FFC50B] py-[5px] px-[10px] rounded-md d-flex flex-row justify-between">
                                                <div
                                                    style="display: flex; flex-direction: column; justify-content: center;">
                                                    <div class="q-item__label text-[18px] font-semibold">
                                                        {{ $sidebarPart2[$i]['label'] }}</div>
                                                    {{--                                                <div class="q-item__label text-[14px] text-gray-400 font-semibold"> --}}
                                                    {{--                                                    {{ $sidebarPart2[$i]['sub_title'] }} --}}
                                                    {{--                                                </div> --}}
                                                </div>

                                                @if (!empty($sidebarPart2[$i]['child']))
                                                    <div
                                                        class="q-item__section column q-item__section--side justify-center q-focusable relative-position cursor-pointer">
                                                        <button class="btn btn-toggle align-items-center rounded"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#home-collapse-{{ $sidebarPart2[$i]['id'] }}"
                                                            aria-expanded="false">
                                                            <i class="fa fa-caret-down"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="q-expansion-item q-item-type q-expansion-item--standard text-black"
                                            color="accent">
                                            <div class="q-expansion-item__container relative-position">
                                                {{--                                            <div class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable" --}}
                                                {{--                                                role="button" tabindex="0"> --}}

                                                {{--                                                <div --}}
                                                {{--                                                    class="q-item__section column q-item__section--side justify-center q-item__section--avatar"> --}}
                                                {{--                                                    --}}{{-- <i class="q-icon kem-hp-action-button-find-property"></i> --}}
                                                {{--                                                    <i class="q-icon {{ $sidebar[$i]['icon'] }}"></i> --}}
                                                {{--                                                </div> --}}
                                                {{--                                                <div --}}
                                                {{--                                                    class="q-item__section column q-item__section--main justify-center"> --}}
                                                {{--                                                    <div class="q-item__label">{{ $sidebar[$i]['label'] }}</div> --}}
                                                {{--                                                </div> --}}

                                                {{--                                                @if (!empty($sidebar[$i]['child'])) --}}
                                                {{--                                                    <div --}}
                                                {{--                                                        class="q-item__section column q-item__section--side justify-center q-focusable relative-position cursor-pointer"> --}}
                                                {{--                                                        <button class="btn btn-toggle align-items-center rounded" --}}
                                                {{--                                                            data-bs-toggle="collapse" --}}
                                                {{--                                                            data-bs-target="#home-collapse-{{ $sidebar[$i]['id'] }}" --}}
                                                {{--                                                            aria-expanded="false"> --}}
                                                {{--                                                            <i class="fa fa-caret-down"></i> --}}
                                                {{--                                                        </button> --}}
                                                {{--                                                    </div> --}}
                                                {{--                                                @endif --}}
                                                {{--                                            </div> --}}
                                                @if (!empty($sidebarPart2[$i]['child']))
                                                    <div class="collapse relative-position" style="margin-left: 10px"
                                                        id="home-collapse-{{ $sidebarPart2[$i]['id'] }}">

                                                        @for ($j = 0; $j < count($sidebarPart2[$i]['child']); $j++)
                                                            <div class="d-flex">
                                                                <a class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable"
                                                                    href="#">

                                                                    <div class="q-item__section column q-item__section--side justify-center q-item__section--avatar"
                                                                        style="margin-right:-15px">
                                                                        <div
                                                                            class="q-avatar text-black q-chip--colored">
                                                                            <div
                                                                                class="q-avatar__content row flex-center overflow-hidden">
                                                                                @if ($sidebarPart2[$i]['child'][$j]['custom'] == 1)
                                                                                    {!! $sidebarPart2[$i]['icon'] !!}
                                                                                @else
                                                                                    <i
                                                                                        class="q-icon {{ $sidebarPart2[$i]['child'][$j]['icon'] }}"></i>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="q-item__section column q-item__section--main justify-center">
                                                                        {{ $sidebarPart2[$i]['child'][$j]['label'] }}
                                                                    </div>
                                                                </a>
                                                                @if (!empty($sidebarPart2[$i]['child'][$j]['child']))
                                                                    <div
                                                                        class="q-item__section column q-item__section--side justify-center q-focusable relative-position cursor-pointer">
                                                                        <button
                                                                            class="btn btn-toggle align-items-center rounded"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#home-collapse-child-{{ $sidebarPart2[$i]['child'][$j]['id'] }}"
                                                                            aria-expanded="false">
                                                                            <i class="fa fa-caret-down"></i>
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            @if (!empty($sidebarPart2[$i]['child'][$j]['child']))
                                                                <div class="collapse relative-position"
                                                                    style="margin-left: 10px"
                                                                    id="home-collapse-child-{{ $sidebarPart2[$i]['child'][$j]['id'] }}">

                                                                    @for ($k = 0; $k < count($sidebarPart2[$i]['child'][$j]['child']); $k++)
                                                                        <a class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable"
                                                                            href="#">

                                                                            <div class="q-item__section column q-item__section--side justify-center q-item__section--avatar"
                                                                                style="margin-right:-15px">
                                                                                <div
                                                                                    class="q-avatar text-black q-chip--colored">
                                                                                    <div
                                                                                        class="q-avatar__content row flex-center overflow-hidden">
                                                                                        @if ($sidebarPart2[$i]['child'][$j]['child'][$k]['custom'] == 1)
                                                                                            {!! $sidebarPart2[$i]['child'][$j]['icon'] !!}
                                                                                        @else
                                                                                            <i
                                                                                                class="q-icon {{ $sidebarPart2[$i]['child'][$j]['child'][$k]['icon'] }}"></i>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="q-item__section column q-item__section--main justify-center">
                                                                                {{ $sidebarPart2[$i]['child'][$j]['child'][$k]['label'] }}
                                                                            </div>
                                                                        </a>
                                                                    @endfor

                                                                </div>
                                                            @endif
                                                        @endfor

                                                    </div>
                                                @endif
                                            </div>
                                    @endfor
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </aside>
    </div>

</div>
</div>

</div>
</div>

@push('scripts_bottom')
<script>
    $(".modal-button-left").click(function(){
        $(".system-modal-left").slideToggle();
    });

    $(".close-modal-left").click(function(){
        $(".system-modal-left").slideToggle();
    });
</script>
@endpush
