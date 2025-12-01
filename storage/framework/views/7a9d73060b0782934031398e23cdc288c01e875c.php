
<style>
    .side-popup-content * {
        font-size: 11px !important;
    }
    .side-popup-content .icon-top-submenu {
        font-size: 15px !important;
    }
</style>
<script>
            $("").click(function () {
            $(".system-modal-others").slideToggle();
        });
</script>

<div class="fixed-sidebar">
    <div class="bar">
        <ul>
            <li><a href="#"><i class="far fa-exchange"></i></a></li>
            <div class="side-popup">
                <li><a href="#"><i class="fas fa-home"></i></a></li>
                <div class="side-popup-content">
                    <?php if(isset($allsystems)): ?>
                        <ul>
                            <?php for($i=0; $i < count($allsystems);$i++): ?>
                                <div class="sub-side-popup">
                                    <li><a href="<?php echo e($allsystems[$i]['link']); ?>"><span class="<?php echo e($allsystems[$i]['icon']); ?> icon-top-submenu"></span><?php echo e($allsystems[$i]['label']); ?></a></li>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    

                                    
                                    
                                    
                                    
                                </div>
                            <?php endfor; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="side-popup">
                <li><a href="#"><i class="fal fa-bars"></i></a></li>
                <div class="side-popup-content">
                    <?php if(isset($sidenav)): ?>
                        <ul>
                            <?php $__currentLoopData = $sidenav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="sub-side-popup">
                                    <li><a href="#"><span class="<?php echo e($side['icon']); ?> icon-top-submenu"></span><?php echo e($side['label']); ?></a></li>
                                    <?php if($side['child'] != ''): ?>
                                        <div class="sub-side-popup-content">
                                            <ul>
                                                <?php $__currentLoopData = $side['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subside): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="sub-side-popup-3">
                                                        <li><a href="<?php echo e(linkSSO($subside['link'])); ?>" target="<?php echo e($subside['target']); ?>"><span class="<?php echo e($subside['icon']); ?> icon-top-submenu"></span><?php echo e($subside['label']); ?></a></li>
                                                        <?php if($subside['child'] != ''): ?>
                                                            <div class="sub-side-popup-content-3">
                                                                <ul>
                                                                    <?php $__currentLoopData = $subside['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sbbside): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li><a href="<?php echo e(linkSSO($sbbside['link'])); ?>" target="<?php echo e($sbbside['target']); ?>"><span class="<?php echo e($sbbside['icon']); ?> icon-top-submenu"></span><?php echo e($sbbside['label']); ?></a></li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <li><a href="#"><i class="fal fa-search"></i></a></li>
            <li><a href="#"><i class="fal fa-envelope"></i></a></li>
            <div class="side-popup">
                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                <div class="side-popup-content">
                    <ul>
                        <div class="sub-side-popup">
                            <li><a href="#">Register</a></li>
                            <div class="sub-side-popup-content">
                                <ul>
                                    <li><a href="#">Owner & Buyer</a></li>
                                    <li><a href="#">Real Estate agent or developer</a></li>
                                    <li><a href="#">Handyman or specialist</a></li>
                                    <li><a href="#">Local Partners</a></li>
                                    <li><a href="#">International partners</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sub-side-popup">
                            <li><a href="#">Search</a></li>
                            <div class="sub-side-popup-content">
                                <ul>
                                    <li><a href="#">Owner & Buyer</a></li>
                                    <li><a href="#">Real Estate agent or developer</a></li>
                                    <li><a href="#">Handyman or specialist</a></li>
                                    <li><a href="#">Local Partners</a></li>
                                    <li><a href="#">International partners</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sub-side-popup">
                            <li><a href="#">Add</a></li>
                            <div class="sub-side-popup-content">
                                <ul>
                                    <li><a href="#">Owner & Buyer</a></li>
                                    <li><a href="#">Real Estate agent or developer</a></li>
                                    <li><a href="#">Handyman or specialist</a></li>
                                    <li><a href="#">Local Partners</a></li>
                                    <li><a href="#">International partners</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sub-side-popup">
                            <li><a href="#">do</a></li>
                            <div class="sub-side-popup-content">
                                <ul>
                                    <li><a href="#">Owner & Buyer</a></li>
                                    <li><a href="#">Real Estate agent or developer</a></li>
                                    <li><a href="#">Handyman or specialist</a></li>
                                    <li><a href="#">Local Partners</a></li>
                                    <li><a href="#">International partners</a></li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </ul>
        
        
        
        
        
        
    </div>
</div>



<?php /**PATH D:\project\gazacademy\resources\views/components/web/fixed-side.blade.php ENDPATH**/ ?>