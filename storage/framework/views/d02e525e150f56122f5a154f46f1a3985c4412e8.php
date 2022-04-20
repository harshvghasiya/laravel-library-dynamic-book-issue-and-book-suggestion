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
	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_EMAIL_TEMPLATE_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.email-template.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-paper-plane-o" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.email_template_label')); ?></small>
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
							<i class="fa fa-phone-square" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.contactus_label')); ?></small>
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
	<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_ACL_MODULE)): ?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.acl.index')); ?>">
				<div class="display">
					<div class="number">
						<div class="icon">
							<i class="fa fa-file-image-o" aria-hidden="true"></i> <small><?php echo e(trans('lang_data.acl')); ?></small>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_admin_demo/Modules/Admin/Resources/views/dashboard.blade.php ENDPATH**/ ?>