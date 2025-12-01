
<style>

 [dir='rtl'] #ENS {
         position: absolute !important;
         left: 0 !important;
         padding-left: 14px !important;
         padding-top: 7px !important ;
}

    [dir='rtl'] .right-arrow {
    transform: rotate(180deg) !important;

}

.toooltip-content{
    transform:none !important;
}
#Xlogo{
        transform: translate(0px, 10px);
}
    #img-banner{
     width: 100%;
    height: 88% !important;
    position: relative;
    top: 46px !important;
    }

 @media only screen and (max-width:995px){
    #AGF {
        /*transform:translate(0px, -75px) !important;*/
    position: relative !important ;
    width: 100% !important;
    bottom:72px !important;
    pointer-events: none !important;
}

   .account-balance-icon{
       display :inline-block !important;
   }
  #img-banner {
          height: 15% !important;
  }


   .account-balance-icon {
            align-content: center !important;
    }

}
  [dir='rtl']  .column-3{
        right : -350px;
    }


</style>

@php
    $rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

    $curr_lang = app()->getLocale();
    if(Session::has('site_language')) {
        $curr_lang = Session::get('site_language');
    }

    //$isRtl = ((in_array(mb_strtoupper(app()->getLocale()), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));
    $isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));
@endphp

<!DOCTYPE html>
<html lang="{{ $curr_lang }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
<head>
    @include(getTemplate().'.includes.metas')
    <title>{{ $pageTitle ?? '' }}{{ !empty($generalSettings['site_name']) ? (' | '.$generalSettings['site_name']) : '' }}</title>

    <!-- General CSS File -->
    <link href="/assets/default/css/font.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/toast/jquery.toast.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/simplebar/simplebar.css">
    <link rel="stylesheet" href="/assets/default/css/app.css">
    <link rel="stylesheet" href="/assets/default/css/panel.css">

    @if($isRtl)
        <link rel="stylesheet" href="/assets/default/css/rtl-app.css">
    @endif

    @stack('styles_top')
    @stack('scripts_top')

    <style>
        {!! !empty(getCustomCssAndJs('css')) ? getCustomCssAndJs('css') : '' !!}

        {!! getThemeFontsSettings() !!}

        {!! getThemeColorsSettings() !!}
    </style>

    @if(!empty($generalSettings['preloading']) and $generalSettings['preloading'] == '1')
        @include('admin.includes.preloading')
    @endif

    <!-- Common Layout Style -->
    <!-- link -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- custom stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    <!-- <script src="{{ asset('js/jquery.js') }}"></script>   -->
    <!-- scrollbar css -->
    {{-- <!-- <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}"> --> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.css">
	<script src="//unpkg.com/alpinejs"></script>

    <link href="{{ asset('css/leftsidebar.css') }}" rel="stylesheet">

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

         <style>
            .top-bar .left-side .nav {
                margin-right: 36px !important;
            }
         </style>
	@else
		<link rel="stylesheet" href="{{ asset('css/ltr-style.css') }}">

		<script src="{{ asset('js/ltr-script.js') }}" defer></script>
	@endif

    <!-- Common Layout :: end -->

    <style>
:root{
  --sidebar-w: 320px;
  --topbar-h: 0px;
}
.sidebar-main{
  position: fixed;
  inset-inline-start: 0;
  inset-block-start: var(--topbar-h);
  width: var(--sidebar-w);
  height: calc(100vh - var(--topbar-h));
  overflow-y: auto;
  z-index: 1020;
  background: #f5f6f8;
  box-shadow: 0 0 8px rgba(0,0,0,.08);
}
.panel-content{
  margin-inline-start: var(--sidebar-w);
  width: calc(100% - var(--sidebar-w));
  min-height: 100vh;
  transition: margin-inline-start .2s ease, width .2s ease;
}
#MET{
  justify-content: normal !important;
}
@media (max-width: 992px){
  :root{ --sidebar-w: 0px; }
  .sidebar-main{ display: none; }
  .panel-content{
    margin-inline-start: 0;
    width: 100%;
  }
}
</style>


</head>
<body class="@if($isRtl) rtl @endif">

@php
    $isPanel = true;
    $hasFixedSidebar = true;
@endphp

