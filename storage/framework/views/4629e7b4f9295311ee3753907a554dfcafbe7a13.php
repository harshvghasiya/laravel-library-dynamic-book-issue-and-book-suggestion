<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title><?php echo e(trans('lang_data.reset_label')); ?> <?php echo e(trans('lang_data.password_label')); ?>  | <?php echo e(trans('lang_data.softtechover_com_label')); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/admin/pages/css/login3.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<?php echo e(Form::open([
        'id'=>'ajaxLoginnFormSubmit',
        'class'=>'reset-form',
        'method'=>'POST',
        'url'=>route('admin.update_password'),
        'name'=>'reset-form',
        'autocomplete'=>'off'
      ])); ?>

		<h3 class="form-title">Reset your password</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter email and password. </span>
		</div>
		<input type="hidden" name="token" value="<?php echo e($user->forgot_password_token); ?>">
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="New Password" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<button type="submit" class="btn green-haze pull-right">
			Reset Password <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		<div class="forget-password">
			<h4>Want to login ?</h4>
			<p>click <a href="<?php echo e(route('admin.login.main')); ?>" id="forget-password">
				here </a>
				to login with your account.
			</p>
		</div>
	<?php echo e(Form::close()); ?>

</div>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/plugins/select2/select2.min.js"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/admin/pages/scripts/login.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/js/toaster/toastr.css">
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/js/toaster/toastr.min.js"></script>
<?php echo $__env->make('admin::layouts.flashmessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
  Layout.init(); // init current layout
  Login.init();
  Demo.init();
});
</script>
</body>
</html><?php /**PATH /var/www/html/softtechover/Modules/Admin/Resources/views/auth/reset_password.blade.php ENDPATH**/ ?>