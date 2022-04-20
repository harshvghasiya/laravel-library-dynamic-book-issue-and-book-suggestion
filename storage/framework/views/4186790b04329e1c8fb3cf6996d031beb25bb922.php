<?php $__env->startSection('title'); ?>
    <?php if(isset($title) && $title !=""): ?>
        <title><?php echo e($title); ?></title>
    <?php else: ?>
        <title><?php echo e(trans('lang_data.welcome_to_softtechover_com')); ?></title>
    <?php endif; ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="space_bottom"></div>
<section class="vizew-post-area mb-50">
    <div class="container">
       <div id="section_latest_post_home_page">
          <div class="row">
              <div class="col-12 col-md-7 col-lg-8">

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
                  <div id="latest_all_blog"></div>
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
              <div class="col-12 col-md-5 col-lg-4">
                  <div class="sidebar-area">
                    <?php if(isset($popularPost) && !$popularPost->isEmpty()): ?>
                        <div class="single-widget youtube-channel-widget mb-50">
                            <div class="section-heading style-2 mb-30">
                                <h4>Popular Posts</h4>
                                <div class="line"></div>
                            </div>
                            <div class="single-youtube-channel d-flex align-items-center">
                              <ul class="recent_post_detail">
                            <?php $__currentLoopData = $popularPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <li><a href="<?php echo e(route('front.blog.details',$c->slug)); ?>" class="channel-title"><i class="fa fa-hand-o-right" aria-hidden="true"></i> <?php echo e($c->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                              </ul>
                            </div>
                        </div>
                      <?php endif; ?>
                      <div class="single-widget p-0 author-widget">
                          <div class="p-4">
                              <img class="author-avatar" src="<?php echo e($settingData->getsettineAuthorImgDynamic()); ?>" alt="<?php echo e($settingData->author_name ? $settingData->author_name : ''); ?>">
                              <a href="javascript:void(0)" class="author-name"><?php echo e($settingData->author_name ? $settingData->author_name : ""); ?></a>
                              <div class="author-social-info">
                                  <?php if(isset($socialMediaContent) && !$socialMediaContent->isEmpty()): ?>
                                      <?php $__currentLoopData = $socialMediaContent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <a target="_blank" href="<?php echo e($s->url); ?>"><i class="fa <?php echo e($s->font_awesome); ?>"></i></a>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>
                              </div>
                              <p><?php echo e($settingData->author_description_one ? $settingData->author_description_one : ""); ?></p>
                          </div>
                      </div>
                      <div id="space_bottom"></div>
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
                            <li><a href="<?php echo e(route('front.blog.details',$c->slug)); ?>" class="channel-title"><i class="fa fa-hand-o-right" aria-hidden="true"></i> <?php echo e($c->name); ?></a></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                            </ul>
                          </div>
                      </div>
                    <?php endif; ?>
                  </div>
              </div>
          </div>
       </div>
    </div>
</section>
<?php echo $__env->make('layouts.flashmessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function(){

    $(document).on('click', '.pagination a', function(event){
      event.preventDefault(); 
      var page = $(this).attr('href').split('page=')[1];
      fetch_data(page);
      $('html, body').animate({scrollTop:585}, 'slow');
        
    });

    function fetch_data(page)
    {   
      var search = "<?php echo e(\Request::get('search')); ?>";
      var routeName =  "<?php echo e(\Request::route()->getName()); ?>"
      $.ajax({
       url:"<?php echo e(route('front.home.blog_ajax')); ?>?page="+page,
       data:{"_token": "<?php echo e(csrf_token()); ?>",search:search,routeName:routeName},
       success:function(data)
       {
        $('#latest_all_blog').html(data);
       }
      });
    }
    fetch_data(1)
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/softtechover/resources/views/home.blade.php ENDPATH**/ ?>