

<link rel="stylesheet" href="<?php echo e(asset('css/layouts.css')); ?>">

<?php
$rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

$curr_lang = app()->getLocale();
if(Session::has('site_language')) {
$curr_lang = Session::get('site_language');
}

$isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));

$currency = auth()->user()->currency ?? Request::cookie('user_currency');
?>

<script>
function removeTransformFromTargets() {
  const els = document.querySelectorAll('.bg-columm-3, .toooltip-content');
  els.forEach(el => {
    el.style.setProperty('transform', 'none', 'important');
    el.style.setProperty('-webkit-transform', 'none', 'important');
  });
}

removeTransformFromTargets();

let tries = 0;
const interval = setInterval(() => {
  removeTransformFromTargets();
  if (++tries >= 20) clearInterval(interval);
}, 500);

const observer = new MutationObserver(() => {
  removeTransformFromTargets();
});

observer.observe(document.body, {
  childList: true,
  subtree: true,
  attributes: true,
  attributeFilter: ['style', 'class']
});
</script>




<!-- desktop -->

<div class='top-bar'>
    <div class="container-fluid">
        <div class="container">
            <div class="row pt-2 ">

                <!-- Left side of topbar -->

                <div class="col-9 left-side" id="left">
                    <ul class="nav flex-nowrap topbar_system">
                        <?php if($top_menu): ?>
                        <?php $__currentLoopData = $top_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $topmenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="toooltip">
                            <li style="z-index:<?php echo e(count($top_menu)-$key); ?>;"> <?php if($topmenu['custom'] == 1): ?> <?php echo $topmenu['icon']; ?> <?php else: ?> <i class="<?php echo e($topmenu['icon']); ?>"></i> <?php endif; ?> <?php echo e($topmenu['label']); ?></li>
                            <!-- <li style="z-index:<?php echo e(count($top_menu)-$key); ?>;">
                                        <a style= "display : flex;justify-content:center;align-items:center"href="<?php echo e(linkSSO($topmenu['link'])); ?>" target="_<?php echo e($topmenu['target']); ?>"><?php if($topmenu['custom'] == 1): ?> <i  style="margin-top:1px"><?php echo $topmenu['icon']; ?></i> <?php else: ?> <i  class="<?php echo e($topmenu['icon']); ?>" ></i> <?php endif; ?> <p style="margin-top:12px"><?php echo e($topmenu['label']); ?></p> </a>
                                    </li> -->

                            <div class="toooltip-content p-3">
                                <p><?php echo e($topmenu['sub_title']); ?></p>
                            </div>
                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <div class="toooltip">
                            <li><i class="fa fa-th"></i> <?php echo e(__('Other Systems')); ?></li>
                            <div class="toooltip-content bg-grey">
                                <div class="scrollbar-inner">
                                    <div class="otherSystem">
                                        <?php if($other_menu): ?>
                                        <?php $__currentLoopData = $other_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $othermenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($othermenu['child'] == null): ?>
                                        <div class="box-item font-roboto">

                                            <a <?php if($othermenu['target']=='blank' ): ?> target="_blank" <?php endif; ?> href="<?php echo e(linkSSO($othermenu['link'])); ?>">
                                                <div class="icons"><?php if($othermenu['custom'] == 1): ?> <?php echo $othermenu['icon']; ?> <?php else: ?> <i class="<?php echo e($othermenu['icon']); ?>"></i> <?php endif; ?> </div>
                                                <div class="name"><?php echo e($othermenu['label']); ?> </div>
                                            </a>
                                            <div class="box-dropdown px-3">
                                                <p class="text-xs">
                                                    <?php echo e($othermenu['sub_title']); ?>

                                                </p>
                                                <div class="content-buttons mt-2">
                                                    <button><span><i class="fab fa-android"></i></span>Download MiniApp</button>
                                                    <button><a href="<?php echo e(linkSSO($othermenu['link'])); ?>" target="_<?php echo e($othermenu['target']); ?>"><span><i class="fas fa-eye"></i> </span>Homepage</button>
                                                </div>
                                            </div>

                                        </div>
                                        <?php endif; ?>
                                        <?php if($othermenu['child'] != null): ?>
                                        <h3><?php echo e($othermenu['label']); ?></h3>
                                        <?php $__currentLoopData = $othermenu['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sublevel1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="box-item top font-roboto">

                                            <a <?php if($sublevel1['target']=='blank' ): ?> target="_blank" <?php endif; ?> href="<?php echo e(linkSSO($sublevel1['link'])); ?>">
                                                <div class="icons"><?php if($sublevel1['custom'] == 1): ?> <?php echo $sublevel1['icon']; ?> <?php else: ?> <i class="<?php echo e($sublevel1['icon']); ?>"></i> <?php endif; ?> </div>
                                                <div class="name"><?php echo e($sublevel1['label']); ?> </div>
                                            </a>

                                            <div class="box-dropdown px-3">
                                                <p class="text-xs">
                                                    <?php echo e($sublevel1['sub_title']); ?>

                                                </p>
                                                <div class="content-buttons mt-2">
                                                    <button><span><i class="fab fa-android"></i></span>Download MiniApp</button>
                                                    <button><a href="<?php echo e(linkSSO($sublevel1['link'])); ?>" target="_<?php echo e($sublevel1['target']); ?>"><span><i class="fas fa-eye"></i> </span>Homepage</a></button>
                                                </div>
                                            </div>

                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>

                <!-- Right side of topbar -->

                <div class="col-3 right-side">
                    <ul class="nav">

                        <div class="toooltip modal-button-desktop">
                            <li><i class="fas fa-bars"></i></li>
                        </div>

                        <div class="toooltip" >
                            <li><i class="kem-top-header-icons-flag"></i></li>
                            <div class="toooltip-content" id="set1">
                                <ul class="countries">
                                    <?php if($countries): ?>
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li style="color: white !important"><?php echo e($country['name']); ?></li>
                                            <ul class='states'>
                                                <?php if($country['country']): ?>
                                                    <?php $__currentLoopData = $country['country']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="active <?php echo e($cout['code'] == session('country_code') ? 'langBorder' : ''); ?>" data-code="<?php echo e($cout['code']); ?>">
                                                            <a href="<?php echo e(route('country.change', $cout['code'])); ?>">
                                                                <span class="flex gap-2">
                                                                    <span class="count-flag">
                                                                        <img src="<?php echo e(asset('country-flags-main/png100px') . '/' . $cout['code'] . '.png'); ?>" alt="" />
                                                                    </span>
                                                                    <span><?php echo e($cout['name']); ?></span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </ul>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ul>

                            </div>
                        </div>
                        
                        <div class="toooltip">
                            <li><i class="kem-top-header-icons-translate"></i></li>
                            <div class="toooltip-content" id="set2">
                                <ul class="languages">
                                    <?php for($i=0;$i< count($lang);$i++): ?>
                                        
                                        <li onclick="setLanguage('<?php echo e($lang[$i]['code']); ?>')"  class="<?php echo e($lang[$i]['code'] == $curr_lang ? 'langBorder' :''); ?>"><span class="lang-flag"><img class="img-fluid" src="<?php echo e(asset('language-flags/png100px').'/'.$lang[$i]['code'].'.png'); ?>" width="20px" alt=""></span><?php echo e($lang[$i]['name']); ?></li>
                                        <?php endfor; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="toooltip"  x-data="{ open: false }">
                            <li><i @click="open = ! open" class="kem-top-header-icons-dollar-symbol"></i></li>
                            <div class="toooltip-click-content" style="z-index: 10000;">
                                <div x-show="open" @click.outside="open = false" class="currenies" style="display:none">
                                    <div class="currency">
                                        <div class="title"><span>Currency</span></div>
                                        <form action="/set-currency" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <select class="currencies" name="currency" id="currency">
                                                <?php for($i=0;$i< count($curr);$i++): ?>
                                                    <option <?php echo e($currency == $curr[$i]['code'] ? 'selected' : ''); ?> id=<?php echo e($curr[$i]['id']); ?> data-code=<?php echo e($curr[$i]['code']); ?> value="<?php echo e($curr[$i]['code']); ?>"><?php echo e($curr[$i]['name']); ?></option>
                                                    <?php endfor; ?>
                                            </select>
                                            <button type="submit">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if($bft_AB): ?>
                        <?php $__currentLoopData = $bft_AB; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bftab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class='toooltip' >
                            <li><i class="<?php echo e($bftab['icon']); ?>"></i></li>
                            <div class="toooltip-content" id="set3">

                                <div class="grid-menu <?php echo e($bftab['class']); ?>">
                                    <p class="label-top" style="color: white !important;"><?php echo e($bftab['label']); ?> </p>
                                    <?php if($bftab['child']): ?>
                                    <?php $__currentLoopData = $bftab['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bfsub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="sub-toooltip">
                                        <div class="items">
                                            <a class="text-black" target="_<?php echo e($bfsub['target']); ?>" href="<?php echo e(linkSSO($bfsub['link'])); ?>">
                                                <i class="<?php echo e($bfsub['icon']); ?> icon-top-submenu" style="color: #c02127 !important;"></i>
                                                <?php echo e($bfsub['label']); ?>

                                            </a>
                                        </div>
                                        <?php if(!empty($bfsub['child'])): ?>
                                        <div class="sub-toooltip-content">
                                            <p class="label-top" style="color:white !important"><?php echo e($bfsub['label']); ?></p>
                                            <ul>
                                                <?php $__currentLoopData = $bfsub['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <li><a class="text-black" target="_<?php echo e($sub['target']); ?>" href="<?php echo e(linkSSO($sub['link'])); ?>"><span class="<?php echo e($sub['icon']); ?> me-2 icon-top-submenu"></span><?php echo e($sub['label']); ?></a></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <?php if(auth()->guard()->check()): ?>
                        

            
            <?php echo $__env->make('web.default.includes.top_nav.user_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(auth()->guard()->guest()): ?>
            <li><a href="<?php echo e(returnSSOLinkWithLang('login')); ?>" class="text-white"><i class="kem-top-header-icons-log-in"></i></a></li>
            <li> <a class="text-white" href="<?php echo e(returnSSOLinkWithLang('re')); ?>"><i class="kem-top-header-icons-signup"></i></a> </li>
            <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
</div>
</div>

<!-- mobile -->
<div class="m-top-bar" style=" background-color : #ffc107;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class='top-nav' style="padding-top: 10px !important;">
                    <div class="toooltip" x-data="{ open: false }">

                        <li><i @click="open = ! open" class="kem-top-header-icons-flag"></i></li>
                        <div class="toooltip-content contriesInMobile" x-show="open" @click.outside="open = false" style="display: none; " >
                        <ul class="countries">
    <?php if($countries): ?>
        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li style="color: white !important"><?php echo e($country['name']); ?></li>
            <ul class='states'>
                <?php if($country['country']): ?>
                    <?php $__currentLoopData = $country['country']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="active <?php echo e($cout['code'] == session('country_code') ? 'langBorder' : ''); ?>" data-code="<?php echo e($cout['code']); ?>">
                            <a href="<?php echo e(route('country.change', $cout['code'])); ?>">
                                <span class="flex gap-2">
                                    <span class="count-flag">
                                        <img src="<?php echo e(asset('country-flags-main/png100px') . '/' . $cout['code'] . '.png'); ?>" alt="" />
                                    </span>
                                    <span><?php echo e($cout['name']); ?></span>
                                </span>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</ul>

                        </div>
                    </div>
                    <div class="toooltip" x-data="{ openl: false }">
                        <li><i @click="openl = ! openl" class="kem-top-header-icons-translate"></i></li>
                        <div class="toooltip-content" x-show="openl" @click.outside="openl = false" style="display: none">
                            <ul class="languages">
                                <?php if($lang): ?>
                                <?php for($i=0;$i< count($lang);$i++): ?>
                                        
                                        <li onclick="setLanguage('<?php echo e($lang[$i]['code']); ?>')"  class="<?php echo e($lang[$i]['code'] == $curr_lang ? 'langBorder' : ''); ?>"><span class="lang-flag"><img class="img-fluid" src="<?php echo e(asset('language-flags/png100px').'/'.$lang[$i]['code'].'.png'); ?>" width="20px" alt=""></span><?php echo e($lang[$i]['name']); ?></li>
                                        <?php endfor; ?>

                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="toooltip" x-data="{ open: false }">
                            <li><i @click="open = ! open" class="kem-top-header-icons-dollar-symbol"></i></li>
                            <div class="toooltip-click-content" style="z-index: 10000; position: absolute;">
                                <div x-show="open" @click.outside="open = false" class="currenies" style="display:none">
                                    <div class="currency">
                                        <div class="title"><span>Currency</span></div>
                                        <form action="/set-currency" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <select class="currencies" name="currency" id="currency">
                                                <?php for($i=0;$i< count($curr);$i++): ?>
                                                    <option <?php echo e($currency == $curr[$i]['code'] ? 'selected' : ''); ?> id=<?php echo e($curr[$i]['id']); ?> data-code=<?php echo e($curr[$i]['code']); ?> value="<?php echo e($curr[$i]['code']); ?>"><?php echo e($curr[$i]['name']); ?></option>
                                                    <?php endfor; ?>
                                            </select>
                                            <button type="submit">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php if($bft_AB): ?>
                    <?php $__currentLoopData = $bft_AB; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $us): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="toooltip" x-data="{ open: false }">
                        <li><i @click="open = ! open" class="<?php echo e($us['icon']); ?>"></i> </li>
                        <div x-show="open" @click.outside="open = false" style="display: none">

                            <!-- grid menu content here-->
                            <?php if($us['child']): ?>
                            <?php if($us['class'] == 'column-3'): ?>
                            <div class="bg-columm-3 toooltip-content">
                                <div class="grid-menu">
                                    <p class="label-top" ><?php echo e($us['label']); ?></p>

                                    <?php $__currentLoopData = $us['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="sub-toooltip">
                                        <div class="items">
                                            <span class="icon-top-submenu <?php echo e($child['icon']); ?>"></span>
                                            <span><?php echo e($child['label']); ?></span>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <?php else: ?>

                            <div class="toooltip-content" id="men">
                                <div class="menu">
                                    <p class="label-top"><?php echo e($us['label']); ?></p>

                                    <?php $__currentLoopData = $us['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="item">
                                        <span class="icon-top-submenu <?php echo e($child['icon']); ?>"></span>
                                        <?php if(!empty($child['child'])): ?>
                                        <span><?php echo e($child['label']); ?></span>
                                        <button class="btn btn-toggle align-items-center rounded"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#home-collapse-<?php echo e($child['id']); ?>"
                                            aria-expanded="false">

                                            <i class="fa fa-caret-down"></i>
                                        </button>
                                        <?php else: ?>
                                        <span><?php echo e($child['label']); ?></span>
                                        <?php endif; ?>

                                        <?php if(!empty($child['child'])): ?>
                                        <div class="collapse relative-position ml-3" style="margin-left: 10px" id="home-collapse-<?php echo e($child['id']); ?>">
                                            <div class="menu">
                                                

                                                <?php $__currentLoopData = $child['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chChild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div class="item">
                                                    <span class="icon-top-submenu <?php echo e($chChild['icon']); ?>"></span>
                                                    <span><?php echo e($chChild['label']); ?></span>
                                                </div>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                    </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <?php endif; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    
                    <div class="toooltip" x-data="{ open: false }">

                        <li><a href="https://kemodoo.com/video-gallery"><i  class="fal fa-video"></i></a></li>
                        <div class="toooltip-content nav-videos" x-show="open" @click.outside="open = false" style="display: none; left: 0;transform: translateX(-75%);background: #e5e7eb; border-radius: 10px">
                            
                            
                            <div>
                                <div class="border-2 grid grid-cols-1 rounded-md w-[300px]">
                                    <div class="text-center p-2 h-[60px]">
                                        <div>kemedar proptech realstate marketplace Arabic video</div>
                                    </div>
                                    <div class="p-2">
                                        <a class="btn btn-primary video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/qpO5Q_YfiEM" data-bs-target="#myModal">
                                            <img src="https://laravel-kemedar.dev2.kemedar.com/kemedar/assets/images/first-tumbnail.webp" alt="" class="rounded-lg">
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="border-2 grid grid-cols-1 rounded-md w-[300px]">
                                    <div class="text-center p-2 h-[60px]">
                                        <div>kemedar proptech realstate marketplace English video</div>
                                    </div>
                                    <div class="p-2">
                                        <a class="btn btn-primary video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/qpO5Q_YfiEM" data-bs-target="#myModal">
                                            <img src="https://laravel-kemedar.dev2.kemedar.com/kemedar/assets/images/second-tumbnail.webp" alt="" class="rounded-lg">
                                        </a>

                                    </div>

                                </div>
                            </div>
                            <div>
                                <div class="border-2 grid grid-cols-1 rounded-md w-[300px]">
                                    <div class="text-center p-2 h-[60px]">
                                        <div>kemedar the best is yet to come</div>
                                    </div>
                                    <div class="p-2">
                                        <a class="btn btn-primary video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/QCvCW9hSvXY" data-bs-target="#myModal">
                                            <img src="https://laravel-kemedar.dev2.kemedar.com/kemedar/assets/images/thirdnew_thmbnail.jpg" alt="" class="rounded-lg">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <?php if(auth()->guard()->check()): ?>
                    <li><a href="kemecademy.com/logout" class="text-white"><i class="fal fa-sign-out"></i></a></li>
                    <?php endif; ?>
                    <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(returnSSOLinkWithLang('login')); ?>"><i class="fal fa-sign-in"></i></a></li>
                    <li><a href="<?php echo e(returnSSOLinkWithLang('re')); ?>"><i class="fal fa-user-plus"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>


    const setLanguage = (lang) => {
        let url = "<?php echo e(route('locale', ['FIXED_LANG'])); ?>";
        url = url.replace('FIXED_LANG', lang);
        window.open(url, "_self");
    }

</script>
<?php /**PATH D:\project\gazacademy\resources\views/components/web/fixTopBar.blade.php ENDPATH**/ ?>