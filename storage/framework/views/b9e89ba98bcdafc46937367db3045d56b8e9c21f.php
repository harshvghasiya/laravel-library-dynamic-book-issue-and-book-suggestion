<?php $__env->startSection('title'); ?>
<?php if(isset($title) && $title !=""): ?>
<title><?php echo e($title); ?> - <?php echo e(trans('lang_data.softtechover_com_label')); ?></title>
<?php else: ?>
<title><?php echo e(trans('lang_data.welcome_to_softtechover_com')); ?></title>
<?php endif; ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <div class="header-spacer"></div>
  <div class="stunning-header stunning-header-bg-gray">
    <div class="stunning-header-content">
      <h1 class="stunning-header-title "><?php echo e($cmsPageDetail->name); ?></h1>
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="<?php echo e(route('front.home')); ?>" class="c-gray">Home</a>
          <i class="seoicon-right-arrow"></i>
          <a href="<?php echo e(route('front.cms.details','services')); ?>" class="c-gray">Services</a>
          <i class="seoicon-right-arrow"></i>
        </li>
        <li class="breadcrumbs-item active">
          <span href="#" class="c-primary"><?php echo e($cmsPageDetail->name); ?></span>
          <i class="seoicon-right-arrow"></i>
        </li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="row medium-padding80 ">
     <div class="heading">
      <h4 class="h1 heading-title"><?php echo $cmsPageDetail->secondary_title; ?></h4>
      <div class="heading-line">
        <span class="short-line"></span>
        <span class="long-line"></span>
      </div>
    </div> 
  </div>
  <?php echo $cmsPageDetail->long_description; ?>  
</div>
<?php if($cmsPageDetail->id == \App\Models\Cms::CONST_LARAVEL_DEVELOPMENT): ?>
<div class="container">
  <div class="row sorting-container" data-layout="fitRows">
    <div class="grid-sizer col-lg-4 col-md-4"></div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 sorting-item  b2b smm technology">
      <div class="case-item align-center mb60">
        <h6 class="case-item__title">Laravel Js Validation</h6>
        <div class="case-item__cat">
         <p>The package has features that allow automatic form validation by reusing Laravel validation rules, messages, form requests and validators.</p>
       </div>
     </div>
   </div>
   <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 sorting-item b2b seo">
    <div class="case-item align-center mb60">
      <h6 class="case-item__title">Laravel Socialite</h6>
      <div class="case-item__cat">
       <p>Integrates social media into your websites including Facebook,Google+, Twitter, and LinkedIn</p>
     </div>
   </div>
 </div>
 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 sorting-item ecommerce seo smm">
  <div class="case-item align-center mb60">
    <h6 class="case-item__title">Laravel Debugbar</h6>
    <div class="case-item__cat">
      <p>Used during application development to keep track of the program variables and values.</p>
    </div>
  </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 sorting-item ecommerce seo smm">
  <div class="case-item align-center mb60">
    <h6 class="case-item__title">Laravel Dusk</h6>
    <div class="case-item__cat">
      <p>Enables the use of browser automation and a testing API very easily</p>
    </div>
  </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 sorting-item smm technology">
  <div class="case-item align-center mb60">
    <h6 class="case-item__title">Laravel Notification</h6>
    <div class="case-item__cat">
      <p>Allows to send notifications</p>
    </div>
  </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 sorting-item b2b smm technology">
  <div class="case-item align-center mb60">
    <h6 class="case-item__title">Laravel Get Text​</h6>
    <div class="case-item__cat">
     <p>If you are looking for localization i.e. presenting some text in a language of your choice, this feature is for you.</p>
   </div>
 </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 sorting-item b2b smm technology">
  <div class="case-item align-center mb60">
    <h6 class="case-item__title">Laravel Passport​</h6>
    <div class="case-item__cat">
      <p>Used for authentication purposes</p>
    </div>
  </div>
</div>    
</div>
</div>
<?php endif; ?>
</div>
<?php echo $__env->make('layouts.flashmessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i1qxzjn7zpro/public_html/softtechover_phase_3/newlaunch/resources/views/front/pages/detail_page.blade.php ENDPATH**/ ?>