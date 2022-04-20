<?php
$portfolio = \App\Models\Portfolio::with('category')->where('status',\App\Models\Portfolio::STATUS_ACTIVE)
->inRandomOrder()->get();
$PortfolioCategory = \App\Models\PortfolioCategory::with(['portfolio'])
->where('status',\App\Models\PortfolioCategory::STATUS_ACTIVE)
->has('portfolio')
->get();
?>
<div class="container">
  <div class="row medium-padding120">
    <div class="col-lg-12">
      <div class="heading align-center">
        <h4 class="h1 heading-title">Our Recent Works</h4>
      </div>
      <ul class="cat-list align-center sorting-menu">
        <li class="cat-list__item active" data-filter="*"><a href="#" class="">All Projects</a></li>
        <?php if(isset($PortfolioCategory) && !$PortfolioCategory->isEmpty()): ?>
        <?php $__currentLoopData = $PortfolioCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="cat-list__item" data-filter=".filter-<?php echo e($v->slug); ?>"><a href="#" class=""><?php echo e($v->name); ?></a></li>  
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </ul>
      <div class="row sorting-container" data-layout="fitRows">
        <div class="grid-sizer col-lg-4 col-md-4"></div>
        <?php $__currentLoopData = $portfolio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 sorting-item filter-<?php echo e($v->category->slug); ?>" style="position: absolute; left: 0%; top: 1081.59px;">
          <div class="case-item align-center mb60">
            <div class="case-item__thumb mouseover lightbox shadow animation-disabled">
              <a  <?php if($v->url != null): ?> target="_blank" href="<?php echo e($v->url); ?>" <?php else: ?> href="<?php echo e($v->getPortfolioImageUrl()); ?>" data-gall="portfolioGallery" class="venobox preview-link" <?php endif; ?> title="<?php echo e($v->title); ?>"><img src="<?php echo e($v->getPortfolioImageUrl()); ?>" alt="<?php echo e($v->title); ?>"></a>
            </div>
            <h6 class="case-item__title">
              <a target="_blank" <?php if($v->url !=null): ?> href="<?php echo e($v->url); ?>" <?php endif; ?>><?php echo e($v->title); ?></a>
            </h6>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
</div><?php /**PATH /home/i1qxzjn7zpro/public_html/softtechover_phase_3/newlaunch/resources/views/front/common/portfolio.blade.php ENDPATH**/ ?>