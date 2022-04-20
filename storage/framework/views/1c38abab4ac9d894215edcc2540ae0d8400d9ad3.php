<?php if(isset($popularSection) && !$popularSection->isEmpty()): ?>
<div id="divider"></div>
    <section class="trending-posts-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h4>Popular Post</h4>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $popularSection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-md-4">
                        <div class="single-post-area mb-80">
                            <a href="<?php echo e(route('front.blog.details',$blog->slug)); ?>">
                                <div class="post-thumbnail">
                                    <img style="height: 225px; !important;width: 340px" src="<?php echo e($blog->getBlogImageUrl()); ?>" alt="<?php echo e($blog->name); ?>">
                                    <span class="video-duration"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo e(thousandsCurrencyFormat($blog->total_visitor)); ?></span>
                                </div>
                            </a>
                            <div class="post-content">
                                <a href="<?php echo e(route('front.category.category_single',$blog->category->slug)); ?>" class="post-cata cata-sm"><?php echo e($blog->category->name); ?></a>
                                <a href="<?php echo e(route('front.blog.details',$blog->slug)); ?>" class="post-title">
                                    <?php echo \Str::limit($blog->name, $limit = 70, $end = '...'); ?>

                                  </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\softtechover\resources\views/front/home/popular_post.blade.php ENDPATH**/ ?>