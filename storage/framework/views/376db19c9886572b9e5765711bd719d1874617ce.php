<style>
    /* ضَعها في نفس <style> أعلى القالب */
.sidebar-main {
  width: 250px !important;
}
#panel-sidebar-scroll.sidebar-menu {
  width: 100% !important;
  max-width: 100% !important;
}

    #panel-sidebar-scroll {
        display: flex !important;
        flex-direction: column !important;
        height: 100vh;
        overflow-y: auto;
        scrollbar-width: none !important;
        padding: 0 5px;
        width: 100%;
    }
    .sidenav-item-icon > svg {
        fill: #c02127 !important;
        color: #c02127 !important;
        transform: scale(.7) !important;
    }
    .sidenav-item-icon,
    .sidenav-notification-icon,
    .sidenav-setting-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        margin-inline-end: 8px;
    }
    .sub-button {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 8px; text-decoration: none;
    }
    .sub-button:hover { background: rgba(0,0,0,.04); }
    .sub-nav-dropdown { margin: 0 0 6px 0; }
    .sidenav-item-collapse .nav-item > a { padding: 8px 12px; display:block; border-radius:6px; }
</style>

<?php
    $rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];
    $curr_lang    = Session::has('site_language') ? Session::get('site_language') : app()->getLocale();
    $isRtl        = (in_array(mb_strtoupper($curr_lang), $rtlLanguages))
                    || (!empty($generalSettings['rtl_layout']) && $generalSettings['rtl_layout'] == 1);
?>

