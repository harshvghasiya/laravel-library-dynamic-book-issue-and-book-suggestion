<header>
    <div class="top-bar">
        <div class="container">
            <div class="tb-contact pull-left">
                <?php if(isset($setting) && !empty($setting->email)): ?>
                    <i class="fa fa-envelope color"></i> &nbsp; 
                    <a href="mailto:<?php echo e($setting->email); ?>"><?php echo e($setting->email); ?></a>
                    &nbsp;&nbsp;
                <?php endif; ?>
                <?php if(isset($setting) && !empty($setting->mobile)): ?>
                    <i class="fa fa-phone color"></i> &nbsp; <a href="tel:+<?php echo e($setting->mobile); ?>">+<?php echo e($setting->mobile); ?></a>
                <?php endif; ?>
            </div>
            <div class="tb-search pull-left">
                <a href="#" class="b-dropdown"><i class="fa fa-search square-2 rounded-1 bg-color white"></i></a>
                <div class="b-dropdown-block">
                    <form action="<?php echo e(route('front.product.index')); ?>" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" value="<?php echo e(request()->get('search')); ?>" class="form-control" placeholder="Type Something">
                                <span class="input-group-btn">
                                    <button class="btn btn-color" type="submit">Search</button>
                                </span>
                        </div>
                    </form>
                </div>
            </div>
            <?php if(isset($socialMediaContent) && !$socialMediaContent->isEmpty()): ?>
                <div class="tb-social pull-right">
                    <div class="brand-bg text-right">
                      <?php $__currentLoopData = $socialMediaContent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a target="_blank" href="<?php echo e($v->url); ?>" class="<?php echo e($v->title); ?>"><i class="<?php echo e($v->font_awesome); ?> square-2 rounded-1"></i></a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="header-1">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="logo">
                        <a href="<?php echo e(route('front.home')); ?>"><img alt="" src="<?php echo e($setting->getSettingLogoImageUrl()); ?>" class="footer-logo"></a>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-2 col-sm-5 col-sm-offset-3 hidden-xs">
                    <div class="header-search">
                        <form action="<?php echo e(route('front.product.index')); ?>" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" value="<?php echo e(request()->get('search')); ?>" class="form-control" placeholder="Type Something">
                                        <span class="input-group-btn">
                                            <button class="btn btn-color" type="submit">Search</button>
                                        </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="navi">
            <div class="container">
                <div class="navy">
                    <ul>
                        <li><a href="<?php echo e(route('front.home')); ?>">Home</a></li>
                        <li><a href="<?php echo e(route('front.product.index')); ?>">Products</a></li>

                         <?php if(isset($headerSectionLink) && !$headerSectionLink->isEmpty()): ?>
                          <?php $__currentLoopData = $headerSectionLink; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php 

                            if ($v->redirect_url !=null) {
                                
                                $routeUrl = $v->redirect_url;
                                $target ="_blank";

                            }else{

                                $routeUrl = route('front.cms.details',$v->slug);
                                $target ="_self";
                            }

                          ?>
                            <?php if($v->parent_id !=NULL): ?>
                                <?php if($v->parent !=null): ?>
                                    <li><a href="<?php echo e($routeUrl); ?>" target="<?php echo e($target); ?>"><?php echo e($v->name); ?></a></li>
                                <?php endif; ?>
                            <?php else: ?>
                            <li><a href="<?php echo e($routeUrl); ?>" target="<?php echo e($target); ?>"><?php echo e($v->name); ?></a></li>
                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</header><?php /**PATH /var/www/html/laravel_ecommerce/resources/views/layouts/header.blade.php ENDPATH**/ ?>