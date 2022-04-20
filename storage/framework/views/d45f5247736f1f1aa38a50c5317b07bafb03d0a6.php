<footer class="footer-area">
    <div class="container">
        <div class="row">
            <?php if(isset($cmsPages) && !$cmsPages->isEmpty()): ?>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="footer-widget mb-70">
                        <h6 class="widget-title">About Us</h6>
                            <div class="single--twitter-slide">
                               <div class="td">
                                    <ul>
                                        <?php $__currentLoopData = $cmsPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(route('front.cms.details',$v->slug)); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;<?php echo e($v->name); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(isset($categoryFooter) && !$categoryFooter->isEmpty()): ?>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="footer-widget mb-70">
                        <h6 class="widget-title">Category</h6>
                        <div class="single-blog-post d-flex">
                            <div class="td">
                                    <ul>
                                    <?php $__currentLoopData = $categoryFooter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(route('front.category.category_single',$c->slug)); ?>"><i class="fa fa-angle-right"></i> &nbsp;<?php echo e($c->name); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="footer-widget mb-70">
                    <h6 class="widget-title">Find Us</h6>
                    <div class="contact-address">
                         <?php echo $settingData->address; ?>

                    </div>
                    <?php if(isset($socialMediaContent) && !$socialMediaContent->isEmpty()): ?>
                        <div class="footer-social-area">
                            <?php $__currentLoopData = $socialMediaContent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a target="_blank" class="<?php echo e(strtolower(str_replace('fa-','',$s->font_awesome))); ?>" href="<?php echo e($s->url); ?>"><i class="fa <?php echo e($s->font_awesome); ?>"></i></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="footer-widget mb-70">
                    <h6 class="widget-title">Newsletter</h6>
                    <div class="footer-nl-area">
                        <?php echo e(Form::open([
                              'id'=>'NewsLetetrFormFooter',
                              'class'=>'FromSubmit',
                              'url'=>route('front.news-letter.store'),
                              'data-redirect_url'=>route('front.home'),
                              'name'=>'socialMedia',
                              'enctype'           =>"multipart/form-data"
                            ])); ?>

                            <input type="email" name="email" class="form-control" id="email_footer" placeholder="Your email">
                            <button type="submit" id="btn">Send <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copywrite-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-6">
                    <p class="copywrite-text">
                        Copyright &copy;
                        <script>document.write(new Date().getFullYear());</script> 
                        All rights reserved | Design and Develop by <strong>Chirag Ghevariya</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/mix/js/all.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/common.js"></script>
<script>
$(document).ready(function(){
    $("#NewsLetetrFormFooter").validate({
        rules: {email: "required"},
        messages: {email: { required: "<?php echo e(trans('lang_data.please_enter_your_email_address_label')); ?>"}
        }
    });
});

$(document).ready(function() {
    
    setTimeout(function(){
        $('body').addClass('loaded');
        $('h1').css('color','#222222');
    }, 3000);
    
});
</script>


<?php /**PATH C:\xampp\htdocs\softtechover\resources\views/layouts/footer.blade.php ENDPATH**/ ?>