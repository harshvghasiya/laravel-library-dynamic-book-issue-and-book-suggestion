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
<div class="content-wrapper">
  <div class="header-spacer"></div>
  <div class="stunning-header stunning-header-bg-lightviolet">
    <div class="stunning-header-content">
      <h1 class="stunning-header-title"><?php echo \Str::limit($getBlogDetail->name, $limit = 25, $end = '...'); ?></h1>
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="<?php echo e(route('front.home')); ?>">Home</a>
          <i class="seoicon-right-arrow"></i>
        </li>
        <li class="breadcrumbs-item active">
          <a href="<?php echo e(route('front.blog.list')); ?>">Blog</a>
          <i class="seoicon-right-arrow"></i>
        </li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="row medium-padding120">
      <main class="main">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <article class="hentry post post-standard-details">
            <div class="post-thumb">
              <img src="<?php echo e($getBlogDetail->getBlogImageUrl()); ?>" alt="<?php echo e($getBlogDetail->name); ?>" alt="seo">
            </div>
            <div class="post__content">
              <h2 class="h2 post__title entry-title ">
                <a href="<?php echo e(route('front.blog.details',$getBlogDetail->slug)); ?>"><?php echo e($getBlogDetail->name); ?></a>
              </h2>
              <div class="post-additional-info">
                <div class="post__author author vcard">
                 <i class="icofont-user"></i>
                 Posted by
                 <div class="post__author-name fn">
                  <a href="<?php echo e(route('front.blog.details',$getBlogDetail->slug)); ?>" class="post__author-link"><?php echo e($getBlogDetail->createdBy->name); ?></a></div>
              </div>
              <span class="post__date">
                <i class="seoicon-clock"></i>
                <time class="published" datetime="2016-03-20 12:00:00">
                 <?php echo e(date('M-d-Y',strtotime($getBlogDetail->created_at))); ?>

               </time>
             </span>
              <?php if(!$getBlogDetail->multipleBlogCategory->isEmpty()): ?>
                <span class="category">
                  <i class="seoicon-tags"></i>
                  <?php $__currentLoopData = $getBlogDetail->multipleBlogCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <a href="<?php echo e(route('front.category.category_single',$v->category->slug)); ?>"><?php echo e($v->category->name); ?></a>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>
              <?php endif; ?>
            </div>
            <div class="post__content-info">
              <?php echo $getBlogDetail->short_description; ?>

              <?php echo $getBlogDetail->long_description; ?>

              <?php if($getBlogDetail->is_demo == 1 && $getBlogDetail->demo_url !=""): ?>   
                  <div>
                    <center>
                      <a href="<?php echo e($getBlogDetail->demo_url); ?>" target="_blank"><button class="btn btn-small btn--blue  btn-hover-shadow"><strong>View Demo</strong></button></a>
                    </center>
                  </div>
              <?php endif; ?>
            </div>
          </article>
      <div class="blog-details-author">
        <div class="blog-details-author-thumb">
          <img src="<?php echo e($settingData->getsettineAuthorImgDynamic()); ?>" class="authorimg"  alt="<?php echo e($settingData->author_name ? $settingData->author_name : ''); ?>">
        </div>
        <div class="blog-details-author-content">
          <div class="author-info">
            <h5 class="author-name"><?php echo e($settingData->author_name ? $settingData->author_name : ''); ?></h5>
            <p class="author-info">Author</p>
          </div>
            <?php if(isset($setting->author_description_one) && !empty($setting->author_description_one)): ?>
              <p class="text">
                <?php echo e($setting->author_description_one); ?>

              </p>
            <?php endif; ?>
        </div>
      </div>
      <div class="pagination-arrow">
        <?php if($nextPageUrl != null): ?>
        <a href="<?php echo e(route('front.blog.details',$nextPageUrl->slug)); ?>" class="btn-prev-wrap">
          <svg class="btn-prev">
            <use xlink:href="#arrow-left"></use>
          </svg>
          <div class="btn-content">
            <div class="btn-content-title">Previous Post</div>
            <p class="btn-content-subtitle"><?php echo \Str::limit($nextPageUrl->name, $limit = 25, $end = '...'); ?></p>
          </div>
        </a>
        <?php endif; ?>
        <?php if($prevPageUrl != null): ?>
        <a href="<?php echo e(route('front.blog.details',$prevPageUrl->slug)); ?>" class="btn-next-wrap">
          <div class="btn-content">
            <div class="btn-content-title">Next Post</div>
            <p class="btn-content-subtitle"><?php echo \Str::limit($prevPageUrl->name, $limit = 25, $end = '...'); ?></p>
          </div>
          <svg class="btn-next">
            <use xlink:href="#arrow-right"></use>
          </svg>
        </a>
        <?php endif; ?>
      </div>
    </div>
    <?php echo $__env->make('front.common.blog-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </main>
</div>
</div>
</div>
<script async src="https://platform-api.sharethis.com/js/sharethis.js#property=5ece7228606f5b0012eb58ed&product=sticky-share-buttons"></script>
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


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i1qxzjn7zpro/public_html/softtechover_phase_3/newlaunch/resources/views/front/blog/blog_detail.blade.php ENDPATH**/ ?>