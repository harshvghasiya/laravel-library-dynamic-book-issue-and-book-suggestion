<header class="header-area">
    <div class="top-header-area">
        <div class="container">
            <div class="row align-items-center">
                <?php if(isset($topSectionHighLight) && !$topSectionHighLight->isEmpty()): ?>
                <div class="col-12 col-md-6">
                    <div class="breaking-news-area d-flex align-items-center">
                        <div class="news-title">
                            <p>Latest Post:</p>
                        </div>
                        <div id="breakingNewsTicker" class="ticker">
                            <ul>
                                <?php $__currentLoopData = $topSectionHighLight; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(route('front.blog.details',$v->slug)); ?>"><?php echo e($v->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-12 col-md-6">
                    <div class="top-meta-data d-flex align-items-center justify-content-end">
                        <div class="top-social-info">
                           <?php if(isset($socialMediaContent) && !$socialMediaContent->isEmpty()): ?>
                                <?php $__currentLoopData = $socialMediaContent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a target="_blank" href="<?php echo e($s->url); ?>"><i class="fa <?php echo e($s->font_awesome); ?>"></i></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="top-search-area">
                            <form action="<?php echo e(route('front.blog.search_post')); ?>" method="get">
                                <input type="search" name="search" id="topSearch" placeholder="Search...">
                                <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="vizew-main-menu" id="sticker">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <nav class="classy-navbar justify-content-between" id="vizewNav">
                    <a id="aa_logo" href="<?php echo e(route('front.home')); ?>" class="nav-brand"><img src="<?php echo e($settingData->getSettingLogoImageUrl()); ?>" alt=""></a>
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>
                    <div class="classy-menu">
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        <div class="classynav">
                            <ul>
                                <?php 

                                    if (\Request::route()->getName() =='front.home') {
                                        $classActive = "class=active";
                                    }else{
                                        $classActive ="";
                                    }
                                    if (\Request::route()->getName() =='front.category.get_all_category') {
                                        $classActiveCategory = "class=active";
                                    }else{
                                        $classActiveCategory ="";
                                    }

                                    if (\Request::route()->getName() =='front.demo') {
                                        $classActiveDemo = "class=active";
                                    }else{
                                        $classActiveDemo ="";
                                    }

                                ?>
                                <li <?php echo e($classActive); ?> ><a href="<?php echo e(route('front.home')); ?>">Home</a></li>
                                <?php if(isset($categoryCount) && !$categoryCount->isEmpty()): ?>
                                    <?php $__currentLoopData = $categoryCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php 
                                            if (\Request::segment(2) == $c->slug) {
                                                $classActiveCms = "class=active";
                                            }else{
                                                $classActiveCms ="";
                                            }
                                        ?>    
                                        <li <?php echo e($classActiveCms); ?>><a href="<?php echo e(route('front.category.category_single',$c->slug)); ?>"><?php echo e($c->name); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <li <?php echo e($classActiveCategory); ?>><a href="<?php echo e(route('front.category.get_all_category')); ?>">Categories</a></li>
                                <li <?php echo e($classActiveDemo); ?>><a href="<?php echo e(route('front.demo')); ?>">Demo</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header><?php /**PATH /var/www/html/laravel_admin_demo/resources/views/layouts/header.blade.php ENDPATH**/ ?>