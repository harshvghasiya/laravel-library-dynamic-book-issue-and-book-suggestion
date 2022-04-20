<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">	
			<?php 
				if (\Request()->route()->getName() == 'admin.dashboard') {
					$dashboard ='active'; 	
				}else{
					$dashboard = "";	
				}
			?>
			<li class="start <?php echo e($dashboard); ?>">
				<a href="<?php echo e(route('admin.dashboard')); ?>">
				<i class="icon-home"></i>
				<span class="title"><?php echo e(trans('lang_data.dashboard_label')); ?></span>
				</a>
			</li>
			<?php 
				if (
					\Request()->route()->getName() == 'admin.banners.index' || 
					\Request()->route()->getName() == 'admin.banners.create' || 
					\Request()->route()->getName() == 'admin.banners.edit' || 
					\Request()->route()->getName() == 'admin.email-template.index' || 
					\Request()->route()->getName() == 'admin.email-template.create' || 
					\Request()->route()->getName() == 'admin.email-template.edit' || 
					\Request()->route()->getName() == 'admin.social_medias.index' || 
					\Request()->route()->getName() == 'admin.social_medias.create' || 
					\Request()->route()->getName() == 'admin.social_medias.edit' ||
					\Request()->route()->getName() == 'admin.contactus.index' || 
					\Request()->route()->getName() == 'admin.contactus.create' || 
					\Request()->route()->getName() == 'admin.contactus.edit' ||
					\Request()->route()->getName() == 'admin.news-letter.index' || 
					\Request()->route()->getName() == 'admin.news-letter.create' || 
					\Request()->route()->getName() == 'admin.news-letter.edit'
					) {
					$commonModule ='class=open'; 
					$commonModuleBlock ="block"; 
				}else{
					$commonModule = "";
					$commonModuleBlock = "none";
				}
			?>

			<?php if( CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_BANNER_MODULE) || 
				 CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_EMAIL_TEMPLATE_MODULE) || 
				 CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_SOCIAL_MEDIA_MODULE) || 
				 CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CONTACT_US_MODULE) || 
				 CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_NEWSLETTER_MODULE) 
				): ?>
			<li <?php echo e($commonModule); ?>>
				<a href="javascript:;">
				<i class="fa fa-share-alt-square" aria-hidden="true"></i>
				<span class="title"><?php echo e(trans('lang_data.common_modules_label')); ?></span>
				<span class="arrow "></span>
				</a>
				<ul class="sub-menu" style="display: <?php echo e($commonModuleBlock); ?>;">
					<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_BANNER_MODULE)): ?>
					<li <?php if(\Request()->route()->getName() == 'admin.banners.index' || \Request()->route()->getName() == 'admin.banners.create' || \Request()->route()->getName() == 'admin.banners.edit'): ?>  class="active"  <?php endif; ?>><a href="<?php echo e(route('admin.banners.index')); ?>">Banner</a></li>
					<?php endif; ?>

					<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_EMAIL_TEMPLATE_MODULE)): ?>
					<li <?php if(\Request()->route()->getName() == 'admin.email-template.index' || \Request()->route()->getName() == 'admin.email-template.create' || \Request()->route()->getName() == 'admin.email-template.edit'): ?>  class="active"  <?php endif; ?>><a href="<?php echo e(route('admin.email-template.index')); ?>"><?php echo e(trans('lang_data.email_template_label')); ?></a></li>
					<?php endif; ?>

					<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_SOCIAL_MEDIA_MODULE)): ?>
					<li <?php if(\Request()->route()->getName() == 'admin.social_medias.index' || \Request()->route()->getName() == 'admin.social_medias.create' || \Request()->route()->getName() == 'admin.social_medias.edit'): ?>  class="active"  <?php endif; ?>><a href="<?php echo e(route('admin.social_medias.index')); ?>"><?php echo e(trans('lang_data.social_media_management_label')); ?></a></li>
					<?php endif; ?>

					<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CONTACT_US_MODULE)): ?>
					<li <?php if(\Request()->route()->getName() == 'admin.contactus.index' || \Request()->route()->getName() == 'admin.contactus.create' || \Request()->route()->getName() == 'admin.contactus.edit'): ?>  class="active"  <?php endif; ?>><a href="<?php echo e(route('admin.contactus.index')); ?>"><?php echo e(trans('lang_data.contactus_label')); ?></a></li>
					<?php endif; ?>

					<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_NEWSLETTER_MODULE)): ?>
					<li <?php if(\Request()->route()->getName() == 'admin.news-letter.index' || \Request()->route()->getName() == 'admin.news-letter.create' || \Request()->route()->getName() == 'admin.news-letter.edit'): ?>  class="active"  <?php endif; ?>><a href="<?php echo e(route('admin.news-letter.index')); ?>"><?php echo e(trans('lang_data.news_letter_label_single')); ?></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>
			<?php 

				if (
					\Request()->route()->getName() == 'admin.category.index' || 
					\Request()->route()->getName() == 'admin.category.create' || 
					\Request()->route()->getName() == 'admin.category.edit' 

					) 
				{
					$commonModule ='class=open'; 
					$commonModuleBlock ="block"; 
				}else{
					$commonModule = "";
					$commonModuleBlock = "none";
				}
			?>

			<?php if( CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CATEGORY_MODULE)): ?>
			<li <?php echo e($commonModule); ?>>
				<a href="javascript:;">
				<i class="fa fa-list-alt" aria-hidden="true"></i>
				<span class="title"><?php echo e(trans('lang_data.category_management_label')); ?></span>
				<span class="arrow "></span>
				</a>
				<ul class="sub-menu" style="display: <?php echo e($commonModuleBlock); ?>;">
					<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CATEGORY_MODULE)): ?>
					<li <?php if(\Request()->route()->getName() == 'admin.category.index' || \Request()->route()->getName() == 'admin.category.create' || \Request()->route()->getName() == 'admin.category.edit'): ?>  class="active"  <?php endif; ?>><a href="<?php echo e(route('admin.category.index')); ?>"><?php echo e(trans('lang_data.category_label')); ?></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>
			<?php 

				if (
					\Request()->route()->getName() == 'admin.acl.index' || 
					\Request()->route()->getName() == 'admin.acl.create' || 
					\Request()->route()->getName() == 'admin.acl.edit' ||
					\Request()->route()->getName() == 'admin.right.index' || 
					\Request()->route()->getName() == 'admin.right.create' || 
					\Request()->route()->getName() == 'admin.right.edit'  ||
					\Request()->route()->getName() == 'admin.admin_user.index' || 
					\Request()->route()->getName() == 'admin.admin_user.create' || 
					\Request()->route()->getName() == 'admin.admin_user.edit'  

					) 
				{
					$commonModule ='class=open'; 
					$commonModuleBlock ="block"; 
				}else{
					$commonModule = "";
					$commonModuleBlock = "none";
				}
			?>

			<?php if( CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_ACL_MODULE) || 
				 CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_RIGHT_MODULE) || 
				 CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_ADMIN_USER_MODULE) 
				): ?>
			<li <?php echo e($commonModule); ?>>
				<a href="javascript:;">
				<i class="fa fa-list-alt" aria-hidden="true"></i>
				<span class="title"><?php echo e(trans('lang_data.admin_management_label')); ?></span>
				<span class="arrow "></span>
				</a>
				<ul class="sub-menu" style="display: <?php echo e($commonModuleBlock); ?>;">
					<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_ACL_MODULE)): ?>
					<li <?php if(\Request()->route()->getName() == 'admin.acl.index' || \Request()->route()->getName() == 'admin.acl.create' || \Request()->route()->getName() == 'admin.acl.edit'): ?>  class="active"  <?php endif; ?>><a href="<?php echo e(route('admin.acl.index')); ?>"><?php echo e(trans('lang_data.acl')); ?></a></li>
					<?php endif; ?>
					<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_RIGHT_MODULE)): ?>
					<li <?php if(\Request()->route()->getName() == 'admin.right.index' || \Request()->route()->getName() == 'admin.right.create' || \Request()->route()->getName() == 'admin.right.edit'): ?>  class="active"  <?php endif; ?>><a href="<?php echo e(route('admin.right.index')); ?>"><?php echo e(trans('lang_data.right')); ?></a></li>
					<?php endif; ?>
					<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_ADMIN_USER_MODULE)): ?>
					<li <?php if(\Request()->route()->getName() == 'admin.admin_user.index' || \Request()->route()->getName() == 'admin.admin_user.create' || \Request()->route()->getName() == 'admin.admin_user.edit'): ?>  class="active"  <?php endif; ?>><a href="<?php echo e(route('admin.admin_user.index')); ?>"><?php echo e(trans('lang_data.admin_user')); ?></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>

			<?php 

				if (
					\Request()->route()->getName() == 'admin.blogs.index' || 
					\Request()->route()->getName() == 'admin.blogs.create' || 
					\Request()->route()->getName() == 'admin.blogs.edit' 
					) 
				{
					$commonModule ='class=open'; 
					$commonModuleBlock ="block"; 
				}else{
					$commonModule = "";
					$commonModuleBlock = "none";
				}
			?>
			
			<?php if( CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_BLOG_MODULE)): ?>
			<li <?php echo e($commonModule); ?>>
				<a href="javascript:;">
				<i class="fa fa-info-circle" aria-hidden="true"></i>
				<span class="title"><?php echo e(trans('lang_data.blog_mng_label')); ?></span>
				<span class="arrow "></span>
				</a>
				<ul class="sub-menu" style="display: <?php echo e($commonModuleBlock); ?>;">
					<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_BLOG_MODULE)): ?>
					<li <?php if(\Request()->route()->getName() == 'admin.blogs.index' || \Request()->route()->getName() == 'admin.blogs.create' || \Request()->route()->getName() == 'admin.blogs.edit'): ?>  class="active"  <?php endif; ?>><a href="<?php echo e(route('admin.blogs.index')); ?>"><?php echo e(trans('lang_data.blog_label')); ?></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>
			<?php 

				if (
					\Request()->route()->getName() == 'admin.cms.index' || 
					\Request()->route()->getName() == 'admin.cms.create' || 
					\Request()->route()->getName() == 'admin.cms.edit' ||						
					\Request()->route()->getName() == 'admin.modules.index' || 
					\Request()->route()->getName() == 'admin.modules.create' || 
					\Request()->route()->getName() == 'admin.modules.edit' 
					) 
				{
					$commonModule ='class=open'; 
					$commonModuleBlock ="block"; 
				}else{
					$commonModule = "";
					$commonModuleBlock = "none";
				}
			?>

			<?php if( CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CMS_MODULE) ||
				 CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CMS_MODULE_MODULE)
				): ?>
			<li <?php echo e($commonModule); ?>>
				<a href="javascript:;">
				<i class="fa fa-database" aria-hidden="true"></i>
				<span class="title"><?php echo e(trans('lang_data.content_management_label')); ?></span>
				<span class="arrow "></span>
				</a>
				<ul class="sub-menu" style="display: <?php echo e($commonModuleBlock); ?>;">
					<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CMS_MODULE)): ?>
					<li <?php if(\Request()->route()->getName() == 'admin.cms.index' || \Request()->route()->getName() == 'admin.cms.create' || \Request()->route()->getName() == 'admin.cms.edit'): ?>  class="active"  <?php endif; ?>><a href="<?php echo e(route('admin.cms.index')); ?>"><?php echo e(trans('lang_data.pages_module_label')); ?></a></li>
					<?php endif; ?>
					<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_CMS_MODULE_MODULE)): ?>
					<li <?php if(\Request()->route()->getName() == 'admin.modules.index' || \Request()->route()->getName() == 'admin.modules.create' || \Request()->route()->getName() == 'admin.modules.edit'): ?>  class="active"  <?php endif; ?>><a href="<?php echo e(route('admin.modules.index')); ?>"><?php echo e(trans('lang_data.module_label')); ?></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>	
			<?php 

				if (\Request()->route()->getName() == 'admin.settings.index') {
					$commonModule ='class=open'; 
					$commonModuleBlock ="block"; 
				}else{
					$commonModule = "";
					$commonModuleBlock = "none";
				}
			?>

			<?php if( CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_SETTINNG_MODULE)): ?>
			<li <?php echo e($commonModule); ?>>
				<a href="javascript:;">
				<i class="fa fa-gear"></i>
				<span class="title"><?php echo e(trans('lang_data.general_setting_label')); ?></span>
				<span class="arrow "></span>
				</a>
				<ul class="sub-menu" style="display: <?php echo e($commonModuleBlock); ?>">
					<?php if(CHECK_RIGHTS_TO_ACCESS(App\Models\Acl::CONST_SETTINNG_MODULE)): ?>
					<li <?php if(\Request()->route()->getName() == 'admin.settings.index'): ?>  class="active"  <?php endif; ?>><a href="<?php echo e(route('admin.settings.index')); ?>"><?php echo e(trans('lang_data.setting_label')); ?></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>
		</ul>
	</div>
</div>
<?php /**PATH /var/www/html/softtechover/Modules/Admin/Resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>