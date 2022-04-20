<?php $__env->startSection('title'); ?>
<?php if(isset($title) && $title !=""): ?>
<title><?php echo e($title); ?> - <?php echo e(trans('lang_data.softtechover_com_label')); ?></title>
<?php else: ?>
<title><?php echo e(trans('lang_data.welcome_to_softtechover_com')); ?></title>
<?php endif; ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if(isset($getAllService) && $getAllService != null && !$getAllService->multipleCmsPage->isEmpty()): ?>
<div class="content-wrapper">
  <div class="header-spacer"></div>
  <div class="stunning-header stunning-header-bg-rose">
    <div class="stunning-header-content">
      <h1 class="stunning-header-title">Services</h1>
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="<?php echo e(route('front.home')); ?>">Home</a>
          <i class="seoicon-right-arrow"></i>
        </li>
        <li class="breadcrumbs-item active">
          <span href="#">Services</span>
          <i class="seoicon-right-arrow"></i>
        </li>
      </ul>
    </div>
  </div>
  <?php $__currentLoopData = $getAllService->multipleCmsPage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php 
  $lastKey = $getAllService->multipleCmsPage->reverse()->keys()->first();
  if (!empty($v->secondary_title)) {
    $title = $v->secondary_title;
  }else{
    $title = $v->name;
  }
  if ($lastKey == $key) {
    $lastkeyClass ='padding-botton-service'; 
  }else{
    $lastkeyClass ="";
  }
  ?>
  <?php if($key%2 == 0): ?>
  <div class="container <?php if($key != 0): ?> second_service <?php endif; ?>">
    <div class="row <?php if($key == 0): ?> pt120 <?php endif; ?> pb30">
      <div class="col-lg-12">
        <div class="product-description-challenge">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="product-description-thumb">
                <img src="<?php echo e($v->getCmsImageUrl()); ?>" alt="<?php echo e($title); ?>" class="shadow-image">
              </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
              <div class="product-description-content">
                <div class="heading">
                  <h4 class="h1 heading-title"><?php echo e($title); ?></h4>
                  <div class="heading-line">
                    <span class="short-line"></span>
                    <span class="long-line"></span>
                  </div>
                  <p> <?php echo \Str::limit($v->short_description, $limit = 450, $end = '...'); ?>

                  </p>
                  <p><a class="read_style" href="<?php echo e(route('front.cms.details',$v->slug)); ?>" >Read More</a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="product-description-border"></div>
        </div>
      </div>
    </div>
  </div>
  <?php else: ?>
  <div class="container">
    <div class="row pt80 pb120">
      <div class="col-lg-12">
        <div class="product-description-solution">
          <div class="row">
            <div class="col-lg-5 col-lg-offset-1 col-md-5 col-md-offset-1 col-sm-12 col-xs-12">
              <div class="product-description-content">
                <div class="heading">
                  <h4 class="h1 heading-title"><?php echo e($title); ?></h4>
                  <div class="heading-line">
                    <span class="short-line"></span>
                    <span class="long-line"></span>
                  </div>
                  <p><?php echo \Str::limit($v->short_description, $limit = 450, $end = '...'); ?>

                  </p>
                  <p><a class="read_style" href="<?php echo e(route('front.cms.details',$v->slug)); ?>">Read More</a></p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="product-description-thumb">
                <img src="<?php echo e($v->getCmsImageUrl()); ?>" alt="<?php echo e($title); ?>" class="shadow-image">
              </div>
            </div>
          </div>
          <div class="product-description-border"></div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i1qxzjn7zpro/public_html/softtechover_phase_3/newlaunch/resources/views/front/pages/services.blade.php ENDPATH**/ ?>