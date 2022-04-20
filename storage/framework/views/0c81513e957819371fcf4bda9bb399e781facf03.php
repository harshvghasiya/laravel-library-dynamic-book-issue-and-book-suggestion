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
<div class="content-wrapper">
  <div class="header-spacer"></div>
  <div class="container-full-width">
    <div class="swiper-container main-slider" data-effect="fade" data-autoplay="4000">
      <div class="swiper-wrapper">
        <?php
        $color=['primary','green','orange','secondary'];
        ?>
        <?php if(!$ourTopWebDevelopmentSolution->multipleCmsPage->isEmpty()): ?>
        <?php $__currentLoopData = $ourTopWebDevelopmentSolution->multipleCmsPage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="swiper-slide bg-<?php echo e($color[$key]); ?>-color main-slider-bg-dark">
          <div class="container table">
            <div class="row table-cell">
              <div class="col-lg-6 table-cell">
                <div class="slider-content">
                  <h3 class="h1 slider-content-title c-dark" data-swiper-parallax="-100"><?php echo e($value->name); ?>

                  </h3>
                  <h5 class="slider-content-text" data-swiper-parallax="-200"><?php echo $value->short_description; ?>

                  </h5>
                  <div class="main-slider-btn-wrap" data-swiper-parallax="-300">        
                  </div>
                </div>
              </div>
              <div class="col-lg-6 table-cell">
                <div class="slider-thumb" data-swiper-parallax="-300" data-swiper-parallax-duration="500">
                  <img src="<?php echo e($value->getCmsImageUrl()); ?>" alt="slider">
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </div>
      <svg class="btn-next btn-next-black">
        <use xlink:href="#arrow-right"></use>
      </svg>
      <svg class="btn-prev btn-prev-black">
        <use xlink:href="#arrow-left"></use>
      </svg>
      <div class="slider-slides">
       <?php if(!$ourTopWebDevelopmentSolution->multipleCmsPage->isEmpty()): ?>
       <?php $__currentLoopData = $ourTopWebDevelopmentSolution->multipleCmsPage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <a href="#" class="slides-item  bg-<?php echo e($color[$key]); ?>-color">
        <div class="content">
          <div class="text-wrap">
            <h4 class="slides-title"><?php echo e($value->name); ?></h4>
          </div>
          <div class="slides-number">0<?php echo e($key); ?></div>
        </div>
      </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php echo $__env->make('front.common.we-working-on', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container-fluid">
  <div class="row pt80">
    <div class="testimonial-slider scrollme">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 col-lg-offset-1 col-md-8 col-sm-12 col-xs-12">
            <div class="testimonial-item">
              <div class="swiper-container testimonial__thumb overflow-visible" data-effect="fade" data-loop="false">
                <div class="swiper-wrapper">
                  <div class="testimonial-slider-item swiper-slide">
                    <div class="testimonial-content">
                      <h2 class="text" data-swiper-parallax="-200">Why Choose Softechover ??</h2>
                      <p class="text" data-swiper-parallax="-200">Top Indian Web Design and Development Services Company,
                      </p>
                      <a href="<?php echo e(route('front.home')); ?>" class="author" data-swiper-parallax="-150">SofttechOver</a>
                    </div>
                    <div class="avatar" data-swiper-parallax="-50">
                      <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/avatar.png" alt="avatar">
                    </div>
                  </div>
                  <div class="testimonial-slider-item swiper-slide">
                    <div class="testimonial-content">
                      <p class="text" data-swiper-parallax="-200">Providing Web Solutions at Affordable Cost
                        In the advanced era of technology, it’s very vital to generate online presence to stay ahead in the business market,
                      </p>
                      <a href="<?php echo e(route('front.home')); ?>" class="author" data-swiper-parallax="-150">SofttechOver</a>
                    </div>
                    <div class="avatar" data-swiper-parallax="-50">
                      <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/avatar.png" alt="avatar">
                    </div>
                  </div>
                  <div class="testimonial-slider-item swiper-slide">
                    <div class="testimonial-content">
                      <p class="text" data-swiper-parallax="-200">For this purpose, having an eye-catching and SEO friendly business website is very crucial. The reason is that it is one of the best methods to promote your company’s products and services online,
                      </p>
                      <a href="<?php echo e(route('front.home')); ?>" class="author" data-swiper-parallax="-150">SofttechOver</a>
                    </div>
                    <div class="avatar" data-swiper-parallax="-50">
                      <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/avatar.png" alt="avatar">
                    </div>
                  </div>
                  <div class="testimonial-slider-item swiper-slide">
                    <div class="testimonial-content">
                      <p class="text" data-swiper-parallax="-200"> This can be accomplished by getting a website developed that features those products and services. We are a design and development company having clients located all over the globe.
                      </p>
                      <a href="<?php echo e(route('front.home')); ?>" class="author" data-swiper-parallax="-150">SofttechOver</a>
                    </div>
                    <div class="avatar" data-swiper-parallax="-50">
                      <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/avatar.png" alt="avatar">
                    </div>
                  </div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="quote">
                  <i class="seoicon-quotes"></i>
                </div>
              </div>
              <div class="testimonial__thumb-img">
                <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/testimonial1.png" alt="image">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php if(isset($bestWebDevelopmentCompany) && $bestWebDevelopmentCompany !=null): ?>
<div class="container-fluid background-mountains  scrollme">
 <div class="images">
  <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/mountain1.png" alt="mountain">
  <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/mountain2.png" alt="mountain">
</div>
<div class="container">
  <div class="row pt100">
    <div class="col-lg-12">
      <div class="heading">
        <h4 class="h2 heading-title"><?php echo e($bestWebDevelopmentCompany->name); ?></h4>
        <div class="heading-line">
          <span class="short-line"></span>
          <span class="long-line"></span>
        </div>
        <p class="heading-text"><?php echo $bestWebDevelopmentCompany->long_description; ?>

        </p>
      </div>
    </div>
  </div>
</div>
</div>
<?php endif; ?>
<div class="container-fluid">
  <div class="row">
    <div class="background-mountains medium-padding120 scrollme">
      <div class="images">
        <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/mountain1.png" alt="mountain">
        <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/mountain2.png" alt="mountain">
      </div>
      <div class="container">
        <div class="row">
         <?php if(isset($clientIndustry) && $clientIndustry !=null): ?>
         <div class="col-md-offset-2 col-sm-12 col-xs-12">
          <div class="heading align-center">
            <h4 class="h1 heading-title"><?php echo e($clientIndustry->name); ?></h4>
            <div class="heading-line">
              <span class="short-line"></span>
              <span class="long-line"></span>
            </div>
            <p class="heading-text"> 
              <?php if(!empty($clientIndustry->short_description)): ?>
              <?php echo $clientIndustry->short_description; ?>

              <?php endif; ?>
              <?php if(!empty($clientIndustry->long_description)): ?>
              <?php echo $clientIndustry->long_description; ?> 
              <?php endif; ?>
            </p>
          </div>
        </div>
        <?php endif; ?>
      </div>
      <div class="row">
        <?php if(!$clientIndustry->multipleCmsPage->isEmpty()): ?>
        <?php $__currentLoopData = $clientIndustry->multipleCmsPage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="info-box--standard-centered client_box">
            <div class="info-box-image">
              <img src="<?php echo e($v->getCmsImageUrl()); ?>" class="client_icon"  alt="<?php echo e($v->name); ?>">
            </div>
          </div>
          <h4 class="info-box-title client_title"><?php echo e($v->name); ?></h4>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
</div>
<div class="container-fluid">
  <div class="row bg-green-color">
    <div class="container">
     <?php if(isset($wecreatedMoreThan) && $wecreatedMoreThan !=null): ?>
     <h3  style="color: #fffafa;" class="mt60">We've created more than <span>25+ Websites and Apps</span> in past year!
      <?php if(!empty($wecreatedMoreThan->long_description)): ?>
      <?php echo $wecreatedMoreThan->long_description; ?></h3>
      <?php endif; ?>
      <?php endif; ?>
      <div class="row">
        <div class="counters">
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="counter-item">
              <div class="counter-numbers counter">
                <span data-speed="2000" data-refresh-interval="3" data-to="96" data-from="2">96%</span>
                <div class="units">%</div>
              </div>
              <span class="counter-title">Client Retention</span>
              <div class="counter-line">
                <span class="short-line"></span>
                <span class="long-line"></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="counter-item">
              <div class="counter-numbers counter">
                <span data-speed="2000" data-refresh-interval="3" data-to="10" data-from="0">10</span>
              </div>
              <span class="counter-title">Years of Service</span>
              <div class="counter-line">
                <span class="short-line"></span>
                <span class="long-line"></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="counter-item">
              <div class="counter-numbers counter">
                <span data-speed="2000" data-refresh-interval="3" data-to="70" data-from="2">230+</span>
                <div class="units">+</div>
              </div>
              <span class="counter-title">Professionals</span>
              <div class="counter-line">
                <span class="short-line"></span>
                <span class="long-line"></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="counter-item">
              <div class="counter-numbers counter">
                <span data-speed="2000" data-refresh-interval="3" data-to="690" data-from="400">690+</span>
                <div class="units">+</div>
              </div>
              <span class="counter-title">Satisfied Clients</span>
              <div class="counter-line">
                <span class="short-line"></span>
                <span class="long-line"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row medium-padding80">
    <div class="recent-case align-center">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
            <div class="heading align-center">
              <h4 class="h1 heading-title">Our Recent Works</h4>
              <div class="heading-line">
                <span class="short-line"></span>
                <span class="long-line"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="case-item-wrap">
            <?php $__currentLoopData = $portfolio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="case-item">
                <div class="case-item__thumb">
                  <a <?php if($v->url != null): ?> target="_blank" href="<?php echo e($v->url); ?>" <?php else: ?> href="<?php echo e($v->getPortfolioImageUrl()); ?>" data-gall="portfolioGallery" class="venobox preview-link" <?php endif; ?> title="<?php echo e($v->title); ?>"><img src="<?php echo e($v->getPortfolioImageUrl()); ?>" alt="<?php echo e($v->title); ?>"></a>
                </div>
                <h6 class="case-item__title"><a <?php if($v->url !=null): ?> href="<?php echo e($v->url); ?>" <?php endif; ?>><?php echo e($v->title); ?></a>
                </h6>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
        <a href="<?php echo e(route('front.get_port_folio_all')); ?>" class="btn btn-medium btn--dark">
          <span class="text">All Projects</span>
          <span class="semicircle"></span>
        </a>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row medium-padding80 ">
    <div class="recent-case align-center">
      <?php if(isset($homePageBox) && $homePageBox !=null): ?>
      <?php if(!$homePageBox->multipleCmsPage->isEmpty()): ?>
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
          <div class="heading align-center">
            <h4 class="h1 heading-title"><?php echo e($homePageBox->name); ?></h4>
            <div class="heading-line">
              <span class="short-line"></span>
              <span class="long-line"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <?php $img=[20,21,22] ?>
        <?php $__currentLoopData = $homePageBox->multipleCmsPage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-4 col-sm-12 col-sx-12">
          <div class="info-box--standard">
            <div class="info-box-image f-none">
              <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/info-box<?php echo e($img[$key]); ?>.png" alt="image">
            </div>
            <div class="info-box-content">
              <h5 class="info-box-title"><?php echo e($v->name); ?></h5>
              <p class="text"><?php echo $v->short_description; ?>

              </p>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i1qxzjn7zpro/public_html/softtechover_phase_3/newlaunch/resources/views/home.blade.php ENDPATH**/ ?>