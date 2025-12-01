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
<?php
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
?>

<?php
    $curr_lang = app()->getLocale();
    if(Session::has('site_language')) {
        $curr_lang = Session::get('site_language');
    }
?>


<div id="navbarV">
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
</div>
<!-- <div id="navbarVacuum">  </div> -->
<nav id="navbar"
    class="navbar navbar-expand-lg navbar-yellow <?php echo e($is_panel == 1 ? (auth()->user()->role_id == 4 ? '' : (!$isRtl ? 'left-margin' : 'right-margin')) : ''); ?>">
    <div class="<?php echo e((!empty($isPanel) and $isPanel) ? 'container-fluid' : 'container'); ?>">
        <div class="d-flex align-items-center justify-content-between w-100">

            <a class="navbar-brand navbar-order d-flex align-items-center justify-content-center mr-0 <?php echo e((empty($navBtnUrl) and empty($navBtnText)) ? 'ml-auto' : ''); ?>"
                href="/" style="<?php echo e($isRtl ? 'margin-right: 5px !important' : ''); ?>">
                <img src="<?php echo e(asset('images/kemecademy-logo.png')); ?>" height="50" width="180"
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
                    <?php if(!empty($categories) and count($categories)): ?>
                        <li class="mr-lg-25">
                            <div class="menu-category">
                                <ul>
                                    <li class="cursor-pointer user-select-none d-flex xs-categories-toggle">
                                        <i data-feather="grid" width="20" height="20" class="mr-10 d-none d-lg-block"></i>
                                        <?php echo e(trans('categories.categories')); ?>


                                        <ul class="cat-dropdown-menu">
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <a href="<?php echo e($category->getUrl()); ?>"
                                                        class="<?php echo e((!empty($category->subCategories) and count($category->subCategories)) ? 'js-has-subcategory' : ''); ?>">
                                                        <div class="d-flex align-items-center">
                                                            <img src="<?php echo e($category->icon); ?>"
                                                                class="cat-dropdown-menu-icon mr-10"
                                                                alt="<?php echo e($category->title); ?> icon">
                                                            <?php echo e($category->title); ?>

                                                        </div>

                                                        <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                                                            <i data-feather="chevron-right" width="20" height="20"
                                                                class="d-none d-lg-inline-block ml-10"></i>
                                                            <i data-feather="chevron-down" width="20" height="20"
                                                                class="d-inline-block d-lg-none"></i>
                                                        <?php endif; ?>
                                                    </a>

                                                    <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                                                        <ul class="sub-menu" data-simplebar <?php if((!empty($isRtl) and $isRtl)): ?>
                                                        data-simplebar-direction="rtl" <?php endif; ?>>
                                                            <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li>
                                                                    <a href="<?php echo e($subCategory->getUrl()); ?>">
                                                                        <?php if(!empty($subCategory->icon)): ?>
                                                                            <img src="<?php echo e($subCategory->icon); ?>"
                                                                                class="cat-dropdown-menu-icon mr-10"
                                                                                alt="<?php echo e($subCategory->title); ?> icon">
                                                                        <?php endif; ?>

                                                                        <?php echo e($subCategory->title); ?>

                                                                    </a>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php
                    $navbarPages = array_values(array_filter($navbarPages, function ($item) {
                        if ($item['link'] === '/register') {
                            return auth()->check() && auth()->user()->role_id === 1;
                        }
                        return true;
                    }));
                ?>

                    <?php if(!empty($navbarPages) and count($navbarPages)): ?>
                        <?php $__currentLoopData = $navbarPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navbarPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e($navbarPage['link']); ?>"><?php echo e($navbarPage['title']); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
            </div>



            <div class="nav-icons-or-start-live navbar-order d-flex align-items-center justify-content-end">



                <div class=" nav-notify-cart-dropdown top-navbar" style="display: flex !important;">
                    <?php echo $__env->make('web.default.includes.shopping-cart-dropdwon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="border-left mx-15"></div>

                    <?php echo $__env->make('web.default.includes.notification-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="border-left mx-15"></div>

                    

                    <div class="border-left mx-15"></div>

                    <div class="custom-dropdown navbar-auth-user-dropdown position-relative">
                        <div class="custom-dropdown-toggle d-flex align-items-center navbar-user cursor-pointer">
                            <img id="topnavbar-user"   src="<?php echo e($authUser->getAvatar(32)); ?>" class="rounded-circle" alt="<?php echo e($authUser->full_name); ?>">
                            
                        </div>

                        <div class="custom-dropdown-body pb-10">

                            <div class="dropdown-user-avatar d-flex align-items-center p-15 m-15 mb-10 rounded-sm border">
                                <div class="size-40 rounded-circle position-relative">
                                    <img src="<?php echo e($authUser->getAvatar()); ?>" class="img-cover rounded-circle" alt="<?php echo e($authUser->full_name); ?>">
                                </div>

                                <div class="ml-5">
                                    <div class="font-14 font-weight-bold text-secondary"><?php echo e($authUser->full_name); ?></div>
                                    <span class="mt-5 text-gray font-12"><?php echo e($authUser->role->caption); ?></span>
                                </div>
                            </div>

                            <ul class="my-8">
                                <?php if($authUser->isAdmin()): ?>
                                    <li class="navbar-auth-user-dropdown-item">
                                        <a href="<?php echo e(getAdminPanelUrl()); ?>" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                            <img src="/assets/default/img/icons/user_menu/dashboard.svg" class="icons">
                                            <span class="ml-5"><?php echo e(trans('panel.dashboard')); ?></span>
                                        </a>
                                    </li>

                                    <li class="navbar-auth-user-dropdown-item">
                                        <a href="<?php echo e(getAdminPanelUrl("/settings")); ?>" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                            <img src="/assets/default/img/icons/user_menu/settings.svg" class="icons">
                                            <span class="ml-5"><?php echo e(trans('panel.settings')); ?></span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li class="navbar-auth-user-dropdown-item">
                                        <a href="/panel" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                            <img src="/assets/default/img/icons/user_menu/dashboard.svg" class="icons">
                                            <span class="ml-5"><?php echo e(trans('panel.dashboard')); ?></span>
                                        </a>
                                    </li>


                                    <li class="navbar-auth-user-dropdown-item">
                                        <a href="<?php echo e(($authUser->isUser()) ? '/panel/webinars/purchases' : '/panel/webinars'); ?>" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                            <img src="/assets/default/img/icons/user_menu/my_courses.svg" class="icons">
                                            <span class="ml-5"><?php echo e(trans('update.my_courses')); ?></span>
                                        </a>
                                    </li>

                                    <?php if(!$authUser->isUser()): ?>
                                        <li class="navbar-auth-user-dropdown-item">
                                            <a href="/panel/financial/sales" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                                <img src="/assets/default/img/icons/user_menu/sales_history.svg" class="icons">
                                                <span class="ml-5"><?php echo e(trans('financial.sales_history')); ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <li class="navbar-auth-user-dropdown-item">
                                        <a href="/panel/support" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                            <img src="/assets/default/img/icons/user_menu/support.svg" class="icons">
                                            <span class="ml-5"><?php echo e(trans('panel.support')); ?></span>
                                        </a>
                                    </li>

                                    <?php if(!$authUser->isUser()): ?>
                                        <li class="navbar-auth-user-dropdown-item">
                                            <a href="<?php echo e($authUser->getProfileUrl()); ?>" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                                <img src="/assets/default/img/icons/user_menu/profile.svg" class="icons">
                                                <span class="ml-5"><?php echo e(trans('public.profile')); ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <li class="navbar-auth-user-dropdown-item">
                                        <a href="/panel/setting" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                                            <img src="/assets/default/img/icons/user_menu/settings.svg" class="icons">
                                            <span class="ml-5"><?php echo e(trans('panel.settings')); ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <li class="navbar-auth-user-dropdown-item">
                                    <a href="/logout" class="d-flex align-items-center w-100 px-15 py-10 text-danger font-14 bg-transparent">
                                        <img src="/assets/default/img/icons/user_menu/logout.svg" class="icons">
                                        <span class="ml-5"><?php echo e(trans('auth.logout')); ?></span>
                                    </a>
                                </li>

                            </ul>

                        </div>
                    </div>

                </div>


                <!-- <?php if(!empty($navBtnUrl)): ?>
                    <a href="<?php echo e($navBtnUrl); ?>" class="d-none d-lg-flex btn btn-sm btn-primary nav-start-a-live-btn">
                        <?php echo e($navBtnText); ?>

                    </a>

                    <a href="<?php echo e($navBtnUrl); ?>" class="d-flex d-lg-none text-primary nav-start-a-live-btn font-14">
                        <?php echo e($navBtnText); ?>

                    </a>
                <?php endif; ?> -->

                <!-- <?php if(!empty($isPanel)): ?>
                    <?php if($authUser->checkAccessToAIContentFeature()): ?>
                        <div class="js-show-ai-content-drawer show-ai-content-drawer-btn d-flex-center mr-40">
                            <div class="d-flex-center size-32 rounded-circle bg-white">
                                <img src="/assets/default/img/ai/ai-chip.svg" alt="ai" class="" width="16px" height="16px">
                            </div>
                            <span class="ml-5 font-weight-500 text-secondary font-14 d-none d-lg-block"><?php echo e(trans('update.ai_content')); ?></span>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>  -->




            </div>
        </div>
    </div>
</nav>

<?php $__env->startPush('scripts_bottom'); ?>
    <!-- <script src="/assets/default/js/parts/navbar.min.js"></script> -->

<script>
    // دالة تغيير اللغة
    const setLanguage = (lang) => {
        let url = "<?php echo e(route('locale', ['FIXED_LANG'])); ?>";
        url = url.replace('FIXED_LANG', lang);
        window.open(url, "_self");
    }
</script>
<?php $__env->stopPush(); ?>


<?php /**PATH D:\project\gazacademy\resources\views/web/default/includes/navbar.blade.php ENDPATH**/ ?>