<?php
    $rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

    $curr_lang = app()->getLocale();
    if(Session::has('site_language')) {
        $curr_lang = Session::get('site_language');
    }

    $isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));
?>
<div class="dropdown">
    

    <a href="/cart" class="btn btn-transparent" style="<?php echo e($isRtl ? 'padding-left: 0 !important' : 'padding-right: 0 !important'); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart mr-10"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
    </a>

    <div class="dropdown-menu" aria-labelledby="navbarShopingCart">
        <div class="d-md-none border-bottom mb-20 pb-10 text-right">
            <i class="close-dropdown" data-feather="x" width="32" height="32" class="mr-10"></i>
        </div>
        <div class="h-100">
            <div class="navbar-shopping-cart h-100" data-simplebar>
                <?php if(!empty($userCarts) and count($userCarts) > 0): ?>
                    <div class="mb-auto">
                        <?php $__currentLoopData = $userCarts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $cartItemInfo = $cart->getItemInfo();
                                $cartTaxType = !empty($cartItemInfo['isProduct']) ? 'store' : 'general';
                            ?>

                            <?php if(!empty($cartItemInfo)): ?>
                                <div class="navbar-cart-box d-flex align-items-center">

                                    <a href="<?php echo e($cartItemInfo['itemUrl']); ?>" target="_blank" class="navbar-cart-img">
                                        <img src="<?php echo e($cartItemInfo['imgPath']); ?>" alt="product title" class="img-cover"/>
                                    </a>

                                    <div class="navbar-cart-info">
                                        <a href="<?php echo e($cartItemInfo['itemUrl']); ?>" target="_blank">
                                            <h4><?php echo e($cartItemInfo['title']); ?></h4>
                                        </a>
                                        <div class="price mt-10">
                                            <?php if(!empty($cartItemInfo['discountPrice'])): ?>
                                                <span class="text-primary font-weight-bold"><?php echo e(handlePrice($cartItemInfo['discountPrice'], true, true, false, null, true, $cartTaxType)); ?></span>
                                                <span class="off ml-15"><?php echo e(handlePrice($cartItemInfo['price'], true, true, false, null, true, $cartTaxType)); ?></span>
                                            <?php else: ?>
                                                <span class="text-primary font-weight-bold"><?php echo e(handlePrice($cartItemInfo['price'], true, true, false, null, true, $cartTaxType)); ?></span>
                                            <?php endif; ?>

                                            <?php if(!empty($cartItemInfo['quantity'])): ?>
                                                <span class="font-12 text-warning font-weight-500 ml-10">(<?php echo e($cartItemInfo['quantity']); ?> <?php echo e(trans('update.product')); ?>)</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="navbar-cart-actions">
                        <div class="navbar-cart-total mt-15 border-top d-flex align-items-center justify-content-between">
                            <strong class="total-text"><?php echo e(trans('cart.total')); ?></strong>
                            <strong class="text-primary font-weight-bold"><?php echo e(!empty($totalCartsPrice) ? handlePrice($totalCartsPrice, true, true, false, null, true, $cartTaxType) : 0); ?></strong>
                        </div>

                        <a href="/cart/" class="btn btn-sm btn-primary btn-block mt-50 mt-md-15"><?php echo e(trans('cart.go_to_cart')); ?></a>
                    </div>
                <?php else: ?>
                    <div class="d-flex align-items-center text-center py-50">
                        <i data-feather="shopping-cart" width="20" height="20" class="mr-10"></i>
                        <span class=""><?php echo e(trans('cart.your_cart_empty')); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\project\gazacademy\resources\views/web/default/includes/shopping-cart-dropdwon.blade.php ENDPATH**/ ?>