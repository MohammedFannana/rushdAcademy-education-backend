
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

<?php
    $rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

    $curr_lang = app()->getLocale();
    if(Session::has('site_language')) {
        $curr_lang = Session::get('site_language');
    }

    //$isRtl = ((in_array(mb_strtoupper(app()->getLocale()), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));
    $isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));
?>

<!DOCTYPE html>
<html lang="<?php echo e($curr_lang); ?>" dir="<?php echo e($isRtl ? 'rtl' : 'ltr'); ?>">
<head>
    <?php echo $__env->make(getTemplate().'.includes.metas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <title><?php echo e($pageTitle ?? ''); ?><?php echo e(!empty($generalSettings['site_name']) ? (' | '.$generalSettings['site_name']) : ''); ?></title>

    <!-- General CSS File -->
    <link href="/assets/default/css/font.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/toast/jquery.toast.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/simplebar/simplebar.css">
    <link rel="stylesheet" href="/assets/default/css/app.css">
    <link rel="stylesheet" href="/assets/default/css/panel.css">

    <?php if($isRtl): ?>
        <link rel="stylesheet" href="/assets/default/css/rtl-app.css">
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('styles_top'); ?>
    <?php echo $__env->yieldPushContent('scripts_top'); ?>

    <style>
        <?php echo !empty(getCustomCssAndJs('css')) ? getCustomCssAndJs('css') : ''; ?>


        <?php echo getThemeFontsSettings(); ?>


        <?php echo getThemeColorsSettings(); ?>

    </style>

    <?php if(!empty($generalSettings['preloading']) and $generalSettings['preloading'] == '1'): ?>
        <?php echo $__env->make('admin.includes.preloading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!-- Common Layout Style -->
    <!-- link -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <!-- custom stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <!-- font awesome css -->
    <link href="<?php echo e(asset('fontawesome-pro/css/all.min.css')); ?>" rel="stylesheet" />
    <!-- font awesome js-->
    <script src="<?php echo e(asset('fontawesome-pro/js/all.min.js')); ?>"></script>
    <!-- kemedar Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('fonts/kemeder-icons.css')); ?>" />
    <!-- kemedar icons mobile -->
    
    <link href="<?php echo e(asset('css/select2.min.css')); ?>" rel="stylesheet" />

    <!-- mobile stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('css/media.css')); ?>" />

    <!-- jquery -->
    <!-- <script src="<?php echo e(asset('js/jquery.js')); ?>"></script>   -->
    <!-- scrollbar css -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.css">
	<script src="//unpkg.com/alpinejs"></script>

    <link href="<?php echo e(asset('css/leftsidebar.css')); ?>" rel="stylesheet">

    <?php if((!empty($alignment) && $alignment == 'rtl') || $isRtl): ?>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">

		<link rel="stylesheet" href="<?php echo e(asset('css/rtl-style.css')); ?>">

		<script src="<?php echo e(asset('js/rtl-script.js')); ?>" defer></script>

		<?php if(\Request::route()->getName() == 'sidebar.page'): ?>
		<script>
			$(document).ready(function()
			{
				setTimeout(function(){
					$('div[style*="left: -1000px"]').css({'left':0,'right':-1000});
				},500);
			});
		 </script>
		 <?php endif; ?>

         <style>
            .top-bar .left-side .nav {
                margin-right: 36px !important;
            }
         </style>
	<?php else: ?>
		<link rel="stylesheet" href="<?php echo e(asset('css/ltr-style.css')); ?>">

		<script src="<?php echo e(asset('js/ltr-script.js')); ?>" defer></script>
	<?php endif; ?>

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
<body class="<?php if($isRtl): ?> rtl <?php endif; ?>">

<?php
    $isPanel = true;
    $hasFixedSidebar = true;
?>

