<footer class="footer-area-content">
	<div class="container">
		<div class="footer-wrapper style-3">
			<div class="type-1">
				<div class="footer-columns-entry">
					<div class="row">
						<div class="col-md-3">
							<h3 class="column-title">NewsLetter</h3>
							<div class="footer-description">First Indian Scientific Online Shop</div>
							  <?php echo e(Form::open([
	                              'id'=>'NewsLetetrFormFooter',
	                              'class'=>'FromSubmit f_subscribe_two mailchimp',
	                              'url'=>route('front.news-letter.store'),
	                              'data-redirect_url'=>route('front.home'),
	                              'name'=>'socialMedia',
	                              'enctype'           =>"multipart/form-data"
	                            ])); ?>  
	                          <div class="email-c">
	                            <input type="email" name="email" class="form-control memail" placeholder="Email">
	                          </div>
	                          <div class="error" id="NewsLetetrFormFooter1"></div>
	                          <br>
	                          <button class="btn btn-primary btn-md btn_get btn_get_two" type="submit">Subscribe</button>
	                          <p class="mchimp-errmessage" style="display: none;"></p>
	                          <p class="mchimp-sucmessage" style="display: none;"></p>
	                        <?php echo e(Form::close()); ?>


							<div class="clear"></div>
						</div>
						<?php if(isset($footerInformation) && !$footerInformation->isEmpty()): ?>
							<div class="col-md-3 col-sm-4">
								<h3 class="column-title">Information</h3>
								<ul class="column">
									<?php $__currentLoopData = $footerInformation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($v->parent_id !=NULL): ?>
				                            <?php if($v->parent !=null): ?>
				                                <li><a href="<?php echo e(route('front.cms.details',$v->slug)); ?>"><?php echo e($v->name); ?></a></li>
				                            <?php endif; ?>
				                        <?php else: ?>
				                        <li><a href="<?php echo e(route('front.cms.details',$v->slug)); ?>"><?php echo e($v->name); ?></a></li>
				                        <?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
								<div class="clear"></div>
							</div>
						<?php endif; ?>

						<?php if(isset($footerExtra) && !$footerExtra->isEmpty()): ?>
						<div class="col-md-3 col-sm-4">
							<h3 class="column-title">Extras</h3>
							<ul class="column">
								<?php $__currentLoopData = $footerExtra; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($v->parent_id !=NULL): ?>
			                            <?php if($v->parent !=null): ?>
			                                <li><a href="<?php echo e(route('front.cms.details',$v->slug)); ?>"><?php echo e($v->name); ?></a></li>
			                            <?php endif; ?>
			                        <?php else: ?>
			                        <li><a href="<?php echo e(route('front.cms.details',$v->slug)); ?>"><?php echo e($v->name); ?></a></li>
			                        <?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
							<div class="clear"></div>
						</div>
						<?php endif; ?>

						<div class="clearfix visible-sm-block"></div>
						
						<div class="col-md-3 address_footer">
							<img alt="" src="<?php echo e($setting->getSettingLogoImageUrl()); ?>" class="footer-logo">
							 <?php echo $setting->address; ?>

							<div class="clear"></div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="footer-bottom footer-wrapper style-3">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="footer-bottom-navigation">
						<div class="cell-view">
							<div class="copyright">Created by <a target="_blank" href="https://softtechover.com/">Softtechover</a>  All right reserved © 2021</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/bootstrap.min.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/smoothscroll.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/jquery.scrollUp.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/menu.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/swiper/idangerous.swiper.min.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/swiper/swiper.custom.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/jquery.countdown.min.js"></script>
