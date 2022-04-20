<?php
$categoryCount = \App\Models\Category::select('id','slug','name','display_on_header')
->where('status',\App\Models\Category::STATUS_ACTIVE)
->where('display_on_header',1)
->has("multipleCategoryStatus")
->withCount('multipleCategoryStatus')
->with(["multipleCategoryStatus"=>function($rd){
  $rd->where('status',1);
}])->get();
$recentBlog = \App\Models\Blog::select('id','slug','name','category_id','status','image')
->has('multipleBlogCategory')
->with(['multipleBlogCategory','createdBy'=>function($query){
  $query->select('id','name');
},'multipleBlogCategory.category'])
->whereHas('multipleBlogCategory',function($rc){
  $rc->whereHas('category',function($rcd){
    $rcd->select('id','slug','name','status')
    ->where('status',\App\Models\Category::STATUS_ACTIVE); 
  });
})
->where('status',1)
->orderBy('id','DESC')
->take(4)
->get();
$tag = \App\Models\Tag::where('status',1)->get();                                                                 
?>
<div class="col-lg-3 col-lg-offset-1 col-md-4 col-sm-12 col-xs-12">
  <aside aria-label="sidebar" class="sidebar sidebar-right">
    <div class="widget">
      <form class="w-search" action="<?php echo e(route('front.blog.search_post')); ?>" method="get">
        <?php if(Request::get('search') !=""): ?>
        <input class="email search input-standard-grey" name="search"  placeholder="Search" type="search" value="<?php echo e(Request::get('search')); ?>">
        <?php else: ?>
        <input class="email search input-standard-grey"  name="search"  placeholder="Search" type="search">
        <?php endif; ?>
        <button type="submit" class="icon">
          <i class="seoicon-loupe"></i>
        </button>
      </form>
    </div>
    <?php if(isset($categoryCount) && !$categoryCount->isEmpty()): ?>
    <div class="widget w-post-category">
      <div class="heading">
        <h4 class="heading-title">Categories</h4>
        <div class="heading-line">
          <span class="short-line"></span>
          <span class="long-line"></span>
        </div>
      </div>
      <div class="post-category-wrap">
        <?php $__currentLoopData = $categoryCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="category-post-item">
            <span class="post-count"><?php echo e($v->multiple_category_status_count); ?></span>
            <a href="<?php echo e(route('front.category.category_single',$v->slug)); ?>" class="category-title"><?php echo e($v->name); ?>

              <i class="seoicon-right-arrow"></i>
            </a>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
    <?php endif; ?>
    <?php if(isset($recentBlog) && !$recentBlog->isEmpty()): ?>
    <div class="widget w-latest-news">
      <div class="heading">
        <h4 class="heading-title">Recent Post</h4>
        <div class="heading-line">
          <span class="short-line"></span>
          <span class="long-line"></span>
        </div>
      </div>
      <div class="latest-news-wrap">
        <?php $__currentLoopData = $recentBlog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="latest-news-item">
            <div class="post-additional-info">
              <span class="post__date">
                <i class="seoicon-clock"></i>
                <time class="published" datetime="2016-04-23 12:00:00">
                  <?php echo e(date('M-d-Y',strtotime($v->created_at))); ?>

                </time>
              </span>
            </div>
          <div class="recent-posts" style="display:inline-block;">
           <img src="<?php echo e($v->getBlogImageUrl('thumbnail_')); ?>" class="post-item" alt="<?php echo e($v->name); ?>">
            <h5 class="post__title entry-title" style="padding:5px;">
              <a href="<?php echo e(route('front.blog.details',$v->slug)); ?>" style="font-size: small; font-weight: bold;"><?php echo e($v->name); ?></a>
            </h5>
          </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
    <?php endif; ?>
    <?php if(isset($tag) && !$tag->isEmpty()): ?>
      <div class="widget w-tags">
        <div class="heading">
          <h4 class="heading-title">Popular Tags</h4>
          <div class="heading-line">
            <span class="short-line"></span>
            <span class="long-line"></span>
          </div>
        </div>
        <div class="tags-wrap">
          <?php $__currentLoopData = $tag; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <a href="<?php echo e(route('front.tag.detail',$v->slug)); ?>" class="w-tags-item"><?php echo e($v->title); ?></a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    <?php endif; ?>
  </aside>
</div>
<?php /**PATH /home/i1qxzjn7zpro/public_html/softtechover_phase_3/newlaunch/resources/views/front/common/blog-sidebar.blade.php ENDPATH**/ ?>