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
<section id="content-block" class="slider_area">
	<div class="container">
		<div class="content-push">
			<div class="row">

				<div class="col-md-3 col-md-push-9">
					<?php if(isset($sidebarCategory) && !$sidebarCategory->isEmpty()): ?>

						<div class="sidebar-navigation">
							<div class="title">Product Categories<i class="fa fa-angle-down"></i></div>
							<div class="list">
								<aside class="sidebar">
									<div class="widget category-widget">

										<ul id="category-widget">

											
											<?php $__currentLoopData = $sidebarCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

												<li><a href="<?php echo e(route('front.category.index',$v->slug)); ?>"><?php echo e($v->name); ?>


													<span class="category-widget-btn"></span></a>
													<ul>
														
														<?php if(isset($v->subCategory) && !$v->subCategory->isEmpty()): ?>
															<?php $__currentLoopData = $v->subCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2=>$v2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																
																<li><a href="<?php echo e(route('front.category.sub_category',$v2->slug)); ?>"><?php echo e($v2->name); ?></a></li>

															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														<?php endif; ?>
													</ul>
												</li>

											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

											
										</ul>
									</div>
								</aside>
							</div>
						</div>
					<?php endif; ?>
					<div class="clear"></div>

					<?php echo $__env->make('front.common._request_catalog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

				</div>

				<div class="col-md-9 col-md-pull-3">

					<div class="header_slider">
						<article class="boss_slider">
							<div class="tp-banner-container">
								<div class="tp-banner tp-banner0">
									<ul>
										
										<?php if(isset($banners) && !$banners->isEmpty()): ?>

											<?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

												<li data-link="javascript:void(0)" data-target="_self" data-transition="flyin" data-slotamount="7" data-masterspeed="500" data-saveperformance="on">
													<img src="<?php echo e($v->getBannerImageUrl('thumbnail_')); ?>" alt="slidebg1" data-lazyload="<?php echo e($v->getBannerImageUrl('thumbnail_')); ?>" data-bgposition="left center" data-kenburns="off" data-duration="14000" data-ease="Linear.easeNone" data-bgpositionend="right center" />
												</li>

											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

										<?php else: ?>

											<li data-link="javascript:void(0)" data-target="_self" data-transition="flyin" data-slotamount="7" data-masterspeed="500" data-saveperformance="on">
												<img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/dummy.png" alt="slidebg1" data-lazyload="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/slide/slider1.png" data-bgposition="left center" data-kenburns="off" data-duration="14000" data-ease="Linear.easeNone" data-bgpositionend="right center" />
											</li>

										<?php endif; ?>

									</ul>
									<div class="slideshow_control"></div>
								</div>
							</div>
						</article>
					</div>

					<div class="clear"></div>

				</div>

			</div>
		</div>
	</div>
</section>

<?php if(isset($featureProduct) && !$featureProduct->isEmpty()): ?>
<section id="popular-product" class="ecommerce">
	<div class="container">
		<div class="shopping-content">
			<div class="block-heading-two">
				<h3><span>Featured Products</span></h3>
			</div>
			<div class="row">
				<?php $__currentLoopData = $featureProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

					<div class="col-md-3 col-sm-6">
						<div class="shopping-item">
							<a href="<?php echo e(route('front.product.detail',$v->slug)); ?>"><img class="img-responsive" src="<?php echo e($v->getProductImageUrl('thumbnail_')); ?>" alt="" /></a>
							<h4><a title="<?php echo e($v->name); ?>" href="<?php echo e(route('front.product.detail',$v->slug)); ?>"><?php echo e(WORD_LIMIT($v->name,45)); ?></a></h4>
							<div class="clearfix"></div>
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<?php 

	$homePageCategoryProduct = \App\Models\SubCategory::with(['products'=>function($query){

														$query->select('id','name','slug','status','category_id')
															  ->where('status',\App\Models\Product::STATUS_ACTIVE)
															  ->inRandomOrder()
															  ->limit(4);
													}])
													->where('id',$setting->category_id)
	                                            ->where('status',\App\Models\Product::STATUS_ACTIVE)
	                                            ->whereHas('category',function($query){

	                                                $query->select('id','category_id','status')
	                                                      ->where('status',\App\Models\Category::STATUS_ACTIVE);
	                                                      
	                                            })
	                                            ->has('products')
	                                            ->first();    


?>
<?php if(isset($homePageCategoryProduct) && !empty($homePageCategoryProduct)): ?>
<section id="popular-product" class="ecommerce">
	<div class="container">
		<div class="shopping-content">
			<div class="block-heading-two">
				<h3><span><?php echo e($homePageCategoryProduct->name); ?></span></h3>
			</div>
			<div class="row">
				<?php $__currentLoopData = $homePageCategoryProduct->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

					<div class="col-md-3 col-sm-6">
						<div class="shopping-item">
							<a href="<?php echo e(route('front.product.detail',$v->slug)); ?>"><img class="img-responsive" src="<?php echo e($v->getProductImageUrl('thumbnail_')); ?>" alt="" /></a>
							<h4><a title="<?php echo e($v->name); ?>" href="<?php echo e(route('front.product.detail',$v->slug)); ?>"><?php echo e(WORD_LIMIT($v->name,45)); ?></a></h4>
							<div class="clearfix"></div>
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php if(isset($latestProduct) && !$latestProduct->isEmpty()): ?>
<section id="popular-product" class="ecommerce">
	<div class="container">
		<div class="shopping-content">
			<div class="block-heading-two">
				<h3><span>Latest Products</span></h3>
			</div>
			<div class="row">
				<?php $__currentLoopData = $latestProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-md-3 col-sm-6">
						<div class="shopping-item">
							<a href="<?php echo e(route('front.product.detail',$v->slug)); ?>"><img class="img-responsive" src="<?php echo e($v->getProductImageUrl('thumbnail_')); ?>" alt="" /></a>
							<h4>
								<a title="<?php echo e($v->name); ?>" href="<?php echo e(route('front.product.detail',$v->slug)); ?>">
								<?php echo e(WORD_LIMIT($v->name,45)); ?>

								</a>
							</h4>
							<div class="clearfix"></div>
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>


<?php echo $__env->make('layouts.flashmessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_ecommerce/resources/views/home.blade.php ENDPATH**/ ?>