<div class="vizew-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('front.home')); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php if(isset($data) && !$data->isEmpty()): ?>
<div id="divider"></div>
    <section class="trending-posts-area">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-md-4">
                        <div class="single-post-area mb-70">
                            <a href="<?php echo e(route('front.category.category_single',$c->slug)); ?>" title="<?php echo e($c->name); ?>">
                                <div class="post-thumbnail" id="category_listing">
                                    <img style="height: 225px; !important" src="<?php echo e($c->getCategoryImageUrl()); ?>" alt="<?php echo e($c->name); ?>">
                                    <span class="video-duration" id="category_count"><?php echo e($c->multiple_category_status_count); ?></span>
                                </div>
                            </a>
                            <div class="post-content">
                                <a href="<?php echo e(route('front.category.category_single',$c->slug)); ?>" class="post-cata cata-sm"><?php echo e($c->name); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            </div>
            <div id="category_pagination_bottom">
                <?php echo $data->links(); ?>

            </div>     
        </div>
    </section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\softtechover\resources\views/front/category/pagination_category_data.blade.php ENDPATH**/ ?>