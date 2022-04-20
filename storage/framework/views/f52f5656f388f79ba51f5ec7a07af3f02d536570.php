<?php $__env->startSection('title'); ?>
    <?php if(isset($title) && $title !=""): ?>
        <title><?php echo e($title); ?> - <?php echo e(trans('lang_data.softtechover_com_label')); ?></title>
    <?php else: ?>
        <title><?php echo e(trans('lang_data.welcome_to_softtechover_com')); ?></title>
    <?php endif; ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('metaData'); ?>
    <meta property="og:description" content="<?php echo e($getBlogDetail->seo_description); ?>" />
    <meta property="og:url" content="<?php echo e(\URL::current()); ?>" />
    <meta property="og:title" content="<?php echo e($getBlogDetail->seo_title); ?>" />
    <meta property="og:image:url" content="<?php echo e($getBlogDetail->getBlogImageUrl()); ?>" />
    <meta name="title" content="<?php echo e($getBlogDetail->seo_title); ?>"/>
    <meta name="description" content="<?php echo e($getBlogDetail->seo_description); ?>"/>
    <meta name="keywords" content="<?php echo e($getBlogDetail->seo_keyword); ?>"/>
    <link rel="canonical" href="<?php echo e(\URL::current()); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="divider"></div>

<div class="container">
     <div class="row justify-content-center">
        <div class="col-12">
            <div class="post-details-content">
                <div class="blog-content">
                    <div class="post-content mt-0">
                        <h1><?php echo e($getBlogDetail->name); ?></h1>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="post-details-area mb-80">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-12">    
                <div class="row">
                    <div class="col-12">
                        <div class="post-details-thumb mb-50">
                            <div class="d-flex justify-content-between mb-30">
                                <div class="post-meta align-items-center">
                                    <a href="#" class="post-author"> <i class="fa fa-user"></i> <?php echo e($getBlogDetail->createdBy->name); ?> </a><a href="#" class="post-date"><i class="fa fa-calendar"></i> <?php echo e(date('M-d-Y',strtotime($getBlogDetail->created_at))); ?> </a>
                                    <a href="#"><i class="fa fa-eye"></i> <?php echo e(thousandsCurrencyFormat($getBlogDetail->total_visitor)); ?> </a>
                                    <?php if(!$getBlogDetail->multipleBlogCategory->isEmpty()): ?>
                                      <div id="category_detail">
                                          Category: 
                                          <?php $__currentLoopData = $getBlogDetail->multipleBlogCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <a href="<?php echo e(route('front.category.category_single',$v->category->slug)); ?>" class="post-cata cata-sm"><?php echo e($v->category->name); ?></a>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <img src="<?php echo e($getBlogDetail->getBlogImageUrl()); ?>" alt="<?php echo e($getBlogDetail->name); ?>">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="post-details-content">
                            <div class="blog-content">

                               <?php echo $getBlogDetail->short_description; ?>


                               <?php echo $getBlogDetail->long_description; ?>

                               <?php if($getBlogDetail->is_demo == 1 && $getBlogDetail->demo_url !=""): ?>   
                                  <div class="soft-demo">
                                    <center>
                                      <a href="<?php echo e($getBlogDetail->demo_url); ?>" target="_blank"><button class="btn btn-primary"><strong>View Demo</strong></button></a>
                                    </center>
                                  </div>
                               <?php endif; ?>

                                <div class="vizew-post-author d-flex align-items-center" id="p_index">
                                    <div class="post-author-thumb">
                                        <img src="<?php echo e($settingData->getsettineAuthorImgDynamic()); ?>" alt="<?php echo e($settingData->author_name ? $settingData->author_name : ''); ?>">
                                    </div>
                                    <div class="post-author-desc pl-4">
                                        <a href="javascript:void(0)" class="author-name"><?php echo e($settingData->author_name ? $settingData->author_name : ''); ?></a>
                                        <p><?php echo e($settingData->author_description_one ? $settingData->author_description_one : ""); ?></p>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
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
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId=496195211181651&autoLogAppEvents=1">
</script>
<?php  
    $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>
<div class="fb-comments" data-href="<?php echo e($url); ?>" data-width="100%" data-numposts="5">
</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<link rel="stylesheet" href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/css/prism.css">
    <script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/prism.js"></script>
<script>
  var blog_id = "<?php echo e(\Crypt::encrypt($getBlogDetail->id)); ?>";
  $.ajax({
      type: 'post',
      url: '<?php echo e(route("front.blog.total_view_count")); ?>',
      data: {
       "_token": "<?php echo e(csrf_token()); ?>",blog_id:blog_id,
      },
      success: function (response) {

      }
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/softtechover/resources/views/front/category/blog/blog_detail.blade.php ENDPATH**/ ?>