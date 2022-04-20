<div class="page-header navbar navbar-fixed-top">
	<div class="page-header-inner">
		<div class="page-logo">
			<a href="<?php echo e(route('admin.dashboard')); ?>">
			<p class="logo-default" style="font-size: 24px">Seramic Design</p>
			<!-- <img src="<?php echo e($setting->getSettingLogoImageUrl()); ?>" style="width: 141px;height: 101px" alt="logo" class="logo-default"/> -->
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
						<img alt="" class="img-circle" src="<?php echo e($setting->getsettineAuthorImgDynamic()); ?>"/>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="<?php echo e(route('admin.settings.index')); ?>">
								<i class="icon-user"></i> Setting </a>
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
</div><?php /**PATH C:\xampp\htdocs\softtechover\Modules/Admin\Resources/views/layouts/header.blade.php ENDPATH**/ ?>