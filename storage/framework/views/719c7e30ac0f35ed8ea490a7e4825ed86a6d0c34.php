<?php
    $route = $site;
?>

<link rel="stylesheet" href="<?php echo e(asset('css/layouts.css')); ?>">
<div class="system-modal-left" id="system-modal-left">
    <span class="close-modal-left" id="close-modal-left"><i class="fas fa-times" ></i></span>
    <div class="side-bar">
        <div id="q-app">
            <div class="q-layout q-layout--standard" tabindex="-1" style="min-height: 670px;">
                <aside
                    class="q-drawer q-drawer--left q-drawer--bordered fixed q-drawer--on-top q-drawer--mobile q-drawer--top-padding"
                    style="width: 300px; transform: translateX(0px);">
                    <div class="q-drawer__content fit scroll">
                        <?php if(auth()->guard()->check()): ?>
                        <div class="bg-[#B92025] p-2" style="padding-top: 50px !important">
                                                                    <div class="relative">
                                        <div class="container mb-1 p-1 d-flex justify-content-center" style="display: flex !important;
                                            align-items: center;
                                            flex-direction: column;">
                                                                                            <img src="https://kemecademy.com/images/avatar.png" height="80px" width="80px" alt="" style="border-radius: 50%;">
                                                                                        <span class="fw-bold" style="font-size: 18px;"><?php echo e(Auth::user()->full_name); ?></span>


                                            <a href="https://kemecademy.com/logout" class="btn btn-sm btn-warning fw-bold" style="background-color: #ffc50b !important"><?php echo e(__('admin/main.logout')); ?></a>
                                        </div>
                                    </div>

                            </div>

                        <!-- <div>
                                    <div
                                        class="dropdown-user-avatar d-flex align-items-center p-15 m-15 mb-10 rounded-sm border">
                                        <div class="size-40 rounded-circle position-relative">
                                            <img src="/getDefaultAvatar?item=1067&amp;name=1926 Real&amp;size=40"
                                                class="img-cover rounded-circle" alt="1926 Real">
                                        </div>

                                        <div class="ml-5">
                                            <div class="font-14 font-weight-bold text-secondary"><?php echo e(Auth::user()->full_name); ?>

                                            </div>
                                            <span class="mmt-5 text-gray font-12"><?php echo e(Auth::user()->role_name); ?></span>
                                        </div>
                                    </div> -->
                                    <!-- <div class="bg-[#B92025] p-2" style="height: 100px;"> -->

                                    <!-- <div class="relative">
                                                <div class="container mb-1 p-1 d-flex justify-content-center"
                                                    style="display: flex !important;
                                                    align-items: center;
                                                    flex-direction: column;">
                                                    <img src="<?php echo e(asset('images/avatar.png')); ?>" height="80px" width="80px"
                                                        alt="" style="border-radius: 50%;">
                                                    <span class="fw-bold"><?php echo e(Auth::user()->full_name); ?></span>
                                                    <span class="fw-bold"><?php echo e(Auth::user()->role_name); ?></span>
                                                </div>
                                            </div> -->

                                <!-- </div> -->
                            <?php endif; ?>
                             <?php if(auth()->guard()->guest()): ?>

                        <div class=" p-2 mobileSystem" style="padding-top: 40px !important; height:100vh ;background-color: #B92025;width:100%">
                            <div class="q-gutter mt-3 row flex-column" style="--bs-gutter-x: -0.5rem; margin-top : 8px">
                                <a class="w-100 q-btn q-btn-item non-selectable no-outline q-btn--standard q-btn--rectangle bg-black text-white q-btn--actionable q-focusable q-hoverable col"
                                    tabindex="0"
                                    href="<?php echo e(returnSSOLinkWithLang('re')); ?>"
                                    style="font-size: 14px;">
                                    <span class="q-focus-helper"></span>
                                    <span
                                        class="q-btn__content text-center col items-center q-anchor--skip justify-center row">
                                        <span style="margin-left:8px">SIGN_UP</span>
                                    </span>
                                </a>
                                <br>
                                <a class="w-100 ms-0 q-btn q-btn-item non-selectable no-outline q-btn--standard q-btn--rectangle q-btn--actionable q-focusable q-hoverable col text-black bg-[#FFC50B]"
                                    tabindex="0"
                                    href="<?php echo e(returnSSOLinkWithLang('login')); ?>"
                                    style="font-size: 14px; margin-left: 8px; background-color:#FFC50B;">
                                    <span class="q-focus-helper"></span>
                                    <span
                                        class="q-btn__content text-center col items-center q-anchor--skip justify-center row">
                                        <span style="margin-left:8px" style="color:black">Login</span>
                                    </span>
                                </a>
                            </div>

                            <div class="dropdown">

                                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                                    <?php for($i = 0; $i < count($dropdownsidebar); $i++): ?>
                                        <li class="dpdw-link">
                                            <a class="dropdown-item <?php echo e($dropdownsidebar[$i]['label'] == $route ? 'active' : ''); ?>"
                                                href="<?php echo e($dropdownsidebar[$i]['link']); ?>">
                                                <?php echo e($dropdownsidebar[$i]['label']); ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>

                    <div class="relative">
                        <?php if(isset($sidebar)): ?>
                            <?php
                                $sidebar = collect($sidebar)->sortByDesc(function ($item) {
                                    return $item['id'] === 5740 ? 1 : 0;
                                })->values()->toArray();

                            ?>

                            <?php for($i = 0; $i < count($sidebar); $i++): ?>
                                

                                <div class="q-expansion-item q-item-type q-expansion-item--standard text-black" color="accent">
                                    <div class="q-expansion-item__container relative-position">

                                        <?php if(!empty($sidebar[$i]['child'])): ?>
                                            <div class="collapse relative-position <?php echo e($i == 0 ? 'show' : ''); ?>"
                                                style="margin-left: 10px" id="home-collapse-<?php echo e($sidebar[$i]['id']); ?>">

                                                <?php for($j = 0; $j < count($sidebar[$i]['child']); $j++): ?>
                                                  <?php if(auth()->guard()->check()): ?>
                                                                                                            <?php if($sidebar[$i]['id'] === 5740): ?>
                                                                                                                            <!-- d-flex align-items-center collapsed       close-->
                                                                                                                            <!-- d-flex align-items-center       open-->
                                                                                                                            <ul id="panel-sidebar-scroll" style="padding: 0 !important;"
                                                                                                                                class="sidebar-menu pt-10 <?php if(!empty($authUser->userGroup)): ?> has-user-group <?php endif; ?> <?php if(empty($getPanelSidebarSettings) or empty($getPanelSidebarSettings['background'])): ?> without-bottom-image <?php endif; ?>"
                                                                                                                                <?php if((!empty($isRtl) and $isRtl)): ?> data-simplebar-direction="rtl" <?php endif; ?>>

                                                                                                                                <li
                                                                                                                                    class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                    <a href="/panel" class="d-flex align-items-center">
                                                                                                                                        <span class="sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                            <?php echo $__env->make('web.default.panel.includes.sidebar_icons.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                        </span>
                                                                                                                                        <span><?php echo e(trans('panel.dashboard')); ?></span>
                                                                                                                                    </a>
                                                                                                                                </li>

                                                                                                                                <?php if($authUser->isOrganization()): ?>
                                                                                                                                    <li
                                                                                                                                        class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/instructors') or request()->is('panel/manage/instructors*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                        <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                            href="#instructorsCollapse" role="button" aria-expanded="false"
                                                                                                                                            aria-controls="instructorsCollapse">
                                                                                                                                            <span class="sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.teachers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                            </span>
                                                                                                                                            <span><?php echo e(trans('public.instructors')); ?></span>
                                                                                                                                        </a>

                                                                                                                                        <div class="collapse <?php echo e((request()->is('panel/instructors') or request()->is('panel/manage/instructors*')) ? 'show' : ''); ?>"
                                                                                                                                            id="instructorsCollapse">
                                                                                                                                            <ul class="sidenav-item-collapse">
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/instructors/new')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/manage/instructors/new"><?php echo e(trans('public.new')); ?></a>
                                                                                                                                                </li>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/manage/instructors')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/manage/instructors"><?php echo e(trans('public.list')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            </ul>
                                                                                                                                        </div>
                                                                                                                                    </li>

                                                                                                                                    <li
                                                                                                                                        class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/students') or request()->is('panel/manage/students*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                        <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                            href="#studentsCollapse" role="button" aria-expanded="false"
                                                                                                                                            aria-controls="studentsCollapse">
                                                                                                                                            <span class="sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.students', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                            </span>
                                                                                                                                            <span><?php echo e(trans('quiz.students')); ?></span>
                                                                                                                                        </a>

                                                                                                                                        <div class="collapse <?php echo e((request()->is('panel/students') or request()->is('panel/manage/students*')) ? 'show' : ''); ?>"
                                                                                                                                            id="studentsCollapse">
                                                                                                                                            <ul class="sidenav-item-collapse">
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/manage/students/new')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/manage/students/new"><?php echo e(trans('public.new')); ?></a>
                                                                                                                                                </li>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/manage/students')) ? 'active' : ''); ?>">
                                                                                                                                                    <a href="/panel/manage/students"><?php echo e(trans('public.list')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            </ul>
                                                                                                                                        </div>
                                                                                                                                    </li>
                                                                                                                                <?php endif; ?>
                                                                                                                                <!-- -->
                                                                                                                                <li
                                                                                                                                    class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/webinars') or request()->is('panel/webinars/*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                    <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                        href="#webinarCollapse" role="button" aria-expanded="false"
                                                                                                                                        aria-controls="webinarCollapse">
                                                                                                                                        <span class="sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                            <?php echo $__env->make('web.default.panel.includes.sidebar_icons.webinars', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                        </span>
                                                                                                                                        <span><?php echo e(trans('panel.webinars')); ?></span>
                                                                                                                                        <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                    </a>

                                                                                                                                    <div class="collapse <?php echo e((request()->is('panel/webinars') or request()->is('panel/webinars/*')) ? 'show' : ''); ?>"
                                                                                                                                        id="webinarCollapse">
                                                                                                                                        <ul class="sidenav-item-collapse">
                                                                                                                                            <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/webinars/new')) ? 'active' : ''); ?>">
                                                                                                                                                    <a href="/panel/webinars/new"><?php echo e(trans('public.new')); ?></a>
                                                                                                                                                </li>

                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/webinars')) ? 'active' : ''); ?>">
                                                                                                                                                    <a href="/panel/webinars"><?php echo e(trans('panel.my_classes')); ?></a>
                                                                                                                                                </li>

                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/webinars/invitations')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/webinars/invitations"><?php echo e(trans('panel.invited_classes')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            <?php endif; ?>

                                                                                                                                            <?php if(!empty($authUser->organ_id)): ?>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/webinars/organization_classes')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/webinars/organization_classes"><?php echo e(trans('panel.organization_classes')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            <?php endif; ?>

                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/webinars/purchases')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/webinars/purchases"><?php echo e(trans('panel.my_purchases')); ?></a>
                                                                                                                                            </li>

                                                                                                                                            <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/webinars/comments')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/webinars/comments"><?php echo e(trans('panel.my_class_comments')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            <?php endif; ?>

                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/webinars/my-comments')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/webinars/my-comments"><?php echo e(trans('panel.my_comments')); ?></a>
                                                                                                                                            </li>

                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/webinars/favorites')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/webinars/favorites"><?php echo e(trans('panel.favorites')); ?></a>
                                                                                                                                            </li>
                                                                                                                                        </ul>
                                                                                                                                    </div>
                                                                                                                                </li>

                                                                                                                                <?php if(!empty(getFeaturesSettings('upcoming_courses_status'))): ?>
                                                                                                                                    <li
                                                                                                                                        class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/upcoming_courses') or request()->is('panel/upcoming_courses/*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                        <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                            href="#upcomingCoursesCollapse" role="button" aria-expanded="false"
                                                                                                                                            aria-controls="upcomingCoursesCollapse">
                                                                                                                                            <span class="sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                                <i data-feather="film"></i>
                                                                                                                                            </span>
                                                                                                                                            <span><?php echo e(trans('update.upcoming_courses')); ?></span>
                                                                                                                                            <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                        </a>

                                                                                                                                        <div class="collapse <?php echo e((request()->is('panel/upcoming_courses') or request()->is('panel/upcoming_courses/*')) ? 'show' : ''); ?>"
                                                                                                                                            id="upcomingCoursesCollapse">
                                                                                                                                            <ul class="sidenav-item-collapse">
                                                                                                                                                <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                                                                                                                                                    <li
                                                                                                                                                        class="mmt-5 <?php echo e((request()->is('panel/upcoming_courses/new')) ? 'active' : ''); ?>">
                                                                                                                                                        <a
                                                                                                                                                            href="/panel/upcoming_courses/new"><?php echo e(trans('public.new')); ?></a>
                                                                                                                                                    </li>

                                                                                                                                                    <li
                                                                                                                                                        class="mmt-5 <?php echo e((request()->is('panel/upcoming_courses')) ? 'active' : ''); ?>">
                                                                                                                                                        <a
                                                                                                                                                            href="/panel/upcoming_courses"><?php echo e(trans('update.my_upcoming_courses')); ?></a>
                                                                                                                                                    </li>
                                                                                                                                                <?php endif; ?>

                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/upcoming_courses/followings')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/upcoming_courses/followings"><?php echo e(trans('update.following_courses')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            </ul>
                                                                                                                                        </div>
                                                                                                                                    </li>
                                                                                                                                <?php endif; ?>

                                                                                                                                <?php if($authUser->isOrganization() or $authUser->isTeacher()): ?>
                                                                                                                                    <li
                                                                                                                                        class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/bundles') or request()->is('panel/bundles/*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                        <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                            href="#bundlesCollapse" role="button" aria-expanded="false"
                                                                                                                                            aria-controls="bundlesCollapse">
                                                                                                                                            <span class="sidenav-item-icon assign-fill mr-10" id = "mainicons">
                                                                                                                                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.bundles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                            </span>
                                                                                                                                            <span><?php echo e(trans('update.bundles')); ?></span>
                                                                                                                                            <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                        </a>

                                                                                                                                        <div class="collapse <?php echo e((request()->is('panel/bundles') or request()->is('panel/bundles/*')) ? 'show' : ''); ?>"
                                                                                                                                            id="bundlesCollapse">
                                                                                                                                            <ul class="sidenav-item-collapse">
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/bundles/new')) ? 'active' : ''); ?>">
                                                                                                                                                    <a href="/panel/bundles/new"><?php echo e(trans('public.new')); ?></a>
                                                                                                                                                </li>

                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/bundles')) ? 'active' : ''); ?>">
                                                                                                                                                    <a href="/panel/bundles"><?php echo e(trans('update.my_bundles')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            </ul>
                                                                                                                                        </div>
                                                                                                                                    </li>
                                                                                                                                <?php endif; ?>

                                                                                                                                <?php if(getFeaturesSettings('webinar_assignment_status')): ?>
                                                                                                                                    <li
                                                                                                                                        class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/assignments') or request()->is('panel/assignments/*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                        <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                            href="#assignmentCollapse" role="button" aria-expanded="false"
                                                                                                                                            aria-controls="assignmentCollapse">
                                                                                                                                            <span class="sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.assignments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                            </span>
                                                                                                                                            <span><?php echo e(trans('update.assignments')); ?></span>
                                                                                                                                            <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                        </a>

                                                                                                                                        <div class="collapse <?php echo e((request()->is('panel/assignments') or request()->is('panel/assignments/*')) ? 'show' : ''); ?>"
                                                                                                                                            id="assignmentCollapse">
                                                                                                                                            <ul class="sidenav-item-collapse">

                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/assignments/my-assignments')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/assignments/my-assignments"><?php echo e(trans('update.my_assignments')); ?></a>
                                                                                                                                                </li>

                                                                                                                                                <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                                                                                                                                                    <li
                                                                                                                                                        class="mmt-5 <?php echo e((request()->is('panel/assignments/my-courses-assignments')) ? 'active' : ''); ?>">
                                                                                                                                                        <a
                                                                                                                                                            href="/panel/assignments/my-courses-assignments"><?php echo e(trans('update.students_assignments')); ?></a>
                                                                                                                                                    </li>
                                                                                                                                                <?php endif; ?>
                                                                                                                                            </ul>
                                                                                                                                        </div>
                                                                                                                                    </li>
                                                                                                                                <?php endif; ?>


                                                                                                                                <li
                                                                                                                                    class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/meetings') or request()->is('panel/meetings/*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                    <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                        href="#meetingCollapse" role="button" aria-expanded="false"
                                                                                                                                        aria-controls="meetingCollapse">
                                                                                                                                        <span class="sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                            <?php echo $__env->make('web.default.panel.includes.sidebar_icons.requests', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                        </span>
                                                                                                                                        <span><?php echo e(trans('panel.meetings')); ?></span>
                                                                                                                                        <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                    </a>

                                                                                                                                    <div class="collapse <?php echo e((request()->is('panel/meetings') or request()->is('panel/meetings/*')) ? 'show' : ''); ?>"
                                                                                                                                        id="meetingCollapse">
                                                                                                                                        <ul class="sidenav-item-collapse">

                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/meetings/reservation')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/meetings/reservation"><?php echo e(trans('public.my_reservation')); ?></a>
                                                                                                                                            </li>

                                                                                                                                            <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/meetings/requests')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/meetings/requests"><?php echo e(trans('panel.requests')); ?></a>
                                                                                                                                                </li>

                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/meetings/settings')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/meetings/settings"><?php echo e(trans('panel.settings')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            <?php endif; ?>
                                                                                                                                        </ul>
                                                                                                                                    </div>
                                                                                                                                </li>

                                                                                                                                <li
                                                                                                                                    class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/quizzes') or request()->is('panel/quizzes/*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                    <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                        href="#quizzesCollapse" role="button" aria-expanded="false"
                                                                                                                                        aria-controls="quizzesCollapse">
                                                                                                                                        <span class="sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                            <?php echo $__env->make('web.default.panel.includes.sidebar_icons.quizzes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                        </span>
                                                                                                                                        <span><?php echo e(trans('panel.quizzes')); ?></span>
                                                                                                                                        <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                    </a>

                                                                                                                                    <div class="collapse <?php echo e((request()->is('panel/quizzes') or request()->is('panel/quizzes/*')) ? 'show' : ''); ?>"
                                                                                                                                        id="quizzesCollapse">
                                                                                                                                        <ul class="sidenav-item-collapse">
                                                                                                                                            <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/quizzes/new')) ? 'active' : ''); ?>">
                                                                                                                                                    <a href="/panel/quizzes/new"><?php echo e(trans('quiz.new_quiz')); ?></a>
                                                                                                                                                </li>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/quizzes')) ? 'active' : ''); ?>">
                                                                                                                                                    <a href="/panel/quizzes"><?php echo e(trans('public.list')); ?></a>
                                                                                                                                                </li>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/quizzes/results')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/quizzes/results"><?php echo e(trans('public.results')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            <?php endif; ?>

                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/quizzes/my-results')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/quizzes/my-results"><?php echo e(trans('public.my_results')); ?></a>
                                                                                                                                            </li>

                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/quizzes/opens')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/quizzes/opens"><?php echo e(trans('public.not_participated')); ?></a>
                                                                                                                                            </li>
                                                                                                                                        </ul>
                                                                                                                                    </div>
                                                                                                                                </li>

                                                                                                                                <li
                                                                                                                                    class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/certificates') or request()->is('panel/certificates/*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                    <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                        href="#certificatesCollapse" role="button" aria-expanded="false"
                                                                                                                                        aria-controls="certificatesCollapse">
                                                                                                                                        <span class="sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                            <?php echo $__env->make('web.default.panel.includes.sidebar_icons.certificate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                        </span>
                                                                                                                                        <span><?php echo e(trans('panel.certificates')); ?></span>
                                                                                                                                        <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                    </a>

                                                                                                                                    <div class="collapse <?php echo e((request()->is('panel/certificates') or request()->is('panel/certificates/*')) ? 'show' : ''); ?>"
                                                                                                                                        id="certificatesCollapse">
                                                                                                                                        <ul class="sidenav-item-collapse">
                                                                                                                                            <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/certificates')) ? 'active' : ''); ?>">
                                                                                                                                                    <a href="/panel/certificates"><?php echo e(trans('public.list')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            <?php endif; ?>

                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/certificates/achievements')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/certificates/achievements"><?php echo e(trans('quiz.achievements')); ?></a>
                                                                                                                                            </li>

                                                                                                                                            <li class="mmt-5">
                                                                                                                                                <a
                                                                                                                                                    href="/certificate_validation"><?php echo e(trans('site.certificate_validation')); ?></a>
                                                                                                                                            </li>

                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/certificates/webinars')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/certificates/webinars"><?php echo e(trans('update.course_certificates')); ?></a>
                                                                                                                                            </li>

                                                                                                                                        </ul>
                                                                                                                                    </div>
                                                                                                                                </li>

                                                                                                                                <?php if($authUser->checkCanAccessToStore()): ?>
                                                                                                                                            <li
                                                                                                                                                class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/store') or request()->is('panel/store/*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                                <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                                    href="#storeCollapse" role="button" aria-expanded="false"
                                                                                                                                                    aria-controls="storeCollapse">
                                                                                                                                                    <span class="sidenav-item-icon assign-fill mr-10" id = "mainicons">
                                                                                                                                                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.store', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                                    </span>
                                                                                                                                                    <span><?php echo e(trans('update.store')); ?></span>
                                                                                                                                                    <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                                </a>

                                                                                                                                                <div class="collapse <?php echo e((request()->is('panel/store') or request()->is('panel/store/*')) ? 'show' : ''); ?>"
                                                                                                                                                    id="storeCollapse">
                                                                                                                                                    <ul class="sidenav-item-collapse">
                                                                                                                                                        <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                                                                                                                                                                                <li
                                                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/store/products/new')) ? 'active' : ''); ?>">
                                                                                                                                                                                    <a
                                                                                                                                                                                        href="/panel/store/products/new"><?php echo e(trans('update.new_product')); ?></a>
                                                                                                                                                                                </li>

                                                                                                                                                                                <li
                                                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/store/products')) ? 'active' : ''); ?>">
                                                                                                                                                                                    <a
                                                                                                                                                                                        href="/panel/store/products"><?php echo e(trans('update.products')); ?></a>
                                                                                                                                                                                </li>

                                                                                                                                                                                <?php
                                                                                                                                                                                    $sellerProductOrderWaitingDeliveryCount = $authUser->getWaitingDeliveryProductOrdersCount();
                                                                                                                                                                                ?>

                                                                                                                                                                                <li
                                                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/store/sales')) ? 'active' : ''); ?>">
                                                                                                                                                                                    <a href="/panel/store/sales"><?php echo e(trans('panel.sales')); ?></a>

                                                                                                                                                                                    <?php if($sellerProductOrderWaitingDeliveryCount > 0): ?>
                                                                                                                                                                                        <span
                                                                                                                                                                                            class="d-inline-flex align-items-center justify-content-center font-weight-500 ml-15 panel-sidebar-store-sales-circle-badge"><?php echo e($sellerProductOrderWaitingDeliveryCount); ?></span>
                                                                                                                                                                                    <?php endif; ?>
                                                                                                                                                                                </li>

                                                                                                                                                        <?php endif; ?>

                                                                                                                                                        <li
                                                                                                                                                            class="mmt-5 <?php echo e((request()->is('panel/store/purchases')) ? 'active' : ''); ?>">
                                                                                                                                                            <a
                                                                                                                                                                href="/panel/store/purchases"><?php echo e(trans('panel.my_purchases')); ?></a>
                                                                                                                                                        </li>

                                                                                                                                                        <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                                                                                                                                                            <li
                                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/store/products/comments')) ? 'active' : ''); ?>">
                                                                                                                                                                <a
                                                                                                                                                                    href="/panel/store/products/comments"><?php echo e(trans('update.product_comments')); ?></a>
                                                                                                                                                            </li>
                                                                                                                                                        <?php endif; ?>

                                                                                                                                                        <li
                                                                                                                                                            class="mmt-5 <?php echo e((request()->is('panel/store/products/my-comments')) ? 'active' : ''); ?>">
                                                                                                                                                            <a
                                                                                                                                                                href="/panel/store/products/my-comments"><?php echo e(trans('panel.my_comments')); ?></a>
                                                                                                                                                        </li>
                                                                                                                                                    </ul>
                                                                                                                                                </div>
                                                                                                                                            </li>
                                                                                                                                <?php endif; ?>

                                                                                                                                <li
                                                                                                                                    class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/financial') or request()->is('panel/financial/*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                    <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                        href="#financialCollapse" role="button" aria-expanded="false"
                                                                                                                                        aria-controls="financialCollapse">
                                                                                                                                        <span class="sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                            <?php echo $__env->make('web.default.panel.includes.sidebar_icons.financial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                        </span>
                                                                                                                                        <span><?php echo e(trans('panel.financial')); ?></span>
                                                                                                                                        <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                    </a>

                                                                                                                                    <div class="collapse <?php echo e((request()->is('panel/financial') or request()->is('panel/financial/*')) ? 'show' : ''); ?>"
                                                                                                                                        id="financialCollapse">
                                                                                                                                        <ul class="sidenav-item-collapse">

                                                                                                                                            <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/financial/sales')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/financial/sales"><?php echo e(trans('financial.sales_report')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            <?php endif; ?>

                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/financial/summary')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/financial/summary"><?php echo e(trans('financial.financial_summary')); ?></a>
                                                                                                                                            </li>

                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/financial/payout')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/financial/payout"><?php echo e(trans('financial.payout')); ?></a>
                                                                                                                                            </li>

                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/financial/account')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/financial/account"><?php echo e(trans('financial.charge_account')); ?></a>
                                                                                                                                            </li>

                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/financial/subscribes')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/financial/subscribes"><?php echo e(trans('financial.subscribes')); ?></a>
                                                                                                                                            </li>

                                                                                                                                            <?php if(($authUser->isOrganization() || $authUser->isTeacher()) and getRegistrationPackagesGeneralSettings('status')): ?>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/financial/registration-packages')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="<?php echo e(route('panelRegistrationPackagesLists')); ?>"><?php echo e(trans('update.registration_packages')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            <?php endif; ?>

                                                                                                                                            <?php if(getInstallmentsSettings('status')): ?>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/financial/installments*')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/financial/installments"><?php echo e(trans('update.installments')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            <?php endif; ?>
                                                                                                                                        </ul>
                                                                                                                                    </div>
                                                                                                                                </li>

                                                                                                                                <li
                                                                                                                                    class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/support') or request()->is('panel/support/*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                    <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                        href="#supportCollapse" role="button" aria-expanded="false"
                                                                                                                                        aria-controls="supportCollapse">
                                                                                                                                        <span class="sidenav-item-icon assign-fill mr-10" id = "mainicons">
                                                                                                                                            <?php echo $__env->make('web.default.panel.includes.sidebar_icons.support', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                        </span>
                                                                                                                                        <span><?php echo e(trans('panel.support')); ?></span>
                                                                                                                                        <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                    </a>

                                                                                                                                    <div class="collapse <?php echo e((request()->is('panel/support') or request()->is('panel/support/*')) ? 'show' : ''); ?>"
                                                                                                                                        id="supportCollapse">
                                                                                                                                        <ul class="sidenav-item-collapse">
                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/support/new')) ? 'active' : ''); ?>">
                                                                                                                                                <a href="/panel/support/new"><?php echo e(trans('public.new')); ?></a>
                                                                                                                                            </li>
                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/support')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/support"><?php echo e(trans('panel.classes_support')); ?></a>
                                                                                                                                            </li>
                                                                                                                                            <li
                                                                                                                                                class="mmt-5 <?php echo e((request()->is('panel/support/tickets')) ? 'active' : ''); ?>">
                                                                                                                                                <a
                                                                                                                                                    href="/panel/support/tickets"><?php echo e(trans('panel.support_tickets')); ?></a>
                                                                                                                                            </li>
                                                                                                                                        </ul>
                                                                                                                                    </div>
                                                                                                                                </li>

                                                                                                                                <?php if(!$authUser->isUser() or (!empty($referralSettings) and $referralSettings['status'] and $authUser->affiliate) or (!empty(getRegistrationBonusSettings('status')) and $authUser->enable_registration_bonus)): ?>
                                                                                                                                    <li
                                                                                                                                        class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/marketing') or request()->is('panel/marketing/*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                        <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                            href="#marketingCollapse" role="button" aria-expanded="false"
                                                                                                                                            aria-controls="marketingCollapse">
                                                                                                                                            <span class="sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                            </span>
                                                                                                                                            <span><?php echo e(trans('panel.marketing')); ?></span>
                                                                                                                                            <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                        </a>

                                                                                                                                        <div class="collapse <?php echo e((request()->is('panel/marketing') or request()->is('panel/marketing/*')) ? 'show' : ''); ?>"
                                                                                                                                            id="marketingCollapse">
                                                                                                                                            <ul class="sidenav-item-collapse">
                                                                                                                                                <?php if(!$authUser->isUser()): ?>
                                                                                                                                                    <li
                                                                                                                                                        class="mmt-5 <?php echo e((request()->is('panel/marketing/special_offers')) ? 'active' : ''); ?>">
                                                                                                                                                        <a
                                                                                                                                                            href="/panel/marketing/special_offers"><?php echo e(trans('panel.discounts')); ?></a>
                                                                                                                                                    </li>
                                                                                                                                                    <li
                                                                                                                                                        class="mmt-5 <?php echo e((request()->is('panel/marketing/promotions')) ? 'active' : ''); ?>">
                                                                                                                                                        <a
                                                                                                                                                            href="/panel/marketing/promotions"><?php echo e(trans('panel.promotions')); ?></a>
                                                                                                                                                    </li>
                                                                                                                                                <?php endif; ?>

                                                                                                                                                <?php if(!empty($referralSettings) and $referralSettings['status'] and $authUser->affiliate): ?>
                                                                                                                                                    <li
                                                                                                                                                        class="mmt-5 <?php echo e((request()->is('panel/marketing/affiliates')) ? 'active' : ''); ?>">
                                                                                                                                                        <a
                                                                                                                                                            href="/panel/marketing/affiliates"><?php echo e(trans('panel.affiliates')); ?></a>
                                                                                                                                                    </li>
                                                                                                                                                <?php endif; ?>

                                                                                                                                                <?php if(!empty(getRegistrationBonusSettings('status')) and $authUser->enable_registration_bonus): ?>
                                                                                                                                                    <li
                                                                                                                                                        class="mmt-5 <?php echo e((request()->is('panel/marketing/registration_bonus')) ? 'active' : ''); ?>">
                                                                                                                                                        <a
                                                                                                                                                            href="/panel/marketing/registration_bonus"><?php echo e(trans('update.registration_bonus')); ?></a>
                                                                                                                                                    </li>
                                                                                                                                                <?php endif; ?>
                                                                                                                                            </ul>
                                                                                                                                        </div>
                                                                                                                                    </li>
                                                                                                                                <?php endif; ?>

                                                                                                                                <?php if(getFeaturesSettings('forums_status')): ?>
                                                                                                                                    <li
                                                                                                                                        class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/forums') or request()->is('panel/forums/*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                        <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                            href="#forumsCollapse" role="button" aria-expanded="false"
                                                                                                                                            aria-controls="forumsCollapse">
                                                                                                                                            <span class="sidenav-item-icon assign-fill mr-10" id = "mainicons">
                                                                                                                                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.forums', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                            </span>
                                                                                                                                            <span><?php echo e(trans('update.forums')); ?></span>
                                                                                                                                            <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                        </a>

                                                                                                                                        <div class="collapse <?php echo e((request()->is('panel/forums') or request()->is('panel/forums/*')) ? 'show' : ''); ?>"
                                                                                                                                            id="forumsCollapse">
                                                                                                                                            <ul class="sidenav-item-collapse">
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('/forums/create-topic')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/forums/create-topic"><?php echo e(trans('update.new_topic')); ?></a>
                                                                                                                                                </li>
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/forums/topics')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/forums/topics"><?php echo e(trans('update.my_topics')); ?></a>
                                                                                                                                                </li>

                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/forums/posts')) ? 'active' : ''); ?>">
                                                                                                                                                    <a href="/panel/forums/posts"><?php echo e(trans('update.my_posts')); ?></a>
                                                                                                                                                </li>

                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/forums/bookmarks')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/forums/bookmarks"><?php echo e(trans('update.bookmarks')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            </ul>
                                                                                                                                        </div>
                                                                                                                                    </li>
                                                                                                                                <?php endif; ?>


                                                                                                                                <?php if($authUser->isTeacher()): ?>
                                                                                                                                    <li
                                                                                                                                        class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/blog') or request()->is('panel/blog/*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                        <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                            href="#blogCollapse" role="button" aria-expanded="false"
                                                                                                                                            aria-controls="blogCollapse">
                                                                                                                                            <span class="sidenav-item-icon assign-fill mr-10" id = "mainicons">
                                                                                                                                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                            </span>
                                                                                                                                            <span><?php echo e(trans('update.articles')); ?></span>
                                                                                                                                            <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                        </a>

                                                                                                                                        <div class="collapse <?php echo e((request()->is('panel/blog') or request()->is('panel/blog/*')) ? 'show' : ''); ?>"
                                                                                                                                            id="blogCollapse">
                                                                                                                                            <ul class="sidenav-item-collapse">
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/blog/posts/new')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/blog/posts/new"><?php echo e(trans('update.new_article')); ?></a>
                                                                                                                                                </li>

                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/blog/posts')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/blog/posts"><?php echo e(trans('update.my_articles')); ?></a>
                                                                                                                                                </li>

                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/blog/comments')) ? 'active' : ''); ?>">
                                                                                                                                                    <a href="/panel/blog/comments"><?php echo e(trans('panel.comments')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            </ul>
                                                                                                                                        </div>
                                                                                                                                    </li>
                                                                                                                                <?php endif; ?>

                                                                                                                                <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                                                                                                                                    <li
                                                                                                                                        class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/noticeboard*') or request()->is('panel/course-noticeboard*')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                        <a class="d-flex align-items-center" data-toggle="collapse"
                                                                                                                                            href="#noticeboardCollapse" role="button" aria-expanded="false"
                                                                                                                                            aria-controls="noticeboardCollapse">
                                                                                                                                            <span class="sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.noticeboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                            </span>

                                                                                                                                            <span><?php echo e(trans('panel.noticeboard')); ?></span>
                                                                                                                                            <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                        </a>

                                                                                                                                        <div class="collapse <?php echo e((request()->is('panel/noticeboard*') or request()->is('panel/course-noticeboard*')) ? 'show' : ''); ?>"
                                                                                                                                            id="noticeboardCollapse">
                                                                                                                                            <ul class="sidenav-item-collapse">
                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/noticeboard')) ? 'active' : ''); ?>">
                                                                                                                                                    <a href="/panel/noticeboard"><?php echo e(trans('public.history')); ?></a>
                                                                                                                                                </li>

                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/noticeboard/new')) ? 'active' : ''); ?>">
                                                                                                                                                    <a href="/panel/noticeboard/new"><?php echo e(trans('public.new')); ?></a>
                                                                                                                                                </li>

                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/course-noticeboard')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/course-noticeboard"><?php echo e(trans('update.course_notices')); ?></a>
                                                                                                                                                </li>

                                                                                                                                                <li
                                                                                                                                                    class="mmt-5 <?php echo e((request()->is('panel/course-noticeboard/new')) ? 'active' : ''); ?>">
                                                                                                                                                    <a
                                                                                                                                                        href="/panel/course-noticeboard/new"><?php echo e(trans('update.new_course_notices')); ?></a>
                                                                                                                                                </li>
                                                                                                                                            </ul>
                                                                                                                                        </div>
                                                                                                                                    </li>
                                                                                                                                <?php endif; ?>

                                                                                                                                <?php
                                                                                                                                    $rewardSetting = getRewardsSettings();
                                                                                                                                ?>

                                                                                                                                <?php if(!empty($rewardSetting) and $rewardSetting['status'] == '1'): ?>
                                                                                                                                    <li
                                                                                                                                        class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/rewards')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                        <a href="/panel/rewards" class="d-flex align-items-center">
                                                                                                                                            <span class="sidenav-item-icon assign-strock mr-10" id = "mainicons">
                                                                                                                                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.rewards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                            </span>
                                                                                                                                            <span><?php echo e(trans('update.rewards')); ?></span>
                                                                                                                                            <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                        </a>
                                                                                                                                    </li>
                                                                                                                                <?php endif; ?>

                                                                                                                                <?php if($authUser->checkAccessToAIContentFeature()): ?>
                                                                                                                                    <li
                                                                                                                                        class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/ai-contents')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                        <a href="/panel/ai-contents" class="d-flex align-items-center">
                                                                                                                                            <span class="sidenav-item-icon assign-strock mr-10" id = "mainicons">
                                                                                                                                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.ai_contents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                            </span>
                                                                                                                                            <span><?php echo e(trans('update.ai_contents')); ?></span>
                                                                                                                                            <button class="btn btn-toggle align-items-center rounded collapsed" id="mainbtn"
                                                                                                                                            data-bs-toggle="collapse" data-bs-target="#home-collapse-child-5592"
                                                                                                                                            aria-expanded="false">
                                                                                                                                            <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                                                                                                focusable="false" data-prefix="fa" data-icon="caret-down"
                                                                                                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                                                                                <path fill="currentColor"
                                                                                                                                                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                                                                                                </path>
                                                                                                                                            </svg>
                                                                                                                                        </button>
                                                                                                                                        </a>
                                                                                                                                    </li>
                                                                                                                                <?php endif; ?>

                                                                                                                                <li
                                                                                                                                    class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/notifications')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                    <a href="/panel/notifications" class="d-flex align-items-center">
                                                                                                                                        <span class="sidenav-notification-icon sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                            <?php echo $__env->make('web.default.panel.includes.sidebar_icons.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                        </span>
                                                                                                                                        <span><?php echo e(trans('panel.notifications')); ?></span>
                                                                                                                                    </a>
                                                                                                                                </li>

                                                                                                                                <li
                                                                                                                                    class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable <?php echo e((request()->is('panel/setting')) ? 'sidenav-item-active' : ''); ?>">
                                                                                                                                    <a href="/panel/setting" class="d-flex align-items-center">
                                                                                                                                        <span class="sidenav-setting-icon sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                            <?php echo $__env->make('web.default.panel.includes.sidebar_icons.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                        </span>
                                                                                                                                        <span><?php echo e(trans('panel.settings')); ?></span>
                                                                                                                                    </a>
                                                                                                                                </li>

                                                                                                                                <?php if($authUser->isTeacher() or $authUser->isOrganization()): ?>
                                                                                                                                    <li
                                                                                                                                        class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable">
                                                                                                                                        <a href="<?php echo e($authUser->getProfileUrl()); ?>"
                                                                                                                                            class="d-flex align-items-center">
                                                                                                                                            <span class="sidenav-item-icon assign-strock mr-10" id = "mainicons">
                                                                                                                                                <i data-feather="user" stroke="#1f3b64" stroke-width="1.5"
                                                                                                                                                    width="24" height="24" class="mr-10 webinar-icon"></i>
                                                                                                                                            </span>
                                                                                                                                            <span><?php echo e(trans('public.my_profile')); ?></span>

                                                                                                                                        </a>
                                                                                                                                    </li>
                                                                                                                                <?php endif; ?>

                                                                                                                                <li
                                                                                                                                    class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable">
                                                                                                                                    <a href="/logout" class="d-flex align-items-center">
                                                                                                                                        <span class="sidenav-logout-icon sidenav-item-icon mr-10" id = "mainicons">
                                                                                                                                            <?php echo $__env->make('web.default.panel.includes.sidebar_icons.logout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                                                                                        </span>
                                                                                                                                        <span><?php echo e(trans('panel.log_out')); ?></span>
                                                                                                                                    </a>
                                                                                                                                </li>
                                                                                                                            </ul>
                                                                                                                            <?php break; ?>
                                                                                                            <?php endif; ?>
                                                                                            <?php endif; ?>
                                                    <div class="d-flex">
                                                        <a class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable"
                                                            href="<?php echo e($sidebar[$i]['child'][$j]['link']); ?>">

                                                            <div
                                                                class="q-item__section column q-item__section--side justify-center q-item__section--avatar">
                                                                <div class="q-avatar text-black q-chip--colored">
                                                                    <div class="q-avatar__content row flex-center overflow-hidden">
                                                                        <?php if($sidebar[$i]['child'][$j]['custom'] == 1): ?>
                                                                            <?php echo $sidebar[$i]['icon']; ?>

                                                                        <?php else: ?>
                                                                            <i class="q-icon <?php echo e($sidebar[$i]['child'][$j]['icon']); ?>"></i>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="q-item__section column q-item__section--main justify-center">
                                                                <Span class="sidechild"> <?php echo e($sidebar[$i]['child'][$j]['label']); ?>

                                                                </Span>
                                                            </div>
                                                        </a>
                                                        <?php if(!empty($sidebar[$i]['child'][$j]['child'])): ?>
                                                            <div
                                                                class="q-item__section column q-item__section--side justify-center q-focusable relative-position cursor-pointer">
                                                                <button class="btn btn-toggle align-items-center rounded"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#home-collapse-child-<?php echo e($sidebar[$i]['child'][$j]['id']); ?>"
                                                                    aria-expanded="false">
                                                                    <svg class="svg-inline--fa fa-caret-down fa-w-10" aria-hidden="true"
                                                                        focusable="false" data-prefix="fa" data-icon="caret-down" role="img"
                                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                                                        data-fa-i2svg="">
                                                                        <path fill="currentColor"
                                                                            d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                                                        </path>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <?php if(!empty($sidebar[$i]['child'][$j]['child'])): ?>
                                                        <div class="collapse relative-position" style="margin-left: 10px"
                                                            id="home-collapse-child-<?php echo e($sidebar[$i]['child'][$j]['id']); ?>">

                                                            <?php for($k = 0; $k < count($sidebar[$i]['child'][$j]['child']); $k++): ?>
                                                                <a class="q-item q-item-type row no-wrap q-item--clickable q-link cursor-pointer q-focusable q-hoverable"
                                                                    href="<?php echo e($sidebar[$i]['child'][$j]['child'][$k]['link']); ?>">

                                                                    <div class="q-item__section column q-item-sub-icon q-item__section--side justify-center q-item__section--avatar"
                                                                        style="">
                                                                        <div class="q-avatar text-black q-chip--colored">
                                                                            <div class="q-avatar__content row flex-center overflow-hidden">
                                                                                <?php if($sidebar[$i]['child'][$j]['child'][$k]['custom'] == 1): ?>
                                                                                    <?php echo $sidebar[$i]['child'][$j]['icon']; ?>

                                                                                <?php else: ?>
                                                                                    <i
                                                                                        class="q-icon <?php echo e($sidebar[$i]['child'][$j]['child'][$k]['icon']); ?>"></i>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="q-item__section column q-item__section--main justify-center">
                                                                        <?php echo e($sidebar[$i]['child'][$j]['child'][$k]['label']); ?>

                                                                    </div>
                                                                </a>
                                                            <?php endfor; ?>

                                                        </div>
                                                    <?php endif; ?>
                                                <?php endfor; ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                            <?php endfor; ?>

                        <?php endif; ?>

                        
                    </div>
                        </div>
                    </div>

            </div>
            </aside>
        </div>

    </div>
</div>
</div>
<script>
    $(document).ready(function () {
        $(".modal-button-desktop li").on("click", function () {
            $(".system-modal-left").slideToggle();
        });
        $(".close-modal-left").click(function () {
            $(".system-modal-left").slideToggle();
        });

    })



</script>
<?php /**PATH D:\project\gazacademy\resources\views/components/web/left-sidebar.blade.php ENDPATH**/ ?>