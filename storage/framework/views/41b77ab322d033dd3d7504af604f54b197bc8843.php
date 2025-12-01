
<link rel="stylesheet" href="<?php echo e(asset('css/layouts.css')); ?>">

<?php
$rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

$curr_lang = app()->getLocale();
if(Session::has('site_language')) {
$curr_lang = Session::get('site_language');
}

$isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));

?>





<div class="nav-bar" style="width: 100%;">
    <div class="container">
        <div class="row justify-content-between align-items-center" id="navrow">
            <div class="col-12">
                <div class="leftside d-flex flex-row align-items-center justify-content-start" style="justify-content: space-between !important;">
                    <!-- main logo  -->
                    <div class="main-logo">
                        <a href="/">

                            

                            <?php if(!empty($generalSettings['logo'])): ?>
                                <img src="<?php echo e($generalSettings['logo']); ?>" alt="Gaza academy CodeTech-logo" height="45"
                                width="160">
                            <?php endif; ?>

                        </a>
                    </div>
                    <!-- primary menu  -->
                    <div class="primary-menu">
                        <ul class="d-flex flex-row flex-wrap justify-content-start align-items-center">
                            <?php if(!empty($categories) and count($categories)): ?>
                                <li class="mr-lg-25">
                                    <div class="menu-category">
                                        <ul>
                                            <li class="cursor-pointer user-select-none d-flex xs-categories-toggle text-dark">
                                                <i  data-feather="grid" width="20" height="20"
                                                    class="mr-10 d-none d-lg-block"></i>
                                                <?php echo e(trans('categories.categories')); ?>


                                                <ul class="cat-dropdown-menu" style="z-index: 999 !important">
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
                                                                        <li style="z-index: 0;">
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

                                    <li >
                                        <a href="<?php echo e($navbarPage['link']); ?>" style="color: black;" id="navbarsdesktop"
                                            class="text-decoration-none  d-inline-block px-2"><?php echo e($navbarPage['title']); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <?php if(auth()->guard()->guest()): ?>
                                <li>
                                            
                                        <a href="/login" style="color: black;" class="text-decoration-none  d-inline-block px-2"><?php echo e(__('Login')); ?></a>
                                        <a href="/register" style="color: black;" class="text-decoration-none  d-inline-block px-2"><?php echo e(__('Register')); ?></a>

                                </li>
                            <?php endif; ?>

                            

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
                                    <?php echo e(app()->getLocale() === 'ar' ? 'left: 18%;' : 'right: 18%;'); ?>">

                                <ul class="languages" style="z-index: 2; position: absolute; width: 200px; background: white;">
                                    <?php if($langs): ?>
                                        <?php for($i = 0; $i < count($langs); $i++): ?>
                                            <li onclick="setLanguage('<?php echo e($langs[$i]['code']); ?>')"
                                                class="<?php echo e($langs[$i]['code'] == $curr_lang ? 'langBorder' : ''); ?>">

                                                <span class="lang-flag">
                                                    <img class="img-fluid"
                                                        src="<?php echo e(asset('language-flags/png100px/' . $langs[$i]['code'] . '.png')); ?>"
                                                        width="20px" alt="">
                                                </span>

                                                <?php echo e($langs[$i]['name']); ?>

                                            </li>
                                        <?php endfor; ?>
                                    <?php endif; ?>
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
                            <img src="<?php echo e(asset('images/logo4.png')); ?>" alt="Gaza academy codeTech-logo" />
                        </div>

                        

                    </div>

                    <div class="right-side d-flex flex-row justify-content-end align-items-center">
                        <div class="dark-toggle d-inline-block">

                        </div>



                        <!-- new beta button-->
                        <div class="right-menu d-flex">


                            
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

                        <?php
                            $direction = in_array(app()->getLocale(), ['ar', 'he', 'fa', 'ur']) ? 'rtl' : 'ltr';
                            $offcanvasDirection = $direction === 'ltr' ? 'offcanvas-start' : 'offcanvas-end';
                        ?>

                        <div class="offcanvas <?php echo e(app()->getLocale() === 'en' ? 'offcanvas-start' : 'offcanvas-end'); ?>" id="offcanvasRight">

                            <div class="offcanvas-header">
                                <button class="btn-close text-reset " data-bs-dismiss="offcanvas" aria-label="Close"></link>
                            </div>

                            <div class="offcanvas-body">
                                <ul class="menu-list px-2" style="list-style: none; padding: 0; margin: 0; direction: <?php echo e($direction); ?>;">

                                    <?php if(!empty($categories) && count($categories)): ?>
                                        <li style="margin-bottom: 10px;" class="catmob">
                                            <div onclick="toggleSubmenu('main-categories')" style="cursor: pointer; padding: 8px 0;">
                                                <?php echo e(trans('categories.categories')); ?>

                                            </div>

                                            <ul id="main-categories" style="display: none; padding-<?php echo e($direction == 'rtl' ? 'right' : 'left'); ?>: 15px; margin-top: 5px;">
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li style="margin-bottom: 8px;">
                                                        <div onclick="toggleSubmenu('subcategory-<?php echo e($index); ?>', 'arrow-<?php echo e($index); ?>')" style="cursor: pointer; display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
                                                            <div style="display: flex; align-items: center;">
                                                                <?php if(!empty($category->icon)): ?>
                                                                    <img src="<?php echo e($category->icon); ?>" alt="<?php echo e($category->title); ?>" style="width: 20px; height: 20px; margin-<?php echo e($direction == 'rtl' ? 'left' : 'right'); ?>: 10px;">
                                                                <?php endif; ?>
                                                                <span><?php echo e($category->title); ?></span>
                                                            </div>

                                                            <?php if(!empty($category->subCategories)): ?>
                                                                <svg id="arrow-<?php echo e($index); ?>" class="arrow-icon" width="18" height="18" viewBox="0 0 24 24" style="transition: transform 0.3s;">
                                                                    <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            <?php endif; ?>
                                                        </div>

                                                        <?php if(!empty($category->subCategories)): ?>
                                                            <ul id="subcategory-<?php echo e($index); ?>" style="display: none; padding-<?php echo e($direction == 'rtl' ? 'right' : 'left'); ?>: 15px; margin-top: 5px; background: #f9f9f9; border-radius: 5px;">
                                                                <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li style="padding: 5px 0;">
                                                                        <a href="<?php echo e($subCategory->getUrl()); ?>" style="text-decoration: none; color: #333; display: flex; align-items: center;" class="subs">
                                                                            <?php if(!empty($subCategory->icon)): ?>
                                                                                <img src="<?php echo e($subCategory->icon); ?>" alt="<?php echo e($subCategory->title); ?>" style="width: 16px; height: 16px; margin-<?php echo e($direction == 'rtl' ? 'left' : 'right'); ?>: 8px;">
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
                                    <?php endif; ?>

                                    <?php $__currentLoopData = $navbarPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navbarPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="navmob" style="margin-bottom: 10px;">
                                            <a href="<?php echo e($navbarPage['link']); ?>" style="text-decoration: none; color: black;">
                                                <?php echo e($navbarPage['title']); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
        
</div>

<?php $__env->startPush('scripts_bottom'); ?>
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
            let url = "<?php echo e(route('locale', ['FIXED_LANG'])); ?>";
            url = url.replace('FIXED_LANG', lang);
            window.open(url, "_self");
        }

    </script>

<?php $__env->stopPush(); ?>
<?php /**PATH D:\project\gazacademy\resources\views/components/web/nav-bar.blade.php ENDPATH**/ ?>