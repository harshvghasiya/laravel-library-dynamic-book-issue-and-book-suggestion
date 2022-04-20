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
<div class="vizew-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('front.home')); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($cmsPageDetail->name); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="contact-area mb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-7 col-lg-8">
                <div class="section-heading style-2">
                    <h4><?php echo e($cmsPageDetail->name); ?></h4>
                    <div class="line"></div>
                </div>
                <div style="text-align: center;">
                    <?php echo $cmsPageDetail->short_description; ?>

                </div>
                <div class="contact-form-area mt-50">
                        <?php echo e(Form::open([
                          'id'=>'contactUsPage',
                          'class'=>'FromSubmit',
                          'url'=>route('front.contact_us.store'),
                          'data-redirect_url'=>route('front.cms.details',$cmsPageDetail->slug),
                          'name'=>'contactus',
                          'enctype'           =>"multipart/form-data"
                          ])); ?>

                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email*</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="message">Message*</label>
                            <textarea name="message" class="form-control" id="message" cols="30" rows="10"></textarea>
                        </div>
                        <button class="btn vizew-btn mt-30" type="submit">Send Now</button>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
            <div class="col-12 col-md-5 col-lg-4">
                <div class="sidebar-area">
                    <div class="single-widget newsletter-widget mb-50">
                        <div class="section-heading style-2 mb-30">
                            <h4>Newsletter</h4>
                            <div class="line"></div>
                        </div>
                        <p>Subscribe our newsletter gor get notification about new updates, information discount, etc.</p>
                        <div class="newsletter-form">
                            <?php echo e(Form::open([
                              'id'=>'NewsLetetrFormContactUsPage',
                              'class'=>'FromSubmit',
                              'url'=>route('front.news-letter.store'),
                              'data-redirect_url'=>route('front.cms.details',$cmsPageDetail->slug),
                              'name'=>'socialMedia',
                              'enctype'           =>"multipart/form-data"
                              ])); ?>

                            <input type="email" name="email" class="form-control mb-15" id="email" placeholder="Enter your email">
                            <button type="submit" class="btn vizew-btn w-100">Subscribe</button>
                            <?php echo e(Form::close()); ?>

                        </div>
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
    $("#NewsLetetrFormContactUsPage").validate({
        rules: {
            email: "required"},
        messages: {
            email: { required: "<?php echo e(trans('lang_data.please_enter_your_email_address_label')); ?>"}
        }
    });    
    $("#contactUsPage").validate({
        rules: {
            name: "required",
            email: "required",
            message: "required",
            
        },
        messages: {
            name: { required: "<?php echo e(trans('lang_data.name_required')); ?>"},
            email: { required: "<?php echo e(trans('lang_data.please_enter_your_email_address_label')); ?>"},
            message: { required: "<?php echo e(trans('lang_data.message_required')); ?>"},
        }
    });

  })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/softtechover/resources/views/front/contact/contact.blade.php ENDPATH**/ ?>