<div id="panel_app">
    

    <?php echo $__env->make('web.default.includes.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if (isset($component)) { $__componentOriginal2b742629e15158ed9b91ce923200fa48a26082cb = $component; } ?>
<?php $component = App\View\Components\Web\LeftSidebar::resolve(['lang' => ''.e($curr_lang).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('web.left-sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Web\LeftSidebar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b742629e15158ed9b91ce923200fa48a26082cb)): ?>
<?php $component = $__componentOriginal2b742629e15158ed9b91ce923200fa48a26082cb; ?>
<?php unset($__componentOriginal2b742629e15158ed9b91ce923200fa48a26082cb); ?>
<?php endif; ?>

    <div class="d-flex justify-content-end" id="MET">

        <!-- <?php if( auth()->user()->role_id == 4 ): ?>
            <?php echo $__env->make('web.default.panel.includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php endif; ?> -->

        <!-- <?php if( auth()->user()->role_id == 1 ): ?> -->
            <!-- Fixed Sidebar -->
        <!-- <?php endif; ?> -->

        <?php if (isset($component)) { $__componentOriginal78d752c922275a344f052ba60cd6fd6319965eb6 = $component; } ?>
<?php $component = App\View\Components\Web\Sidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('web.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Web\Sidebar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal78d752c922275a344f052ba60cd6fd6319965eb6)): ?>
<?php $component = $__componentOriginal78d752c922275a344f052ba60cd6fd6319965eb6; ?>
<?php unset($__componentOriginal78d752c922275a344f052ba60cd6fd6319965eb6); ?>
<?php endif; ?>

        <div class="panel-content panel-width-user" id="AGF">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <?php echo $__env->make('web.default.includes.advertise_modal.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php if($authUser->checkAccessToAIContentFeature()): ?>
        <?php echo $__env->make('web.default.panel.includes.aiContent.generator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</div>


<!-- Template JS File -->
<script src="/assets/default/js/app.js"></script>
<script src="/assets/default/vendors/moment.min.js"></script>
<script src="/assets/default/vendors/feather-icons/dist/feather.min.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="/assets/default/vendors/toast/jquery.toast.min.js"></script>
<!-- javascript -->
<script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.js"></script>
<!-- <script src="<?php echo e(asset('js/javascript.js')); ?>"></script> -->
 <!-- <script type="text/javascript" src="/assets/default/vendors/simplebar/simplebar.min.js"></script>  -->

<script>
    var deleteAlertTitle = '<?php echo e(trans('public.are_you_sure')); ?>';
    var deleteAlertHint = '<?php echo e(trans('public.deleteAlertHint')); ?>';
    var deleteAlertConfirm = '<?php echo e(trans('public.deleteAlertConfirm')); ?>';
    var deleteAlertCancel = '<?php echo e(trans('public.cancel')); ?>';
    var deleteAlertSuccess = '<?php echo e(trans('public.success')); ?>';
    var deleteAlertFail = '<?php echo e(trans('public.fail')); ?>';
    var deleteAlertFailHint = '<?php echo e(trans('public.deleteAlertFailHint')); ?>';
    var deleteAlertSuccessHint = '<?php echo e(trans('public.deleteAlertSuccessHint')); ?>';
    var forbiddenRequestToastTitleLang = '<?php echo e(trans('public.forbidden_request_toast_lang')); ?>';
    var forbiddenRequestToastMsgLang = '<?php echo e(trans('public.forbidden_request_toast_msg_lang')); ?>';
    var generatedContentLang = '<?php echo e(trans('update.generated_content')); ?>';
    var copyLang = '<?php echo e(trans('public.copy')); ?>';
    var doneLang = '<?php echo e(trans('public.done')); ?>';
</script>

<?php if(session()->has('toast')): ?>
    <script>
        (function () {
            "use strict";

            $.toast({
                heading: '<?php echo e(session()->get('toast')['title'] ?? ''); ?>',
                text: '<?php echo e(session()->get('toast')['msg'] ?? ''); ?>',
                bgColor: '<?php if(session()->get('toast')['status'] == 'success'): ?> #43d477 <?php else: ?> #f63c3c <?php endif; ?>',
                textColor: 'white',
                hideAfter: 10000,
                position: 'bottom-right',
                icon: '<?php echo e(session()->get('toast')['status']); ?>'
            });
        })(jQuery)
    </script>
<?php endif; ?>

<?php echo $__env->yieldPushContent('styles_bottom'); ?>
<?php echo $__env->yieldPushContent('scripts_bottom'); ?>

<script src="/assets/default/js//parts/main.min.js"></script>
<script src="/assets/default/js/panel/public.min.js"></script>
<script src="/assets/default/js/panel/ai-content-generator.min.js"></script>

<?php echo $__env->yieldPushContent('scripts_bottom2'); ?>

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






    <?php if(session()->has('registration_package_limited')): ?>
    (function () {
        "use strict";

        handleLimitedAccountModal('<?php echo session()->get('registration_package_limited'); ?>')
    })(jQuery)

    <?php echo e(session()->forget('registration_package_limited')); ?>

    <?php endif; ?>

    <?php echo !empty(getCustomCssAndJs('js')) ? getCustomCssAndJs('js') : ''; ?>

</script>

</body>
</html>

<link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">


<?php /**PATH D:\project\gazacademy\resources\views/web/default/panel/layouts/panel_layout.blade.php ENDPATH**/ ?>