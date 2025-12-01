<?php
    $user_role_id = 0;
    if( !Auth::guest() ) {
        $user_role_id = auth()->user()->role_id;
    }

    $rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

    $curr_lang = app()->getLocale();
    if(Session::has('site_language')) {
        $curr_lang = Session::get('site_language');
    }

    $isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));
?>
<style>
    .popup2 {
        position: relative;

    }

    .popup-content2 {
        position: absolute;
        right: 0;
        /* Add any additional styling you need for the popup content */
    }
    .popup-content-new {
        display: none;
        background-color:#e5e7eb;
        padding: 20px;
        border-radius: 1rem;
        box-shadow:0 0 10px 0 rgba(0,0,0,0.1);
        width:200px;
    }
    .items.popup2:hover .popup-content-new {
        display: block;
        z-index: 100;
    }
    .popup-content-new {
        position: absolute;
        left: 0px !important;
        margin-top: 5px;

    }
    .items.popup2 a.parent_anchor{
        position: relative;
    }

    .nav-bar-bottom .popup-content  *{
        color: #000!important;
        font-size: 11px!important;
    }

    .nav-bar-bottom .popup-content .icon-top-submenu {
        font-size: 15px!important;
        color: #c02127 !important;
    }
</style>

<div class="bottom-bar <?php echo e($user_role_id == 4 ? ( $isRtl ? 'panel-footer-width-instructor instructor-right' : 'panel-footer-width-instructor instructor-left') : ( $isRtl ? 'panel-footer-width-user' : 'panel-footer-width-user user-left' )); ?>">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto">
                <span>
                    All rights reserved to KEMEDAR &copy; CORPORATION 2014
                </span>
            </div>
            <div class="col-auto">
                <div class="nav-bar-bottom">
                    <ul>
                        <?php if($menuBottom): ?>
                            <?php $__currentLoopData = $menuBottom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menubtom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="popup ">
                                    <li><a href="#"><?php echo e($menubtom['label']); ?></a></li>
                                    <div class="popup-content <?php echo e($menubtom['class']); ?>">
                                        <div class="find-button">
                                            <button><?php echo e($menubtom['label']); ?></button>
                                        </div>
                                        <div class="items-grid <?php echo e($menubtom['class']); ?>">

                                            <?php if($menubtom['child']): ?>
                                            <?php $__currentLoopData = $menubtom['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bottomchild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                                <div class="items popup2">
                                                    <a href="<?php echo e(linkSSO($bottomchild['link'])); ?>" target="_<?php echo e($bottomchild['target']); ?>" class="parent_anchor"><span class="<?php echo e($bottomchild['icon']); ?> icon-top-submenu "></span><span><?php echo e($bottomchild['label']); ?></span>

                                                        <?php if(count($bottomchild['child']) > 0 ): ?>

                                                            <div class="popup-content-new">
                                                                <div class="inner-grid">
                                                                    <div class="find-button">
                                                                        <button><?php echo e($bottomchild['label']); ?></button>
                                                                    </div>
                                                                    <?php $__currentLoopData = $bottomchild['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subbottomchild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div class="inner-submenu">
                                                                            <div class="items">
                                                                                <a href="<?php echo e(linkSSO($subbottomchild['link'])); ?>" target="_<?php echo e($subbottomchild['target']); ?>">
                                                                                    <span class="<?php echo e($subbottomchild['icon']); ?> icon-top-submenu"></span>

                                                                                    <span class="text-dark"><?php echo e($subbottomchild['label']); ?></span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </div>

                                                            </div>
                                                        <?php endif; ?>

                                                    </a>

                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="bottom-image"></div>

                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  mobile fixed bottom bar -->
<div class="mobile-bottom-bar">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class='mobile-nav'>
                    <?php if($menuBottomMobile): ?>
                        <?php $__currentLoopData = $menuBottomMobile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $menubottombile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="toooltip">
                                <li x-data="{open<?php echo e($key); ?>: false}">
                                    <a @click="open<?php echo e($key); ?> = ! open<?php echo e($key); ?>" href="#">

                                        <i class="<?php echo e($menubottombile['icon']); ?>"></i>
                                        <span><?php echo e($menubottombile['label']); ?></span></a>
                                    <?php if(sizeof($menubottombile['child'])): ?>
                                        <div class="toooltip-content" x-show="open<?php echo e($key); ?>" @click.outside="open<?php echo e($key); ?> = false" style="display:none">
                                            <div class="button">
                                                <button x-show="open<?php echo e($key); ?>" @click.outside="open<?php echo e($key); ?> = false" style="display:none"><?php echo e($menubottombile['label']); ?></button>
                                                <span class="close" x-show="open<?php echo e($key); ?>" @click.outside="open<?php echo e($key); ?> = false" style="display:none"><i class="fal fa-times"></i></span>
                                            </div>

                                            <ul>
                                                <?php $__currentLoopData = $menubottombile['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bottomobilechild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="<?php echo e(linkSSO($bottomobilechild['link'])); ?>" target="<?php echo e($bottomobilechild['target']); ?>">
                                                            <span class="footer-icon <?php echo e($bottomobilechild['icon']); ?>"></span>
                                                            <span><?php echo e($bottomobilechild['label']); ?></span>
                                                        </a>
                                                        <?php if(sizeof($bottomobilechild['child'])): ?>
                                                            <div class="toooltip-content">
                                                                <div class="button">
                                                                    <button x-show="open<?php echo e($key); ?>" @click.outside="open<?php echo e($key); ?> = false" style="display:none"> <?php echo e($bottomobilechild['label']); ?></button>
                                                                    <span class="close" x-show="open<?php echo e($key); ?>" @click.outside="open<?php echo e($key); ?> = false" style="display: none"><i class="fal fa-times"></i></span>
                                                                </div>

                                                                <ul>
                                                                    <?php $__currentLoopData = $bottomobilechild['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subchildbottomobile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li>
                                                                            <a href="<?php echo e(linkSSO($subchildbottomobile['link'])); ?>" target="<?php echo e($subchildbottomobile['target']); ?>">
                                                                                <span class="footer-icon <?php echo e($subchildbottomobile['icon']); ?>"></span>
                                                                                <span><?php echo e($subchildbottomobile['label']); ?></span>
                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            </div>
                                                            <?php endif; ?>
                                                            </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </li>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\project\gazacademy\resources\views/components/web/bottom-bar.blade.php ENDPATH**/ ?>