<?php if(isset($blogList) && !$blogList->isEmpty()): ?>
<?php $__currentLoopData = $blogList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<article class="hentry post post-standard has-post-thumbnail sticky">
  <div class="post-thumb">
    <img src="<?php echo e($blog->getBlogImageUrl('medium_')); ?>" alt="<?php echo e($blog->name); ?>" alt="seo">
    <div class="overlay"></div>
    <a href="<?php echo e($blog->getBlogImageUrl('medium_')); ?>"  class="link-image js-zoom-image">
      <i class="seoicon-zoom"></i>
    </a>
    <a href="<?php echo e(route('front.blog.details',$blog->slug)); ?>" class="link-post">
      <i class="seoicon-link-bold"></i>
    </a>
  </div>
  <div class="post__content">
    <div class="post__author author vcard">
      <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/avatar6.png" alt="author">
      Posted by
      <div class="post__author-name fn">
        <a href="#" class="post__author-link"><?php echo e($blog->createdBy->name); ?></a>
      </div>
    </div>
    <div class="post__content-info">
      <h2 class="post__title entry-title ">
        <a href="<?php echo e(route('front.blog.details',$blog->slug)); ?>"><?php echo e($blog->name); ?></a>
      </h2>
      <div class="post-additional-info">
        <span class="post__date">
          <i class="seoicon-clock"></i>
          <time class="published" datetime="2016-04-17 12:00:00">
           <?php echo e(date('M-d-Y',strtotime($blog->created_at))); ?>

         </time>
       </span>
       <span class="category">
        <i class="seoicon-tags"></i>
        <?php if(!$blog->multipleBlogCategory->isEmpty()): ?>
        <?php $__currentLoopData = $blog->multipleBlogCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('front.category.category_single',$v->category->slug)); ?>" class="post-cata cata-sm"><?php echo e($v->category->name); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </span>
    </div>
    <p class="post__text">
      <?php echo \Str::limit($blog->short_description, $limit = 225, $end = '...'); ?>

    </p>
    <a href="<?php echo e(route('front.blog.details',$blog->slug)); ?>" class="btn btn-small btn--dark btn-hover-shadow">
      <span class="text">Continue Reading</span>
      <i class="seoicon-right-arrow"></i>
    </a>
  </div>
</div>
</article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <div class="blog-pagination">
    <?php echo $blogList->links(); ?>

  </div>
  </div>
  <?php else: ?>
  <h3 class="data_not_found">Data not found !!</h3>    
  <?php endif; ?>
<?php /**PATH /home/i1qxzjn7zpro/public_html/softtechover_phase_3/newlaunch/resources/views/front/category/pagination_single_category_all_blog.blade.php ENDPATH**/ ?>