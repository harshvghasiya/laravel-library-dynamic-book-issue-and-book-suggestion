<div class="page-header navbar navbar-fixed-top">
	<div class="page-header-inner">
		<div class="page-logo">
			<a href="<?php echo e(route('admin.dashboard')); ?>">
			<p class="logo-default" style="font-size: 24px"><?php echo e(trans('lang_data.app_name')); ?></p>
			</a>
			<div class="menu-toggler sidebar-toggler">
			</div>
		</div>
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<div class="page-top">
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<li class="separator hide">
					</li>
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username username-hide-on-mobile">
						<?php echo e(\Auth::user()->name); ?> </span>
						<img alt="<?php echo e(\Auth::user()->name); ?>" class="img-circle" src="<?php echo e(\Auth::user()->getAdminUserImageUrl()); ?>"/>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="<?php echo e(route('admin.settings.index')); ?>">
								<i class="icon-user"></i> Setting </a>
							</li>
							<li>
								<a href="<?php echo e(route('admin.profile.edit_user_profile',\Crypt::encrypt(\Auth::user()->id))); ?>">
								<i class="icon-user"></i> Edit Profile </a>
							</li>
							<li>
								<a href="<?php echo e(route('admin.logout')); ?>">
								<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="clearfix">
</div><?php /**PATH /var/www/html/softtechover/Modules/Admin/Resources/views/layouts/header.blade.php ENDPATH**/ ?>