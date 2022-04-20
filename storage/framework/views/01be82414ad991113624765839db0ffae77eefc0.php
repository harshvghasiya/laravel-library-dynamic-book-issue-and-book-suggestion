<div class="vizew-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('front.home')); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($categoryDetail->name); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-7 col-lg-8">
        <?php if(isset($blogDataCategoryWise) && !$blogDataCategoryWise->isEmpty()): ?>
            <div class="all-posts-area">
                <?php $__currentLoopData = $blogDataCategoryWise; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="single-post-area mb-30">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-6">
                                <a  href="<?php echo e(route('front.blog.details',$blog->slug)); ?>">
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
                                    <p class="mb-2"><?php echo \Str::limit($blog->short_description, $limit = 150, $end = '...'); ?></p>
                                    <div class="post-meta d-flex align-items-center mb-2">
                                        <span>
                                            <i class="fa fa-user"></i> <strong><?php echo e($blog->createdBy->name); ?></strong>
                                           | <i class="fa fa-calendar"></i> <strong><?php echo e(date('M-d-Y',strtotime($blog->created_at))); ?>

                                            </strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div id="category_pagination_bottom">
                    <?php echo $blogDataCategoryWise->links(); ?>

                </div>    
            </div>
        <?php endif; ?>
    </div>
    <div class="col-12 col-md-5 col-lg-4">
        <?php if(isset($popularPost) && !$popularPost->isEmpty()): ?>
          <div class="single-widget youtube-channel-widget mb-50">
              <div class="section-heading style-2 mb-30">
                  <h4>Popular Posts</h4>
                  <div class="line"></div>
              </div>
              <div class="single-youtube-channel d-flex align-items-center">
                <ul class="recent_post_detail">
              <?php $__currentLoopData = $popularPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e(route('front.blog.details',$c->slug)); ?>" class="channel-title"><i class="fa fa-hand-o-right" style="font-size: 23px" aria-hidden="true"></i> <?php echo e($c->name); ?></a></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                </ul>
              </div>
          </div>
        <?php endif; ?>
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
        <?php if(isset($topSectionHighLight) && !$topSectionHighLight->isEmpty()): ?>
          <div class="single-widget youtube-channel-widget mb-50">
              <div class="section-heading style-2 mb-30">
                  <h4>Latest Posts</h4>
                  <div class="line"></div>
              </div>
              <div class="single-youtube-channel d-flex align-items-center">
                <ul class="recent_post_detail">
              <?php $__currentLoopData = $topSectionHighLight; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e(route('front.blog.details',$c->slug)); ?>" class="channel-title"><i class="fa fa-hand-o-right" style="font-size: 23px" aria-hidden="true"></i> <?php echo e($c->name); ?></a></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                </ul>
              </div>
          </div>
        <?php endif; ?>
    </div>
</div>
<hr>
 <div class="row">
    <div class="col-12 col-md-7 col-lg-8">
        <div class="vizew-post-author d-flex align-items-center" id="p_index">
          <div class="post-author-thumb">
              <img src="<?php echo e($settingData->getsettineAuthorImgDynamic()); ?>" alt="<?php echo e($settingData->author_name ? $settingData->author_name : ''); ?>">
          </div>
          <div class="post-author-desc pl-4">
              <a href="javascript:void(0)" class="author-name"><?php echo e($settingData->author_name ? $settingData->author_name : ""); ?></a>
              <p><?php echo e($settingData->author_description_two ? $settingData->author_description_two : ""); ?></p>
              <div class="post-author-social-info">
                  <?php if(isset($socialMediaContent) && !$socialMediaContent->isEmpty()): ?>
                      <?php $__currentLoopData = $socialMediaContent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <a target="_blank" href="<?php echo e($s->url); ?>"><i class="fa <?php echo e($s->font_awesome); ?>"></i></a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
              </div>
          </div>
        </div>
    </div>
</div>        <?php /**PATH C:\xampp\htdocs\softtechover\resources\views/front/category/blog/pagination_all_category_blog_listing.blade.php ENDPATH**/ ?>