<script type="text/javascript" src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/jquery.nouislider.min.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/sidebar.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/owl.carousel.min.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/main.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/validation/jquery.validate.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/validation/additional-methods.js"></script>
<script type="text/javascript">
	
	if (jQuery().owlCarousel) {
		var productCarousel = $("#product-carousel");
		productCarousel.owlCarousel({
			loop: true,
			dots: false,
			responsive: {
				0: {
					items: 1
				},
				480: {
					items: 2
				},
				900: {
					items: 3
				},
				1100: {
					items: 4
				}
			}
		});

		// Custom Navigation Events
		$(".product-control-nav .next").on("click", function() {
			productCarousel.trigger('next.owl.carousel');
		});

		$(".product-control-nav .prev").on("click", function() {
			productCarousel.trigger('prev.owl.carousel');
		});
	}

	$('.tp-banner0').show().revolution({
		dottedOverlay: "none",
		delay: 5000,
		startWithSlide: 0,
		startwidth: 869,
		startheight: 520,
		hideThumbs: 10,
		hideTimerBar: "on",
		thumbWidth: 50,
		thumbHeight: 50,
		thumbAmount: 4,
		navigationType: "bullet",
		navigationArrows: "solo",
		navigationStyle: "round",
		touchenabled: "on",
		onHoverStop: "on",
		swipe_velocity: 0.7,
		swipe_min_touches: 1,
		swipe_max_touches: 1,
		drag_block_vertical: false,
		parallax: "mouse",
		parallaxBgFreeze: "on",
		parallaxLevels: [7, 4, 3, 2, 5, 4, 3, 2, 1, 0],
		keyboardNavigation: "off",
		navigationHAlign: "right",
		navigationVAlign: "bottom",
		navigationHOffset: 30,
		navigationVOffset: 30,
		soloArrowLeftHalign: "left",
		soloArrowLeftValign: "center",
		soloArrowLeftHOffset: 50,
		soloArrowLeftVOffset: 8,
		soloArrowRightHalign: "right",
		soloArrowRightValign: "center",
		soloArrowRightHOffset: 50,
		soloArrowRightVOffset: 8,
		shadow: 0,
		fullWidth: "on",
		fullScreen: "off",
		spinner: "spinner4",
		stopLoop: "on",
		stopAfterLoops: -1,
		stopAtSlide: -1,
		shuffle: "off",
		autoHeight: "off",
		forceFullWidth: "off",
		hideThumbsOnMobile: "off",
		hideNavDelayOnMobile: 1500,
		hideBulletsOnMobile: "off",
		hideArrowsOnMobile: "off",
		hideThumbsUnderResolution: 0,
		hideSliderAtLimit: 0,
		hideCaptionAtLimit: 500,
		hideAllCaptionAtLilmit: 500,
		videoJsPath: "rs-plugin/videojs/",
		fullScreenOffsetContainer: ""
	});
</script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/common.js"></script>
<script>
    $(document).ready(function(){
        $("#NewsLetetrFormFooter").validate({
            rules: {email: "required"},
            messages: {email: { required: "<?php echo e(trans('lang_data.please_enter_your_email_address_label')); ?>"}
            },
            errorPlacement: function(error, element) {
              $(element).closest('div').append(error);
            }
        });
    });
</script>

<script>
$(document).ready(function(){
    
    $("#contactUsPage").validate({
        rules: {
            name: {required:true,maxlength:30},
            company_name: {required:true,maxlength:30},
            email: {required:true,email:true},
            phone: {required:true,number:true,maxlength:12},
            message: {required:true,maxlength:300},
            
        },
        messages: {
            name: { required: "<?php echo e(trans('lang_data.name_required')); ?>"},
            company_name: { required: "<?php echo e(trans('lang_data.company_name_field_required')); ?>"},
            email: { required: "<?php echo e(trans('lang_data.please_enter_your_email_address_label')); ?>"},
            phone: { required: "<?php echo e(trans('lang_data.phone_number_field_required')); ?>"},
            message: { required: "<?php echo e(trans('lang_data.address_is_required')); ?>"},
        }
    });

  })
</script>

<?php /**PATH /var/www/html/laravel_ecommerce/resources/views/layouts/footer.blade.php ENDPATH**/ ?>