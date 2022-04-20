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
<div class="content-wrapper">
    <div class="header-spacer"></div>
  <div class="stunning-header stunning-header-bg-olive">
    <div class="stunning-header-content">
      <h1 class="stunning-header-title">Portfolio</h1>
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="<?php echo e(route('front.home')); ?>">Home</a>
          <i class="seoicon-right-arrow"></i>
        </li>
        <li class="breadcrumbs-item active">
          <span href="#">Portfolio</span>
          <i class="seoicon-right-arrow"></i>
        </li>
      </ul>
    </div>
  </div>
  <div class="overlay_search">
    <div class="container">
      <div class="row">
        <div class="form_search-wrap">
          <form>
            <input class="overlay_search-input" placeholder="Type and hit Enter..." type="text">
            <a href="#" class="overlay_search-close">
              <span></span>
              <span></span>
            </a>
          </form>
        </div>
      </div>
    </div>
  </div>
 <?php echo $__env->make('front.common.portfolio', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\newlaunch\resources\views/front/portfolio/index.blade.php ENDPATH**/ ?>