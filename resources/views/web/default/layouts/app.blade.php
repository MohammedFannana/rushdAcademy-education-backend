@php
    $rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

    $curr_lang = app()->getLocale();
    if(Session::has('site_language')) {
        $curr_lang = Session::get('site_language');
    }

    $isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));
@endphp

<!DOCTYPE html>
<html lang="{{ $curr_lang }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">

<head>
    @include('web.default.includes.metas')
    <title>{{ $pageTitle ?? '' }}{{ !empty($generalSettings['site_name']) ? (' | '.$generalSettings['site_name']) : '' }}</title>

    <!-- General CSS File -->
    <link rel="stylesheet" href="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/toast/jquery.toast.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/simplebar/simplebar.css">
    <link rel="stylesheet" href="/assets/default/css/app.css">

    <!-- ----------------------------------------------------------------------- -->
    <link rel="text/javascript" href="/js/ltr-script.js">
    <link rel="text/javascript" href="/js/rtl-script.js">
    <!-- <link rel="stylesheet" href="/css/rtl-style.css"> -->
    <!-- <link rel="stylesheet" href="/css/leftsidebar.css">
    <link rel="stylesheet" href="/js/select2.min.js">
    <link rel="stylesheet" href="/js/jquery.js">
    <link rel="stylesheet" href="/js/app.js">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/media.css">
    <link rel="stylesheet" href="/css/select2.min.css">
    <link rel="stylesheet" href="/fonts/kemeder-icons.css">
    <link rel="stylesheet" href="/fontawesome-pro/js/all.min.js"> -->

    @if($isRtl)
        <link rel="stylesheet" href="/assets/default/css/rtl-app.css">
    @endif

    @stack('styles_top')
    @stack('scripts_top')

    {{-- Common Layout Style --}}
    <!-- link -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- custom stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- font awesome css -->
    <link href="{{ asset('fontawesome-pro/css/all.min.css') }}" rel="stylesheet" />
    <!-- font awesome js-->
    <script src="{{ asset('fontawesome-pro/js/all.min.js') }}"></script>
    <!-- kemedar Icons -->
    <link rel="stylesheet" href="{{ asset('fonts/kemeder-icons.css') }}" />
    <!-- kemedar icons mobile -->
    {{-- <link rel="stylesheet" href="{{asset('fonts/index.e5d789a3.css')}}" /> --}}
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />

    <!-- mobile stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/media.css') }}" />

    <!-- jquery -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!-- scrollbar css -->
    {{-- <!-- <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}"> --> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.js"></script>

		<script src="//unpkg.com/alpinejs" defer></script>
        <script src="{{ asset("js/javascript.js") }}"></script>

    <link href="{{ asset('css/leftsidebar.css') }}" rel="stylesheet">
    {{--<link rel="stylesheet" href="{{ asset('css/color1.css') }}">--}}

	@if ((!empty($alignment) && $alignment == 'rtl') || $isRtl)
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">

		<link rel="stylesheet" href="{{ asset('css/rtl-style.css') }}">

		<script src="{{ asset('js/rtl-script.js') }}" defer></script>

		@if (\Request::route()->getName() == 'sidebar.page')
		<script>
			$(document).ready(function()
			{
				setTimeout(function(){
					$('div[style*="left: -1000px"]').css({'left':0,'right':-1000});
				},500);
			});
		 </script>
		 @endif
	@else
		<link rel="stylesheet" href="{{ asset('css/ltr-style.css') }}">

		<script src="{{ asset('js/ltr-script.js') }}" defer></script>
	@endif

    <style>
        {!! !empty(getCustomCssAndJs('css')) ? getCustomCssAndJs('css') : '' !!}

        {!! getThemeFontsSettings() !!}

        {!! getThemeColorsSettings() !!}
    </style>


    @if(!empty($generalSettings['preloading']) and $generalSettings['preloading'] == '1')
        @include('admin.includes.preloading')
    @endif
</head>

<body class="@if($isRtl) rtl @endif">



    {{-- <x-web.topbar lang="{{ $curr_lang }}" /> --}}

    <x-web.left-sidebar lang="{{ $curr_lang }}"/>

<div id="app" class="{{ (!empty($floatingBar) and $floatingBar->position == 'top' and $floatingBar->fixed) ? 'has-fixed-top-floating-bar' : '' }}">
    @if(!empty($floatingBar) and $floatingBar->position == 'top')
        @include('web.default.includes.floating_bar')
    @endif

    @if(!isset($appHeader))
        {{-- @include('web.default.includes.top_nav') --}}
        {{-- @include('web.default.includes.navbar') --}}
        {{-- <x-web.navbar lang="{{ $curr_lang }}"/> --}}
    @endif
    <x-web.navbar lang="{{ $curr_lang }}"/>

    @if(!empty($justMobileApp))
        @include('web.default.includes.mobile_app_top_nav')
    @endif

    {{-- Add normal sidebar --}}
    {{-- @if (auth()->user() && auth()->user()->role_name != 'admin')
        <!-- Fixed Sidebar -->
        <x-web.sidebar />
    @endif --}}

    @yield('content')

    {{-- Add fixed sidebar and footer --}}
    <!-- Fixed Sidebar -->

    {{-- two 22222222222222 --}}
    {{-- <x-web.fixedside lang="{{ $curr_lang }}" /> --}}

    <footer>
        {{-- @if (\Request::route()->getName() == 'front.page')
            @include('web.default.includes.footer')
        @endif --}}
        @include('web.default.includes.footer')

        {{-- 33333333333333333 --}}
        {{-- @if(!isset($appFooter))
            <x-web.bottombar lang="{{ $curr_lang }}" />
        @endif --}}
    </footer>

    {{-- <footer>
        <x-web.bottombar />
    </footer> --}}

    {{-- <footer>
        @if (\Request::route()->getName() == 'front.page')
            <x-web.footer />
        @endif
    </footer> --}}

    @include('web.default.includes.advertise_modal.index')

    @if(!empty($floatingBar) and $floatingBar->position == 'bottom')
        @include('web.default.includes.floating_bar')
    @endif
</div>
<!-- Template JS File -->
<script src="/assets/default/js/app.js"></script>
<script src="/assets/default/vendors/feather-icons/dist/feather.min.js"></script>
<script src="/assets/default/vendors/moment.min.js"></script>
<script src="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="/assets/default/vendors/toast/jquery.toast.min.js"></script>
<script type="text/javascript" src="/assets/default/vendors/simplebar/simplebar.min.js"></script>

@if(empty($justMobileApp) and checkShowCookieSecurityDialog())
    @include('web.default.includes.cookie-security')
@endif


<script>
    var deleteAlertTitle = '{{ trans('public.are_you_sure') }}';
    var deleteAlertHint = '{{ trans('public.deleteAlertHint') }}';
    var deleteAlertConfirm = '{{ trans('public.deleteAlertConfirm') }}';
    var deleteAlertCancel = '{{ trans('public.cancel') }}';
    var deleteAlertSuccess = '{{ trans('public.success') }}';
    var deleteAlertFail = '{{ trans('public.fail') }}';
    var deleteAlertFailHint = '{{ trans('public.deleteAlertFailHint') }}';
    var deleteAlertSuccessHint = '{{ trans('public.deleteAlertSuccessHint') }}';
    var forbiddenRequestToastTitleLang = '{{ trans('public.forbidden_request_toast_lang') }}';
    var forbiddenRequestToastMsgLang = '{{ trans('public.forbidden_request_toast_msg_lang') }}';
</script>

@if(session()->has('toast'))
    <script>
        (function () {
            "use strict";

            $.toast({
                heading: '{{ session()->get('toast')['title'] ?? '' }}',
                text: '{{ session()->get('toast')['msg'] ?? '' }}',
                bgColor: '@if(session()->get('toast')['status'] == 'success') #43d477 @else #f63c3c @endif',
                textColor: 'white',
                hideAfter: 10000,
                position: 'bottom-right',
                icon: '{{ session()->get('toast')['status'] }}'
            });
        })(jQuery)
    </script>
@endif

@stack('styles_bottom')
@stack('scripts_bottom')

<script src="/assets/default/js/parts/main.min.js"></script>

<script>
    @if(session()->has('registration_package_limited'))
    (function () {
        "use strict";

        handleLimitedAccountModal('{!! session()->get('registration_package_limited') !!}')
    })(jQuery)

    {{ session()->forget('registration_package_limited') }}
    @endif

    {!! !empty(getCustomCssAndJs('js')) ? getCustomCssAndJs('js') : '' !!}
</script>


</body>
</html>

