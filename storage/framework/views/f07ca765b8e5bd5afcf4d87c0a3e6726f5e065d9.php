<?php
    $rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

    $curr_lang = app()->getLocale();
    if(Session::has('site_language')) {
        $curr_lang = Session::get('site_language');
    }

    $isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));
?>

<!DOCTYPE html>
<html lang="<?php echo e($curr_lang); ?>" dir="<?php echo e($isRtl ? 'rtl' : 'ltr'); ?>">

<head>
    <?php echo $__env->make('web.default.includes.metas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <title><?php echo e($pageTitle ?? ''); ?><?php echo e(!empty($generalSettings['site_name']) ? (' | '.$generalSettings['site_name']) : ''); ?></title>

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

    <?php if($isRtl): ?>
        <link rel="stylesheet" href="/assets/default/css/rtl-app.css">
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('styles_top'); ?>
    <?php echo $__env->yieldPushContent('scripts_top'); ?>

    
    <!-- link -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <!-- custom stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">
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
    <script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
    <!-- scrollbar css -->
    
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.js"></script>

		<script src="//unpkg.com/alpinejs" defer></script>
        <script src="<?php echo e(asset("js/javascript.js")); ?>"></script>

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
	<?php else: ?>
		<link rel="stylesheet" href="<?php echo e(asset('css/ltr-style.css')); ?>">

		<script src="<?php echo e(asset('js/ltr-script.js')); ?>" defer></script>
	<?php endif; ?>

    <style>
        <?php echo !empty(getCustomCssAndJs('css')) ? getCustomCssAndJs('css') : ''; ?>


        <?php echo getThemeFontsSettings(); ?>


        <?php echo getThemeColorsSettings(); ?>

    </style>


    <?php if(!empty($generalSettings['preloading']) and $generalSettings['preloading'] == '1'): ?>
        <?php echo $__env->make('admin.includes.preloading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</head>

<body class="<?php if($isRtl): ?> rtl <?php endif; ?>">



    

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

<div id="app" class="<?php echo e((!empty($floatingBar) and $floatingBar->position == 'top' and $floatingBar->fixed) ? 'has-fixed-top-floating-bar' : ''); ?>">
    <?php if(!empty($floatingBar) and $floatingBar->position == 'top'): ?>
        <?php echo $__env->make('web.default.includes.floating_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if(!isset($appHeader)): ?>
        
        
        
    <?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal222802ae2f53722e324d385bcdc8d2f1e92af59b = $component; } ?>
<?php $component = App\View\Components\Web\Navbar::resolve(['lang' => ''.e($curr_lang).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('web.navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Web\Navbar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal222802ae2f53722e324d385bcdc8d2f1e92af59b)): ?>
<?php $component = $__componentOriginal222802ae2f53722e324d385bcdc8d2f1e92af59b; ?>
<?php unset($__componentOriginal222802ae2f53722e324d385bcdc8d2f1e92af59b); ?>
<?php endif; ?>

    <?php if(!empty($justMobileApp)): ?>
        <?php echo $__env->make('web.default.includes.mobile_app_top_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    
    

    <?php echo $__env->yieldContent('content'); ?>

    
    <!-- Fixed Sidebar -->

    
    

    <footer>
        
        <?php echo $__env->make('web.default.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        
    </footer>

    

    

    <?php echo $__env->make('web.default.includes.advertise_modal.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(!empty($floatingBar) and $floatingBar->position == 'bottom'): ?>
        <?php echo $__env->make('web.default.includes.floating_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</div>
<!-- Template JS File -->
<script src="/assets/default/js/app.js"></script>
<script src="/assets/default/vendors/feather-icons/dist/feather.min.js"></script>
<script src="/assets/default/vendors/moment.min.js"></script>
<script src="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="/assets/default/vendors/toast/jquery.toast.min.js"></script>
<script type="text/javascript" src="/assets/default/vendors/simplebar/simplebar.min.js"></script>

<?php if(empty($justMobileApp) and checkShowCookieSecurityDialog()): ?>
    <?php echo $__env->make('web.default.includes.cookie-security', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>


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

<script src="/assets/default/js/parts/main.min.js"></script>

<script>
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

<?php /**PATH D:\project\gazacademy\resources\views/web/default/layouts/app.blade.php ENDPATH**/ ?>