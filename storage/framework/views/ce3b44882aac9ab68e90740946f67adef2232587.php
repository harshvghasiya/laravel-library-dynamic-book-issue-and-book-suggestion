 <?php 
 $technology = \App\Models\Technology::where('status',\App\Models\Technology::STATUS_ACTIVE)->get();
 ?> 
 <?php if(isset($technology) && !$technology->isEmpty()): ?>
 <div class="container-fluid info-boxes pt100">
  <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
    <div class="heading align-center">
      <h4 class="h2 heading-title"><?php echo e($ourMostPopularWebPlatFrom->name); ?></h4>
      <div class="heading-line">
        <span class="short-line"></span>
        <span class="long-line"></span>
      </div>
      <p class="heading-text"> 
       <?php if(!empty($ourMostPopularWebPlatFrom->short_description)): ?>
       <?php echo $ourMostPopularWebPlatFrom->short_description; ?>

       <?php endif; ?>
     </p>
   </div>
 </div>
 <div class="container">
  <div class="row">
    <?php $__currentLoopData = $technology; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!empty($v->font_icon)): ?>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <div class="info-box--standard" data-mh="info-boxes" style="display: flex;">
        <div class="info-box-image">
          <i class="<?php echo e($v->font_icon); ?> dev_iconnn" title="<?php echo e($v->title); ?>"></i>
        </div>
        <div class="info-box-content">
          <h6 class="info-box-title" style="font-weight: bold;"><?php echo e($v->title); ?></h6>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>
</div>
<?php endif; ?><?php /**PATH C:\laragon\www\newlaunch\resources\views/front/common/we-working-on.blade.php ENDPATH**/ ?>