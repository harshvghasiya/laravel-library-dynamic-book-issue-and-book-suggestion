<?php $__env->startSection('title'); ?>
    <?php if(isset($title) && $title !=""): ?>
        <title><?php echo e($title); ?> - <?php echo e(trans('lang_data.softtechover_com_label')); ?></title>
    <?php else: ?>
        <title><?php echo e(trans('lang_data.welcome_to_softtechover_com')); ?></title>
    <?php endif; ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<style>
    li.main_menu a {
        color: #17b4b8;
        
        margin-bottom: 5px;
    }
    li.sub_menu_site_map {
        margin-left: 13px;
        margin-bottom: 5px;
    }
    li.sub_menu_site_map a {
        margin-left: 13px;
        color: black !important;
        /*font-size: 15px;*/
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="vizew-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('front.home')); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($cmsPageDetail->name); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container">
      <div class="col-12 col-sm-6 col-xl-3">
        <div class="footer-widget mb-70">
                <div class="single--twitter-slide">
                   <div class="td">
                        <ul>
                            <li class="main_menu"><a href="<?php echo e(route('front.home')); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;Home</a></li>
                            <h4>Category</h4>
                           <?php if(isset($sidebarCategory) && !$sidebarCategory->isEmpty()): ?>

                                <?php $__currentLoopData = $sidebarCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <li class="main_menu"><a href="<?php echo e(route('front.category.index',$v->slug)); ?>"> &nbsp; <?php echo e($v->name); ?></a></li>
                                    <ul>
                                        
                                        <?php if(isset($v->subCategory) && !$v->subCategory->isEmpty()): ?>
                                            <?php $__currentLoopData = $v->subCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2=>$v2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="sub_menu_site_map"><a href="<?php echo e(route('front.category.sub_category',$v->slug)); ?>"> &nbsp;<?php echo e($v2->name); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </ul>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php 


                                $cmsPages = \App\Models\Cms::select('id','slug','name','status')
                                                            ->where('status',1)
                                                            ->orderBy('name','ASC')
                                                            ->get();

                            ?>
                            <?php if(isset($cmsPages) && !$cmsPages->isEmpty()): ?>
                                <?php $__currentLoopData = $cmsPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($v->id != \App\Models\Cms::SITE_MAP_CONSTANT): ?>
                                        <li class="main_menu"><a href="<?php echo e(route('front.cms.details',$v->slug)); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo e($v->name); ?></a></li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php echo $__env->make('layouts.flashmessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_ecommerce/resources/views/front/pages/sitemap.blade.php ENDPATH**/ ?>