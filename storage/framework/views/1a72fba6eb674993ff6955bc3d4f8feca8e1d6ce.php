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
        color: #00aff0;
        
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
<div class="content-wrapper">
  <div class="header-spacer"></div>
  <!-- Stunning Header -->
  <div class="stunning-header stunning-header-bg-lightviolet">
    <div class="stunning-header-content">
        <h1 class="stunning-header-title">SiteMap</h1>
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="<?php echo e(route('front.home')); ?>">Home</a>
          <i class="seoicon-right-arrow"></i>
      </li>
      <li class="breadcrumbs-item active">
          <a href="">SiteMap</a>
          <i class="seoicon-right-arrow"></i>
      </li>
  </ul>
</div>
</div>



<div class="container">

 <div class="service_section service_content full-width-service">
    <div class="container">
        <h2><?php echo $cmsPageDetail->secondary_title; ?></h2>
        <div class="clear"></div>
        <?php echo $cmsPageDetail->long_description; ?>


        <?php 
        $getAll = false;
        $category = ALL_CATEGORY_LISTING($getAll);
        ?>
        <ul>
            <li class="main_menu"><a href="<?php echo e(route('front.home')); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;Home</a></li>
            <?php if(isset($headerSectionLink) && !$headerSectionLink->isEmpty()): ?>
            <?php $__currentLoopData = $headerSectionLink; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($v->id != \App\Models\Cms::SITE_MAP_CONSTANT): ?>
            <li class="main_menu"><a href="<?php echo e(route('front.cms.details',$v->slug)); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;<?php echo e($v->name); ?></a></li>

            <?php if($v->id == \App\Models\Cms::CONST_SERVICE_PAGE): ?>

            <?php $getAllService = getSingleCmsAppChildPages(\App\Models\Cms::CONST_SERVICE_PAGE); ?>

            <?php if(isset($getAllService) && $getAllService != null && !$getAllService->multipleCmsPage->isEmpty()): ?>
            <ul>
                <?php $__currentLoopData = $getAllService->multipleCmsPage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="sub_menu_site_map"><a href="<?php echo e(route('front.cms.details',$v->slug)); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;<?php echo e($v->name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php if(isset($category) && !$category->isEmpty()): ?>
            <li class="main_menu"><a href="<?php echo e(route('front.category.get_all_category')); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;Categories</a>
                <ul>
                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="sub_menu_site_map"><a href="<?php echo e(route('front.category.category_single',$v->slug)); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;<?php echo e($v->name); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
            <?php endif; ?>
        </ul>

    </div>
</div></div>
</div>

</div>
<?php echo $__env->make('layouts.flashmessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i1qxzjn7zpro/public_html/softtechover_phase_3/newlaunch/resources/views/front/pages/sitemap.blade.php ENDPATH**/ ?>