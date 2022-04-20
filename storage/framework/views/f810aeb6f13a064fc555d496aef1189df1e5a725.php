<?php $__env->startSection('content'); ?>
<div class="row margin-top-10">
	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_BANNER_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.banners.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
						<i class="fa fa-file-image-o" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.banner_dashboard_label')); ?></small>
					</div> 
					</div>
				</div>
			</a>
		</div>
	</div>
	<?php endif; ?>
	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_SOCIAL_MEDIA_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.social_medias.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-share-alt-square" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.social_media_label')); ?></small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<?php endif; ?>
	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CONTACT_US_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.contactus.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-phone-square" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.request_required')); ?></small>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	<?php endif; ?>

	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_NEWSLETTER_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.news-letter.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-paper-plane" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.news_letter_label_single')); ?></small>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	<?php endif; ?>

	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CATEGORY_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.category.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-list-alt" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.total_category')); ?></small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<?php endif; ?>
	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_SUB_CATEGORY_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.sub_category.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-tag" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.sub_category_label')); ?></small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<?php endif; ?>
	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_PRODUCT_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.product.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-list-alt" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.product_label')); ?></small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<?php endif; ?>

	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_BRAND_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.brand.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-btc" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.brand_label')); ?></small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<?php endif; ?>

	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_RIGHT_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.right.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-tasks" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.right')); ?></small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<?php endif; ?>
	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_ADMIN_USER_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.admin_user.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-users" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.admin_user')); ?></small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<?php endif; ?>

	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_BLOG_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.blogs.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-info-circle" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.blog_label')); ?></small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<?php endif; ?>


	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CMS_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.cms.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-database" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.pages_module_label')); ?></small>
						</div>
						
					</div>
				</div>
			</a>	
		</div>
	</div>
	<?php endif; ?>
	
	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CMS_MODULE_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.modules.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-mars-stroke-v" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.module_label')); ?></small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<?php endif; ?>

	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_SETTINNG_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.settings.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-gear"></i> <small><?php echo e(trans('lang_data.setting_label')); ?></small>
						</div>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<?php endif; ?>
	

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_ecommerce/Modules/Admin/Resources/views/dashboard.blade.php ENDPATH**/ ?>