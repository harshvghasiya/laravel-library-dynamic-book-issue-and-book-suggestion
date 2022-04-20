<?php if(isset($blogList) && !$blogList->isEmpty()): ?>
 <div class="all-posts-area">
    <div class="section-heading style-2">
        <?php if(isset($searchKeyword) && $searchKeyword !=""): ?>
            <h4>Your search result for <span class="search-result">'<?php echo e($searchKeyword); ?>'</span></h4>
        <?php elseif(isset($routeDemo) && $routeDemo == true): ?>
            <h4>Demo Post</h4>    
        <?php else: ?>
            <h4>Latest Post</h4>
        <?php endif; ?>
        <div class="line"></div>
    </div>
    <?php $__currentLoopData = $blogList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="single-post-area mb-30">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <a href="<?php echo e(route('front.blog.details',$blog->slug)); ?>">
                        <div class="post-thumbnail">
                            <img style="height: 225px;width: 400px" src="<?php echo e($blog->getBlogImageUrl()); ?>" alt="<?php echo e($blog->name); ?>">
                            <span class="video-duration"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo e(thousandsCurrencyFormat($blog->total_visitor)); ?></span>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="post-content mt-0">
                        <?php if(isset($blog->multipleBlogCategory) && !$blog->multipleBlogCategory->isEmpty()): ?>
                            <?php $__currentLoopData = $blog->multipleBlogCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2=>$v2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($v2->category) && $v2->category !=null): ?>
                                    <a href="<?php echo e(route('front.category.category_single',$v2->category->slug)); ?>" class="post-cata cata-sm" ><?php echo e($v2->category->name); ?></a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <a href="<?php echo e(route('front.blog.details',$blog->slug)); ?>" class="post-title mb-2"><?php echo e($blog->name); ?></a>
                        <p class="mb-2"><?php echo \Str::limit($blog->short_description, $limit = 225, $end = '...'); ?></p>
                        <div class="post-meta d-flex align-items-center mb-2">
                            <span>
                                <i class="fa fa-user"></i> <?php echo e($blog->createdBy->name); ?>

                               | <i class="fa fa-calendar"></i> <?php echo e(date('M-d-Y',strtotime($blog->created_at))); ?>

                                
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div id="category_pagination_bottom">
        <?php echo $blogList->links(); ?>

    </div>    
</div>
<?php endif; ?><?php /**PATH /var/www/html/softtechover/resources/views/front/home/pagination_latest_blog.blade.php ENDPATH**/ ?>