<div id="panel_app">
    {{-- <x-web.topbar /> --}}

    @include('web.default.includes.navbar')

    <x-web.left-sidebar lang="{{ $curr_lang }}"/>

    <div class="d-flex justify-content-end" id="MET">

        <!-- @if ( auth()->user()->role_id == 4 )
            @include('web.default.panel.includes.sidebar')

        @endif -->

        <!-- @if ( auth()->user()->role_id == 1 ) -->
            <!-- Fixed Sidebar -->
        <!-- @endif -->

        <x-web.sidebar />

        <div class="panel-content panel-width-user" id="AGF">
            @yield('content')
        </div>
    </div>

    @include('web.default.includes.advertise_modal.index')

    {{-- AI Contents --}}
    @if($authUser->checkAccessToAIContentFeature())
        @include('web.default.panel.includes.aiContent.generator')
    @endif
</div>
{{-- 111111111111 --}}
{{-- <footer>
    <x-web.bottombar />
</footer> --}}
<!-- Template JS File -->
<script src="/assets/default/js/app.js"></script>
<script src="/assets/default/vendors/moment.min.js"></script>
<script src="/assets/default/vendors/feather-icons/dist/feather.min.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="/assets/default/vendors/toast/jquery.toast.min.js"></script>
<!-- javascript -->
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.js"></script>
<!-- <script src="{{ asset('js/javascript.js') }}"></script> -->
 <!-- <script type="text/javascript" src="/assets/default/vendors/simplebar/simplebar.min.js"></script>  -->

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
    var generatedContentLang = '{{ trans('update.generated_content') }}';
    var copyLang = '{{ trans('public.copy') }}';
    var doneLang = '{{ trans('public.done') }}';
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

<script src="/assets/default/js//parts/main.min.js"></script>
<script src="/assets/default/js/panel/public.min.js"></script>
<script src="/assets/default/js/panel/ai-content-generator.min.js"></script>

@stack('scripts_bottom2')

<script>
    $(document).ready(function () {
        $(".modal-button-desktop li").on("click", function () {
            $(".system-modal-left").slideToggle();
        });
        $(".close-modal-left").click(function () {
            $(".system-modal-left").slideToggle();
        });

    })


        $('.sidebar-main .bar').scrollbar();
    //$('.scrollbar-inner').scrollbar();


    $(".sidebar-main .bar .list .list-button").on("click",function(){
        $(".sidebar-main .bar .list .list-button").not(this).next(".nav-dropdown").removeClass("sidebar-dropdown");
        $(".sidebar-main .bar .list .nav-dropdown .subnav .nav-item .sub-button").not(this).next(".sub-nav-dropdown").removeClass("sidebar-dropdown");
        $(this).next(".nav-dropdown").toggleClass("sidebar-dropdown");
        $(".sidebar-main .bar .list").not(this).removeClass("active");
        $(this).parent().toggleClass("active");
    });

    $(".sidebar-main .bar .list .nav-dropdown .nav-close").on("click",function(){
        $(".sidebar-main .bar .list .list-button").not(this).next(".nav-dropdown").removeClass("sidebar-dropdown");
        $(".sidebar-main .bar .list .nav-dropdown .subnav .nav-item .sub-button").not(this).next(".sub-nav-dropdown").removeClass("sidebar-dropdown");
    });

    $('.sidebar-main .bar .list .nav-dropdown .subnav .nav-item .sub-nav-dropdown .sub-nav-close').on("click",function(){
        $(".sidebar-main .bar .list .nav-dropdown .subnav .nav-item .sub-button").not(this).next(".sub-nav-dropdown").removeClass("sidebar-dropdown");
    });

    $(".sidebar-main .bar .list .nav-dropdown .subnav .nav-item .sub-button").on("click",function(){
        $(".sidebar-main .bar .list .nav-dropdown .subnav .nav-item .sub-button").not(this).next(".sub-nav-dropdown").removeClass("sidebar-dropdown");
        $(this).next('.sub-nav-dropdown').toggleClass("sidebar-dropdown");
        $(".sidebar-main .bar .list .nav-dropdown .subnav .nav-item").not(this).removeClass("active");
        $(this).parent().toggleClass("active");
    });


    $(".main-box .accordion-list").on("click",function(){
        var data = document.getElementsByClassName('child-accordion')[$(this).index()];
        $(".child-accordion").not(data).slideUp();
        $(data).slideToggle();
    });

    $(".main-box .sub-accordion-list").on("click",function(){
        var currentParentIndex = $(this).parent().parent().index(".child-accordion");
        console.log(currentParentIndex);
        var data = document.getElementsByClassName('child-accordion')[currentParentIndex];
        var openSlide = data.children[$(this).index()+3];
        $(".sub-child-accordion").not(openSlide).slideUp();
        $(openSlide).slideToggle();
    });






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

<link rel="stylesheet" href="{{ asset('css/custom.css') }}">


