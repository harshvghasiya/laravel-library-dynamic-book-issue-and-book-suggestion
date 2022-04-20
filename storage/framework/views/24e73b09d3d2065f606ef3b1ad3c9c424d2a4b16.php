<?php $__env->startSection('title'); ?>
    <?php if(isset($title) && $title !=""): ?>
        <title><?php echo e($title); ?> - <?php echo e(trans('lang_data.softtechover_com_label')); ?></title>
    <?php else: ?>
        <title><?php echo e(trans('lang_data.welcome_to_softtechover_com')); ?></title>
    <?php endif; ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('metaData'); ?>
    <meta property="og:description" content="<?php echo e($product->seo_description); ?>" />
    <meta property="og:url" content="<?php echo e(\URL::current()); ?>" />
    <meta property="og:title" content="<?php echo e($product->seo_title); ?>" />
    <meta name="title" content="<?php echo e($product->seo_title); ?>"/>
    <meta name="description" content="<?php echo e($product->seo_description); ?>"/>
    <meta name="keywords" content="<?php echo e($product->seo_keyword); ?>"/>
    <link rel="canonical" href="<?php echo e(\URL::current()); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
	section.product_content_area.pt-40 {
	    margin-top: 30px;
	}
	table {
	  font-family: arial, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	td, th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

	tr:nth-child(even) {
	  background-color: #dddddd;
	}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/css/flexslider.css">

<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=6060bb7bf6067000116b08dd&product=inline-share-buttons" async="async"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="clearfix"></div>
<section class="product_content_area pt-40">
	<div class="lookcare-product-single container">
		<div class="row">
			<div class="main col-xs-12" role="main">
				<div class=" product">
					<div class="row">
						
						<?php if(isset($product->images) && !$product->images->isEmpty()): ?>

							<div class="col-md-5 col-sm-6 summary-before ">
								<div class="product-slider product-shop">
									<ul class="slides">
										
										<?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

											<li data-thumb="<?php echo e($v->getProductImageUrl('thumbnail_')); ?>">
												<a href="<?php echo e($v->getProductImageUrl()); ?>" data-imagelightbox="gallery" class="hoodie_7_front">
													<img src="<?php echo e($v->getProductImageUrl()); ?>" class="attachment-shop_single product_list_img_detail" alt="<?php echo e($product->name); ?>">
												</a>
											</li>

										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		
									</ul>
								</div>
							</div>

						<?php endif; ?>
						<div class="col-sm-6 col-md-7 product-review entry-summary">
							<h1 class="product_title"><?php echo e($product->name); ?></h1>
							<?php if(!empty($product->short_description)): ?>
								<p>
									<?php echo $product->short_description; ?>

								</p>
							<?php endif; ?>
							<div class="product_meta">
								<?php if(!empty($product->brand) && !empty($product->brand_id)): ?>
								<span class="sku_wrapper">Brand: <span class="sku"><?php echo e($product->brand->name); ?></span></span>
								<?php endif; ?>
								<?php if(!empty($product->sku)): ?>
								<span class="sku_wrapper">SKU: <span class="sku"><?php echo e($product->sku); ?></span></span>
								<?php endif; ?>
								<?php if(!empty($product->hsn_code)): ?>
								<span class="sku_wrapper">HSN Code: <span class="sku"><?php echo e($product->hsn_code); ?></span></span>
								<?php endif; ?>
								<?php if(!empty($product->product_code)): ?>
								<span class="sku_wrapper">Product Code: <span class="sku"><?php echo e($product->product_code); ?></span></span>
								<?php endif; ?>
								<?php if(!empty($product->availability)): ?>
								<span class="sku_wrapper">Availability: <span class="sku"><?php echo e($product->availability); ?></span></span>
								<?php endif; ?>
								<?php if(!empty($product->country) &&  !empty($product->country_id)): ?>
								<span class="sku_wrapper">County of Origin: <span class="sku"><?php echo e($product->country->name); ?></span></span>
								<?php endif; ?>
								<?php if(!empty($product->speak_to_expert)): ?>
								<span class="sku_wrapper expert_call">Speak to our Expert:<span class="sku expert_call_size">  <i class="fa fa-phone color"></i> <a href="tel:<?php echo e($product->speak_to_expert); ?>"><?php echo e($product->speak_to_expert); ?></a></span></span>
								<?php endif; ?>
								<?php if(!empty($product->getProductAttachmentUrl())): ?>
								<span class="sku_wrapper expert_call">Attachment:<span class="sku de_attachemnt"> <a href="<?php echo e($product->getProductAttachmentUrl()); ?>" target="_blank"><i class="fa fa-paperclip color" aria-hidden="true"></i> View</a></span></span>
								<?php endif; ?>
							</div>
							<div class="share-social-icons">
								<div class="sharethis-inline-share-buttons"></div>
							</div>
						</div>
					</div>
					<div class="wrapper-description">
						<ul class="tabs-nav clearfix">
							<li class="active">Description</li>
							<li>Technical Specification</li>
							<li>Video</li>
						</ul>
						<div class="tabs-container product-comments">
							<div class="tab-content">
								<section class="related-products">
									<?php if(!empty($product->description)): ?>
										<?php echo $product->description; ?>

									<?php endif; ?>
								</section>
							</div>
							<div class="tab-content">
								<div class="panel entry-content">
									<div class="tab-content">
										<section class="related-products">
											<div class="col-md-10">
												<?php if(!empty($product->technical_description)): ?>
													<?php echo $product->technical_description; ?>

												<?php endif; ?>
												<table>
												  <tr>
												    <td>Alfreds Futterkiste</td>
												    <td>Maria Anders</td>
												</tr>
												</table>
											</div>
										</section>		
									</div>
								</div>
							</div>
							<div class="tab-content">
								<div class="panel entry-content-video">
									<?php if(!empty($product->video_link)): ?>
										<?php echo $product->video_link; ?>

									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="clearfix"></div>
<?php echo $__env->make('layouts.flashmessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/flexslider/jquery.flexslider-min.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/image-lightbox/imagelightbox.js"></script>
<script type="text/javascript">
	/*-----------------------------------------------------------------------------------*/
	/* Flex Slider
	 /*-----------------------------------------------------------------------------------*/
	if (jQuery().flexslider) {

		// Product Page Flex Slider
		$('.product-slider').flexslider({
			animation: "slide",
			animationLoop: false,
			slideshow: false,
			prevText: '<i class="fa fa-angle-left"></i>',
			nextText: '<i class="fa fa-angle-right"></i>',
			animationSpeed: 250,
			controlNav: "thumbnails"
		});
	}
	/*-----------------------------------------------------------------------------------*/
	/* Product Carousel
	 /*-----------------------------------------------------------------------------------*/
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
	/*-----------------------------------------------------------------------------------*/
	/* Tabs
	 /*-----------------------------------------------------------------------------------*/
	$(function() {
		var $tabsNav = $('.tabs-nav'),
				$tabsNavLis = $tabsNav.children('li');

		$tabsNav.each(function() {
			var $this = $(this);
			$this.next().children('.tab-content').stop(true, true).hide()
					.first().show();
			$this.children('li').first().addClass('active').stop(true, true).show();
		});

		$tabsNavLis.on('click', function(e) {
			var $this = $(this);
			$this.siblings().removeClass('active').end()
					.addClass('active');
			var idx = $this.parent().children().index($this);
			$this.parent().next().children('.tab-content').stop(true, true).hide().eq(idx).fadeIn();
			e.preventDefault();
		});

	});
	/*-----------------------------------------------------------------------------------*/
	/*	Tabs Widget
	 /*-----------------------------------------------------------------------------------*/
	$('.footer .tabbed .tabs li:first-child, .tabbed .tabs li:first-child').addClass('current');
	$('.footer .block:first, .tabbed .block:first').addClass('current');


	$('.tabbed .tabs li').on("click", function() {
		var $this = $(this);
		var tabNumber = $this.index();

		/* remove current class from other tabs and assign to this one */
		$this.siblings('li').removeClass('current');
		$this.addClass('current');

		/* remove current class from current block and assign to related one */
		$this.parent('ul').siblings('.block').removeClass('current');
		$this.closest('.tabbed').children('.block:eq(' + tabNumber + ')').addClass('current');
	});
	/*-----------------------------------------------------------------------------------*/
	/*	Image Lightbox
	 /*  http://osvaldas.info/image-lightbox-responsive-touch-friendly
	 /*-----------------------------------------------------------------------------------*/
	if (jQuery().imageLightbox) {

		// ACTIVITY INDICATOR

		var activityIndicatorOn = function() {
					$('<div id="imagelightbox-loading"><div></div></div>').appendTo('body');
				},
				activityIndicatorOff = function() {
					$('#imagelightbox-loading').remove();
				},


		// OVERLAY

				overlayOn = function() {
					$('<div id="imagelightbox-overlay"></div>').appendTo('body');
				},
				overlayOff = function() {
					$('#imagelightbox-overlay').remove();
				},


		// CLOSE BUTTON

				closeButtonOn = function(instance) {
					$('<button type="button" id="imagelightbox-close" title="Close"></button>').appendTo('body').on('click touchend', function() {
						$(this).remove();
						instance.quitImageLightbox();
						return false;
					});
				},
				closeButtonOff = function() {
					$('#imagelightbox-close').remove();
				},

		// ARROWS

				arrowsOn = function(instance, selector) {
					var $arrows = $('<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"></button>');

					$arrows.appendTo('body');

					$arrows.on('click touchend', function(e) {
						e.preventDefault();

						var $this = $(this),
								$target = $(selector + '[href="' + $('#imagelightbox').attr('src') + '"]'),
								index = $target.index(selector);

						if ($this.hasClass('imagelightbox-arrow-left')) {
							index = index - 1;
							if (!$(selector).eq(index).length)
								index = $(selector).length;
						} else {
							index = index + 1;
							if (!$(selector).eq(index).length)
								index = 0;
						}

						instance.switchImageLightbox(index);
						return false;
					});
				},
				arrowsOff = function() {
					$('.imagelightbox-arrow').remove();
				};

		// Lightbox for individual image
		var lightboxInstance = $('a[data-imagelightbox="lightbox"]').imageLightbox({
			onStart: function() {
				overlayOn();
				closeButtonOn(lightboxInstance);
			},
			onEnd: function() {
				closeButtonOff();
				overlayOff();
				activityIndicatorOff();
			},
			onLoadStart: function() {
				activityIndicatorOn();
			},
			onLoadEnd: function() {
				activityIndicatorOff();
			}
		});

		// Lightbox for product gallery
		var gallerySelector = 'a[data-imagelightbox="gallery"]';
		var galleryInstance = $(gallerySelector).imageLightbox({
			quitOnDocClick: false,
			onStart: function() {
				overlayOn();
				closeButtonOn(galleryInstance);
				arrowsOn(galleryInstance, gallerySelector);
			},
			onEnd: function() {
				overlayOff();
				closeButtonOff();
				arrowsOff();
				activityIndicatorOff();
			},
			onLoadStart: function() {
				activityIndicatorOn();
			},
			onLoadEnd: function() {
				activityIndicatorOff();
				$('.imagelightbox-arrow').css('display', 'block');
			}
		});
	}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_ecommerce/resources/views/front/product/detail.blade.php ENDPATH**/ ?>