<div class="sidebar-main">

     <div class="container mb-1 p-1 d-flex justify-content-center" style="display: flex !important;
        align-items: center;
        flex-direction: column;">
        <img src="https://kemecademy.com/images/avatar.png" height="80px" width="80px" alt="" style="border-radius: 50%;">
        <span class="fw-bold" style="font-size: 18px;"><?php echo e(Auth::user()->full_name); ?></span>
    </div>
    
    
    <ul id="panel-sidebar-scroll"
        class="sidebar-menu <?php if(!empty($authUser->userGroup)): ?> has-user-group <?php endif; ?> <?php if(empty($getPanelSidebarSettings) || empty($getPanelSidebarSettings['background'])): ?> without-bottom-image <?php endif; ?>"
        <?php if(!empty($isRtl) && $isRtl): ?> data-simplebar-direction="rtl" <?php endif; ?>>

        
        <li class="nav-item <?php echo e((request()->is('panel')) ? 'sidenav-item-active' : ''); ?>">
            <a href="/panel" class="sub-button">
                <span class="sidenav-item-icon">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-12 font-weight-500"><?php echo e(trans('panel.dashboard')); ?></span>
            </a>
        </li>

        <?php if($authUser->isOrganization()): ?>
            
            <li class="nav-item <?php echo e((request()->is('panel/instructors') || request()->is('panel/manage/instructors*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="sub-button" data-toggle="collapse" href="#instructorsCollapse" role="button"
                   aria-expanded="<?php echo e((request()->is('panel/instructors') || request()->is('panel/manage/instructors*')) ? 'true' : 'false'); ?>"
                   aria-controls="instructorsCollapse">
                    <span class="sidenav-item-icon">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.teachers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-14 font-weight-400"><?php echo e(trans('public.instructors')); ?></span>
                    <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
                </a>
                <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/instructors') || request()->is('panel/manage/instructors*')) ? 'show' : ''); ?>" id="instructorsCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="nav-item <?php echo e((request()->is('panel/manage/instructors/new')) ? 'active' : ''); ?>">
                            <a href="/panel/manage/instructors/new"><?php echo e(trans('public.new')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/manage/instructors')) ? 'active' : ''); ?>">
                            <a href="/panel/manage/instructors"><?php echo e(trans('public.list')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>

            
            <li class="nav-item <?php echo e((request()->is('panel/students') || request()->is('panel/manage/students*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="sub-button" data-toggle="collapse" href="#studentsCollapse" role="button"
                   aria-expanded="<?php echo e((request()->is('panel/students') || request()->is('panel/manage/students*')) ? 'true' : 'false'); ?>"
                   aria-controls="studentsCollapse">
                    <span class="sidenav-item-icon">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.students', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-12 font-weight-400"><?php echo e(trans('quiz.students')); ?></span>
                    <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
                </a>
                <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/students') || request()->is('panel/manage/students*')) ? 'show' : ''); ?>" id="studentsCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="nav-item <?php echo e((request()->is('panel/manage/students/new')) ? 'active' : ''); ?>">
                            <a href="/panel/manage/students/new"><?php echo e(trans('public.new')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/manage/students')) ? 'active' : ''); ?>">
                            <a href="/panel/manage/students"><?php echo e(trans('public.list')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        
        <li class="nav-item <?php echo e((request()->is('panel/webinars') || request()->is('panel/webinars/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="sub-button" data-toggle="collapse" href="#webinarCollapse" role="button"
               aria-expanded="<?php echo e((request()->is('panel/webinars') || request()->is('panel/webinars/*')) ? 'true' : 'false'); ?>"
               aria-controls="webinarCollapse">
                <span class="sidenav-item-icon">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.webinars', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-12 font-weight-400"><?php echo e(trans('panel.webinars')); ?></span>
                <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
            </a>
            <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/webinars') || request()->is('panel/webinars/*')) ? 'show' : ''); ?>" id="webinarCollapse">
                <ul class="sidenav-item-collapse">
                    <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                        <li class="nav-item <?php echo e((request()->is('panel/webinars/new')) ? 'active' : ''); ?>">
                            <a href="/panel/webinars/new"><?php echo e(trans('public.new')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/webinars')) ? 'active' : ''); ?>">
                            <a href="/panel/webinars"><?php echo e(trans('panel.my_classes')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/webinars/invitations')) ? 'active' : ''); ?>">
                            <a href="/panel/webinars/invitations"><?php echo e(trans('panel.invited_classes')); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if(!empty($authUser->organ_id)): ?>
                        <li class="nav-item <?php echo e((request()->is('panel/webinars/organization_classes')) ? 'active' : ''); ?>">
                            <a href="/panel/webinars/organization_classes"><?php echo e(trans('panel.organization_classes')); ?></a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item <?php echo e((request()->is('panel/webinars/purchases')) ? 'active' : ''); ?>">
                        <a href="/panel/webinars/purchases"><?php echo e(trans('panel.my_purchases')); ?></a>
                    </li>

                    <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                        <li class="nav-item <?php echo e((request()->is('panel/webinars/comments')) ? 'active' : ''); ?>">
                            <a href="/panel/webinars/comments"><?php echo e(trans('panel.my_class_comments')); ?></a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item <?php echo e((request()->is('panel/webinars/my-comments')) ? 'active' : ''); ?>">
                        <a href="/panel/webinars/my-comments"><?php echo e(trans('panel.my_comments')); ?></a>
                    </li>

                    <li class="nav-item <?php echo e((request()->is('panel/webinars/favorites')) ? 'active' : ''); ?>">
                        <a href="/panel/webinars/favorites"><?php echo e(trans('panel.favorites')); ?></a>
                    </li>
                </ul>
            </div>
        </li>

        <?php if(!empty(getFeaturesSettings('upcoming_courses_status'))): ?>
            
            <li class="nav-item <?php echo e((request()->is('panel/upcoming_courses') || request()->is('panel/upcoming_courses/*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="sub-button" data-toggle="collapse" href="#upcomingCoursesCollapse" role="button"
                   aria-expanded="<?php echo e((request()->is('panel/upcoming_courses') || request()->is('panel/upcoming_courses/*')) ? 'true' : 'false'); ?>"
                   aria-controls="upcomingCoursesCollapse">
                    <span class="sidenav-item-icon"><i data-feather="film"></i></span>
                    <span class="font-14 font-weight-400"><?php echo e(trans('update.upcoming_courses')); ?></span>
                    <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
                </a>
                <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/upcoming_courses') || request()->is('panel/upcoming_courses/*')) ? 'show' : ''); ?>" id="upcomingCoursesCollapse">
                    <ul class="sidenav-item-collapse">
                        <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                            <li class="nav-item <?php echo e((request()->is('panel/upcoming_courses/new')) ? 'active' : ''); ?>">
                                <a href="/panel/upcoming_courses/new"><?php echo e(trans('public.new')); ?></a>
                            </li>
                            <li class="nav-item <?php echo e((request()->is('panel/upcoming_courses')) ? 'active' : ''); ?>">
                                <a href="/panel/upcoming_courses"><?php echo e(trans('update.my_upcoming_courses')); ?></a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item <?php echo e((request()->is('panel/upcoming_courses/followings')) ? 'active' : ''); ?>">
                            <a href="/panel/upcoming_courses/followings"><?php echo e(trans('update.following_courses')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
            
            <li class="nav-item <?php echo e((request()->is('panel/bundles') || request()->is('panel/bundles/*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="sub-button" data-toggle="collapse" href="#bundlesCollapse" role="button"
                   aria-expanded="<?php echo e((request()->is('panel/bundles') || request()->is('panel/bundles/*')) ? 'true' : 'false'); ?>"
                   aria-controls="bundlesCollapse">
                    <span class="sidenav-item-icon assign-fill">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.bundles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-14 font-weight-400"><?php echo e(trans('update.bundles')); ?></span>
                    <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
                </a>
                <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/bundles') || request()->is('panel/bundles/*')) ? 'show' : ''); ?>" id="bundlesCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="nav-item <?php echo e((request()->is('panel/bundles/new')) ? 'active' : ''); ?>">
                            <a href="/panel/bundles/new"><?php echo e(trans('public.new')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/bundles')) ? 'active' : ''); ?>">
                            <a href="/panel/bundles"><?php echo e(trans('update.my_bundles')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php if(getFeaturesSettings('webinar_assignment_status')): ?>
            
            <li class="nav-item <?php echo e((request()->is('panel/assignments') || request()->is('panel/assignments/*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="sub-button" data-toggle="collapse" href="#assignmentCollapse" role="button"
                   aria-expanded="<?php echo e((request()->is('panel/assignments') || request()->is('panel/assignments/*')) ? 'true' : 'false'); ?>"
                   aria-controls="assignmentCollapse">
                    <span class="sidenav-item-icon">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.assignments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-12 font-weight-400"><?php echo e(trans('update.assignments')); ?></span>
                    <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
                </a>
                <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/assignments') || request()->is('panel/assignments/*')) ? 'show' : ''); ?>" id="assignmentCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="nav-item <?php echo e((request()->is('panel/assignments/my-assignments')) ? 'active' : ''); ?>">
                            <a href="/panel/assignments/my-assignments"><?php echo e(trans('update.my_assignments')); ?></a>
                        </li>
                        <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                            <li class="nav-item <?php echo e((request()->is('panel/assignments/my-courses-assignments')) ? 'active' : ''); ?>">
                                <a href="/panel/assignments/my-courses-assignments"><?php echo e(trans('update.students_assignments')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        
        <li class="nav-item <?php echo e((request()->is('panel/meetings') || request()->is('panel/meetings/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="sub-button" data-toggle="collapse" href="#meetingCollapse" role="button"
               aria-expanded="<?php echo e((request()->is('panel/meetings') || request()->is('panel/meetings/*')) ? 'true' : 'false'); ?>"
               aria-controls="meetingCollapse">
                <span class="sidenav-item-icon">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.requests', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-12 font-weight-400"><?php echo e(trans('panel.meetings')); ?></span>
                <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
            </a>
            <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/meetings') || request()->is('panel/meetings/*')) ? 'show' : ''); ?>" id="meetingCollapse">
                <ul class="sidenav-item-collapse">
                    <li class="nav-item <?php echo e((request()->is('panel/meetings/reservation')) ? 'active' : ''); ?>">
                        <a href="/panel/meetings/reservation"><?php echo e(trans('public.my_reservation')); ?></a>
                    </li>
                    <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                        <li class="nav-item <?php echo e((request()->is('panel/meetings/requests')) ? 'active' : ''); ?>">
                            <a href="/panel/meetings/requests"><?php echo e(trans('panel.requests')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/meetings/settings')) ? 'active' : ''); ?>">
                            <a href="/panel/meetings/settings"><?php echo e(trans('panel.settings')); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </li>

        
        <li class="nav-item <?php echo e((request()->is('panel/quizzes') || request()->is('panel/quizzes/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="sub-button" data-toggle="collapse" href="#quizzesCollapse" role="button"
               aria-expanded="<?php echo e((request()->is('panel/quizzes') || request()->is('panel/quizzes/*')) ? 'true' : 'false'); ?>"
               aria-controls="quizzesCollapse">
                <span class="sidenav-item-icon">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.quizzes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-12 font-weight-400"><?php echo e(trans('panel.quizzes')); ?></span>
                <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
            </a>
            <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/quizzes') || request()->is('panel/quizzes/*')) ? 'show' : ''); ?>" id="quizzesCollapse">
                <ul class="sidenav-item-collapse">
                    <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                        <li class="nav-item <?php echo e((request()->is('panel/quizzes/new')) ? 'active' : ''); ?>">
                            <a href="/panel/quizzes/new"><?php echo e(trans('quiz.new_quiz')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/quizzes')) ? 'active' : ''); ?>">
                            <a href="/panel/quizzes"><?php echo e(trans('public.list')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/quizzes/results')) ? 'active' : ''); ?>">
                            <a href="/panel/quizzes/results"><?php echo e(trans('public.results')); ?></a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item <?php echo e((request()->is('panel/quizzes/my-results')) ? 'active' : ''); ?>">
                        <a href="/panel/quizzes/my-results"><?php echo e(trans('public.my_results')); ?></a>
                    </li>
                    <li class="nav-item <?php echo e((request()->is('panel/quizzes/opens')) ? 'active' : ''); ?>">
                        <a href="/panel/quizzes/opens"><?php echo e(trans('public.not_participated')); ?></a>
                    </li>
                </ul>
            </div>
        </li>

        
        <li class="nav-item <?php echo e((request()->is('panel/certificates') || request()->is('panel/certificates/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="sub-button" data-toggle="collapse" href="#certificatesCollapse" role="button"
               aria-expanded="<?php echo e((request()->is('panel/certificates') || request()->is('panel/certificates/*')) ? 'true' : 'false'); ?>"
               aria-controls="certificatesCollapse">
                <span class="sidenav-item-icon">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.certificate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 font-weight-400"><?php echo e(trans('panel.certificates')); ?></span>
                <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
            </a>
            <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/certificates') || request()->is('panel/certificates/*')) ? 'show' : ''); ?>" id="certificatesCollapse">
                <ul class="sidenav-item-collapse">
                    <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                        <li class="nav-item <?php echo e((request()->is('panel/certificates')) ? 'active' : ''); ?>">
                            <a href="/panel/certificates"><?php echo e(trans('public.list')); ?></a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item <?php echo e((request()->is('panel/certificates/achievements')) ? 'active' : ''); ?>">
                        <a href="/panel/certificates/achievements"><?php echo e(trans('quiz.achievements')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="/certificate_validation"><?php echo e(trans('site.certificate_validation')); ?></a>
                    </li>
                    <li class="nav-item <?php echo e((request()->is('panel/certificates/webinars')) ? 'active' : ''); ?>">
                        <a href="/panel/certificates/webinars"><?php echo e(trans('update.course_certificates')); ?></a>
                    </li>
                </ul>
            </div>
        </li>

        <?php if($authUser->checkCanAccessToStore()): ?>
            
            <li class="nav-item <?php echo e((request()->is('panel/store') || request()->is('panel/store/*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="sub-button" data-toggle="collapse" href="#storeCollapse" role="button"
                   aria-expanded="<?php echo e((request()->is('panel/store') || request()->is('panel/store/*')) ? 'true' : 'false'); ?>"
                   aria-controls="storeCollapse">
                    <span class="sidenav-item-icon assign-fill">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.store', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-12 font-weight-400"><?php echo e(trans('update.store')); ?></span>
                    <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
                </a>
                <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/store') || request()->is('panel/store/*')) ? 'show' : ''); ?>" id="storeCollapse">
                    <ul class="sidenav-item-collapse">
                        <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                            <li class="nav-item <?php echo e((request()->is('panel/store/products/new')) ? 'active' : ''); ?>">
                                <a href="/panel/store/products/new"><?php echo e(trans('update.new_product')); ?></a>
                            </li>
                            <li class="nav-item <?php echo e((request()->is('panel/store/products')) ? 'active' : ''); ?>">
                                <a href="/panel/store/products"><?php echo e(trans('update.products')); ?></a>
                            </li>
                            <?php $sellerProductOrderWaitingDeliveryCount = $authUser->getWaitingDeliveryProductOrdersCount(); ?>
                            <li class="nav-item <?php echo e((request()->is('panel/store/sales')) ? 'active' : ''); ?>">
                                <a href="/panel/store/sales">
                                    <?php echo e(trans('panel.sales')); ?>

                                    <?php if($sellerProductOrderWaitingDeliveryCount > 0): ?>
                                        <span class="d-inline-flex align-items-center justify-content-center font-weight-500 ml-15 panel-sidebar-store-sales-circle-badge"><?php echo e($sellerProductOrderWaitingDeliveryCount); ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item <?php echo e((request()->is('panel/store/purchases')) ? 'active' : ''); ?>">
                            <a href="/panel/store/purchases"><?php echo e(trans('panel.my_purchases')); ?></a>
                        </li>

                        <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                            <li class="nav-item <?php echo e((request()->is('panel/store/products/comments')) ? 'active' : ''); ?>">
                                <a href="/panel/store/products/comments"><?php echo e(trans('update.product_comments')); ?></a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item <?php echo e((request()->is('panel/store/products/my-comments')) ? 'active' : ''); ?>">
                            <a href="/panel/store/products/my-comments"><?php echo e(trans('panel.my_comments')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        
        <li class="nav-item <?php echo e((request()->is('panel/financial') || request()->is('panel/financial/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="sub-button" data-toggle="collapse" href="#financialCollapse" role="button"
               aria-expanded="<?php echo e((request()->is('panel/financial') || request()->is('panel/financial/*')) ? 'true' : 'false'); ?>"
               aria-controls="financialCollapse">
                <span class="sidenav-item-icon">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.financial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-12 font-weight-400"><?php echo e(trans('panel.financial')); ?></span>
                <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
            </a>
            <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/financial') || request()->is('panel/financial/*')) ? 'show' : ''); ?>" id="financialCollapse">
                <ul class="sidenav-item-collapse">
                    <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                        <li class="nav-item <?php echo e((request()->is('panel/financial/sales')) ? 'active' : ''); ?>">
                            <a href="/panel/financial/sales"><?php echo e(trans('financial.sales_report')); ?></a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item <?php echo e((request()->is('panel/financial/summary')) ? 'active' : ''); ?>">
                        <a href="/panel/financial/summary"><?php echo e(trans('financial.financial_summary')); ?></a>
                    </li>
                    <li class="nav-item <?php echo e((request()->is('panel/financial/payout')) ? 'active' : ''); ?>">
                        <a href="/panel/financial/payout"><?php echo e(trans('financial.payout')); ?></a>
                    </li>
                    <li class="nav-item <?php echo e((request()->is('panel/financial/account')) ? 'active' : ''); ?>">
                        <a href="/panel/financial/account"><?php echo e(trans('financial.charge_account')); ?></a>
                    </li>
                    <li class="nav-item <?php echo e((request()->is('panel/financial/subscribes')) ? 'active' : ''); ?>">
                        <a href="/panel/financial/subscribes"><?php echo e(trans('financial.subscribes')); ?></a>
                    </li>
                    <?php if(($authUser->isOrganization() || $authUser->isTeacher()) and getRegistrationPackagesGeneralSettings('status')): ?>
                        <li class="nav-item <?php echo e((request()->is('panel/financial/registration-packages')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('panelRegistrationPackagesLists')); ?>"><?php echo e(trans('update.registration_packages')); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(getInstallmentsSettings('status')): ?>
                        <li class="nav-item <?php echo e((request()->is('panel/financial/installments*')) ? 'active' : ''); ?>">
                            <a href="/panel/financial/installments"><?php echo e(trans('update.installments')); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </li>

        
        <li class="nav-item <?php echo e((request()->is('panel/support') || request()->is('panel/support/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="sub-button" data-toggle="collapse" href="#supportCollapse" role="button"
               aria-expanded="<?php echo e((request()->is('panel/support') || request()->is('panel/support/*')) ? 'true' : 'false'); ?>"
               aria-controls="supportCollapse">
                <span class="sidenav-item-icon assign-fill">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.support', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-12 font-weight-400"><?php echo e(trans('panel.support')); ?></span>
                <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
            </a>
            <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/support') || request()->is('panel/support/*')) ? 'show' : ''); ?>" id="supportCollapse">
                <ul class="sidenav-item-collapse">
                    <li class="nav-item <?php echo e((request()->is('panel/support/new')) ? 'active' : ''); ?>">
                        <a href="/panel/support/new"><?php echo e(trans('public.new')); ?></a>
                    </li>
                    <li class="nav-item <?php echo e((request()->is('panel/support')) ? 'active' : ''); ?>">
                        <a href="/panel/support"><?php echo e(trans('panel.classes_support')); ?></a>
                    </li>
                    <li class="nav-item <?php echo e((request()->is('panel/support/tickets')) ? 'active' : ''); ?>">
                        <a href="/panel/support/tickets"><?php echo e(trans('panel.support_tickets')); ?></a>
                    </li>
                </ul>
            </div>
        </li>

        <?php if(!$authUser->isUser() || (!empty($referralSettings) && $referralSettings['status'] && $authUser->affiliate) || (!empty(getRegistrationBonusSettings('status')) && $authUser->enable_registration_bonus)): ?>
            
            <li class="nav-item <?php echo e((request()->is('panel/marketing') || request()->is('panel/marketing/*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="sub-button" data-toggle="collapse" href="#marketingCollapse" role="button"
                   aria-expanded="<?php echo e((request()->is('panel/marketing') || request()->is('panel/marketing/*')) ? 'true' : 'false'); ?>"
                   aria-controls="marketingCollapse">
                    <span class="sidenav-item-icon">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-12 font-weight-400"><?php echo e(trans('panel.marketing')); ?></span>
                    <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
                </a>
                <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/marketing') || request()->is('panel/marketing/*')) ? 'show' : ''); ?>" id="marketingCollapse">
                    <ul class="sidenav-item-collapse">
                        <?php if(!$authUser->isUser()): ?>
                            <li class="nav-item <?php echo e((request()->is('panel/marketing/special_offers')) ? 'active' : ''); ?>">
                                <a href="/panel/marketing/special_offers"><?php echo e(trans('panel.discounts')); ?></a>
                            </li>
                            <li class="nav-item <?php echo e((request()->is('panel/marketing/promotions')) ? 'active' : ''); ?>">
                                <a href="/panel/marketing/promotions"><?php echo e(trans('panel.promotions')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(!empty($referralSettings) && $referralSettings['status'] && $authUser->affiliate): ?>
                            <li class="nav-item <?php echo e((request()->is('panel/marketing/affiliates')) ? 'active' : ''); ?>">
                                <a href="/panel/marketing/affiliates"><?php echo e(trans('panel.affiliates')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(!empty(getRegistrationBonusSettings('status')) && $authUser->enable_registration_bonus): ?>
                            <li class="nav-item <?php echo e((request()->is('panel/marketing/registration_bonus')) ? 'active' : ''); ?>">
                                <a href="/panel/marketing/registration_bonus"><?php echo e(trans('update.registration_bonus')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php if(getFeaturesSettings('forums_status')): ?>
            
            <li class="nav-item <?php echo e((request()->is('panel/forums') || request()->is('panel/forums/*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="sub-button" data-toggle="collapse" href="#forumsCollapse" role="button"
                   aria-expanded="<?php echo e((request()->is('panel/forums') || request()->is('panel/forums/*')) ? 'true' : 'false'); ?>"
                   aria-controls="forumsCollapse">
                    <span class="sidenav-item-icon assign-fill">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.forums', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-12 font-weight-400"><?php echo e(trans('update.forums')); ?></span>
                    <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
                </a>
                <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/forums') || request()->is('panel/forums/*')) ? 'show' : ''); ?>" id="forumsCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="nav-item <?php echo e((request()->is('/forums/create-topic')) ? 'active' : ''); ?>">
                            <a href="/forums/create-topic"><?php echo e(trans('update.new_topic')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/forums/topics')) ? 'active' : ''); ?>">
                            <a href="/panel/forums/topics"><?php echo e(trans('update.my_topics')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/forums/posts')) ? 'active' : ''); ?>">
                            <a href="/panel/forums/posts"><?php echo e(trans('update.my_posts')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/forums/bookmarks')) ? 'active' : ''); ?>">
                            <a href="/panel/forums/bookmarks"><?php echo e(trans('update.bookmarks')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php if($authUser->isTeacher()): ?>
            
            <li class="nav-item <?php echo e((request()->is('panel/blog') || request()->is('panel/blog/*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="sub-button" data-toggle="collapse" href="#blogCollapse" role="button"
                   aria-expanded="<?php echo e((request()->is('panel/blog') || request()->is('panel/blog/*')) ? 'true' : 'false'); ?>"
                   aria-controls="blogCollapse">
                    <span class="sidenav-item-icon assign-fill">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-12 font-weight-400"><?php echo e(trans('update.articles')); ?></span>
                    <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
                </a>
                <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/blog') || request()->is('panel/blog/*')) ? 'show' : ''); ?>" id="blogCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="nav-item <?php echo e((request()->is('panel/blog/posts/new')) ? 'active' : ''); ?>">
                            <a href="/panel/blog/posts/new"><?php echo e(trans('update.new_article')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/blog/posts')) ? 'active' : ''); ?>">
                            <a href="/panel/blog/posts"><?php echo e(trans('update.my_articles')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/blog/comments')) ? 'active' : ''); ?>">
                            <a href="/panel/blog/comments"><?php echo e(trans('panel.comments')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
            
            <li class="nav-item <?php echo e((request()->is('panel/noticeboard*') || request()->is('panel/course-noticeboard*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="sub-button" data-toggle="collapse" href="#noticeboardCollapse" role="button"
                   aria-expanded="<?php echo e((request()->is('panel/noticeboard*') || request()->is('panel/course-noticeboard*')) ? 'true' : 'false'); ?>"
                   aria-controls="noticeboardCollapse">
                    <span class="sidenav-item-icon">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.noticeboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-12 font-weight-400"><?php echo e(trans('panel.noticeboard')); ?></span>
                    <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
                </a>
                <div class="sub-nav-dropdown collapse <?php echo e((request()->is('panel/noticeboard*') || request()->is('panel/course-noticeboard*')) ? 'show' : ''); ?>" id="noticeboardCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="nav-item <?php echo e((request()->is('panel/noticeboard')) ? 'active' : ''); ?>">
                            <a href="/panel/noticeboard"><?php echo e(trans('public.history')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/noticeboard/new')) ? 'active' : ''); ?>">
                            <a href="/panel/noticeboard/new"><?php echo e(trans('public.new')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/course-noticeboard')) ? 'active' : ''); ?>">
                            <a href="/panel/course-noticeboard"><?php echo e(trans('update.course_notices')); ?></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('panel/course-noticeboard/new')) ? 'active' : ''); ?>">
                            <a href="/panel/course-noticeboard/new"><?php echo e(trans('update.new_course_notices')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php $rewardSetting = getRewardsSettings(); ?>
        <?php if(!empty($rewardSetting) && $rewardSetting['status'] == '1'): ?>
            
            <li class="nav-item <?php echo e((request()->is('panel/rewards')) ? 'sidenav-item-active' : ''); ?>">
                <a href="/panel/rewards" class="sub-button">
                    <span class="sidenav-item-icon assign-strock">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.rewards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-12 font-weight-400"><?php echo e(trans('update.rewards')); ?></span>
                    <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if($authUser->checkAccessToAIContentFeature()): ?>
            
            <li class="nav-item <?php echo e((request()->is('panel/ai-contents')) ? 'sidenav-item-active' : ''); ?>">
                <a href="/panel/ai-contents" class="sub-button">
                    <span class="sidenav-item-icon assign-strock">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.ai_contents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-12 font-weight-400"><?php echo e(trans('update.ai_contents')); ?></span>
                    <span class="right-arrow"><i class="far fa-chevron-right"></i></span>
                </a>
            </li>
        <?php endif; ?>

        
        <li class="nav-item <?php echo e((request()->is('panel/notifications')) ? 'sidenav-item-active' : ''); ?>">
            <a href="/panel/notifications" class="sub-button">
                <span class="sidenav-notification-icon sidenav-item-icon">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-12 font-weight-400"><?php echo e(trans('panel.notifications')); ?></span>
            </a>
        </li>

        
        <li class="nav-item <?php echo e((request()->is('panel/setting')) ? 'sidenav-item-active' : ''); ?>">
            <a href="/panel/setting" class="sub-button">
                <span class="sidenav-setting-icon sidenav-item-icon">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-12 font-weight-400"><?php echo e(trans('panel.settings')); ?></span>
            </a>
        </li>

        <?php if($authUser->isTeacher() || $authUser->isOrganization()): ?>
            
            <li class="nav-item">
                <a href="<?php echo e($authUser->getProfileUrl()); ?>" class="sub-button">
                    <span class="sidenav-item-icon assign-strock">
                        <i data-feather="user" stroke="#1f3b64" stroke-width="1.5" width="24" height="24" class="webinar-icon"></i>
                    </span>
                    <span class="font-12 font-weight-400"><?php echo e(trans('public.my_profile')); ?></span>
                </a>
            </li>
        <?php endif; ?>

        
        <li class="nav-item">
            <a href="/logout" class="sub-button">
                <span class="sidenav-logout-icon sidenav-item-icon">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.logout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-12 font-weight-400"><?php echo e(trans('panel.log_out')); ?></span>
            </a>
        </li>
    </ul>
</div>
<?php /**PATH D:\project\gazacademy\resources\views/components/web/sidebar.blade.php ENDPATH**/ ?>