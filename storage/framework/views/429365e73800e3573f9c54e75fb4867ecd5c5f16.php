<?php $__env->startSection('title'); ?>
    <?php if(isset($title) && $title !=""): ?>
        <title><?php echo e($title); ?> - <?php echo e(trans('lang_data.softtechover_com_label')); ?></title>
    <?php else: ?>
        <title><?php echo e(trans('lang_data.welcome_to_softtechover_com')); ?></title>
    <?php endif; ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="vizew-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
               <?php if(isset($categoryListing) && !$categoryListing->isEmpty()): ?>
                      <div class="single-widget youtube-channel-widget mb-50">
                          <div class="section-heading style-2 mb-30">
                              <h4>Categories</h4>
                              <div class="line"></div>
                          </div>
                          <div class="single-youtube-channel d-flex align-items-center">
                            <ul>
                          <?php $__currentLoopData = $categoryListing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <li><a href="<?php echo e(route('front.category.category_single',$c->slug)); ?>" class="channel-title"><?php echo e($c->name); ?> <span><?php echo e($c->multiple_category_status_count); ?></span></a></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                            </ul>
                          </div>
                      </div>
                  <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/softtechover/resources/views/front/category/all_category_listing.blade.php ENDPATH**/ ?>