 <div class="stunning-header stunning-header-bg-violet">
    <div class="stunning-header-content">
      <h1 class="stunning-header-title"><?php echo e($cmsPageDetail->name); ?></h1>
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="<?php echo e(route('front.home')); ?>">Home</a>
          <i class="seoicon-right-arrow"></i>
        </li>
        <li class="breadcrumbs-item active">
          <span href="#"><?php echo e($cmsPageDetail->name); ?></span>
          <i class="seoicon-right-arrow"></i>
        </li>
      </ul>
    </div>
  </div>
  <div class="overlay_search">
    <div class="container">
      <div class="row">
        <div class="form_search-wrap">
          <form>
            <input class="overlay_search-input" placeholder="Type and hit Enter..." type="text">
            <a href="#" class="overlay_search-close">
              <span></span>
              <span></span>
            </a>
          </form>
        </div>
      </div>
    </div>
  </div><?php /**PATH C:\laragon\www\newlaunch\resources\views/front/pages/common_banner_section.blade.php ENDPATH**/ ?>