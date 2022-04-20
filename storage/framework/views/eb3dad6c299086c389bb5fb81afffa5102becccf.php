<?php $__env->startSection('content'); ?>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(trans('lang_data.home_label')); ?></a><i class="fa fa-circle"></i>
	</li>
	<li class="active">
		 <?php echo e(trans('lang_data.dashboard_label')); ?>

	</li>
</ul>
<div class="row margin-top-10">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.banners.index')); ?>">
				<div class="display">
					<div class="number">
						<h3 class="font-green-sharp"><?php echo e($count['banner']); ?></h3>
						<small><?php echo e(trans('lang_data.banner_dashboard_label')); ?></small>
					</div>
					<div class="icon">
						<i class="fa fa-file-image-o" aria-hidden="true"></i>
					</div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.email-template.index')); ?>">
				<div class="display">
					<div class="number">
						<h3 class="font-red-haze"><?php echo e($count['email']); ?></h3>
						<small><?php echo e(trans('lang_data.email_template_label')); ?></small>
					</div>
					<div class="icon">
						<i class="fa fa-paper-plane-o" aria-hidden="true"></i>
					</div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.social_medias.index')); ?>">
				<div class="display">
					<div class="number">
						<h3 class="font-blue-sharp"><?php echo e($count['social']); ?></h3>
						<small><?php echo e(trans('lang_data.social_media_label')); ?></small>
					</div>
					<div class="icon">
						<i class="fa fa-share-alt-square" aria-hidden="true"></i>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.contactus.index')); ?>">
				<div class="display">
					<div class="number">
						<h3 class="font-purple-soft"><?php echo e($count['contact_us']); ?></h3>
						<small><?php echo e(trans('lang_data.contactus_label')); ?></small>
					</div>
					<div class="icon">
						<i class="fa fa-phone-square" aria-hidden="true"></i>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>
<div class="row margin-top-10">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.category.index')); ?>">
				<div class="display">
					<div class="number">
						<h3 class="font-green-sharp"><?php echo e($count['category']); ?></h3>
						<small><?php echo e(trans('lang_data.total_category')); ?></small>
					</div>
					<div class="icon">
						<i class="fa fa-list-alt" aria-hidden="true"></i>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.cms.index')); ?>">
				<div class="display">
					<div class="number">
						<h3 class="font-red-haze"><?php echo e($count['cms']); ?></h3>
						<small><?php echo e(trans('lang_data.pages_module_label')); ?></small>
					</div>
					<div class="icon">
						<i class="fa fa-database" aria-hidden="true"></i>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.news-letter.index')); ?>">
				<div class="display">
					<div class="number">
						<h3 class="font-blue-sharp"><?php echo e($count['newsLetter']); ?></h3>
						<small><?php echo e(trans('lang_data.news_letter_label_single')); ?></small>
					</div>
					<div class="icon">
						<i class="fa fa-paper-plane" aria-hidden="true"></i>
					</div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.settings.index')); ?>">
				<div class="display">
					<div class="number">
						<h3 class="font-purple-soft"><?php echo e($count['setting']); ?></h3>
						<small><?php echo e(trans('lang_data.setting_label')); ?></small>
					</div>
					<div class="icon">
						<i class="fa fa-gear"></i>
					</div>
				</div>
			</a>	
		</div>
	</div>
</div>
<div class="row margin-top-10">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.blogs.index')); ?>">
				<div class="display">
					<div class="number">
						<h3 class="font-green-sharp"><?php echo e($count['blog']); ?></h3>
						<small><?php echo e(trans('lang_data.blog_label')); ?></small>
					</div>
					<div class="icon">
						<i class="fa fa-info-circle" aria-hidden="true"></i>
					</div>
				</div>
			</a>	
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<a href="<?php echo e(route('admin.modules.index')); ?>">
				<div class="display">
					<div class="number">
						<h3 class="font-red-haze"><?php echo e($count['module']); ?></h3>
						<small><?php echo e(trans('lang_data.module_label')); ?></small>
					</div>
					<div class="icon">
						<i class="fa fa-mars-stroke-v" aria-hidden="true"></i>
					</div>
				</div>
			</a>	
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\softtechover\Modules/Admin\Resources/views/dashboard.blade.php ENDPATH**/ ?>