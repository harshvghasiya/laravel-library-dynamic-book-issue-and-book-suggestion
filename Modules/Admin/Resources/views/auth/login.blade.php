<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>{{trans('lang_data.login_label')}} | {{trans('lang_data.softtechover_com_label')}}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/admin/pages/css/login3.css" rel="stylesheet" type="text/css"/>
<link href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/core-img/favicon.ico">
</head>
<body class="login" style="margin-top: 200px !important">
<div class="menu-toggler sidebar-toggler">
</div>
<div class="content">
	{{ Form::open([
        'id'=>'ajaxLoginnFormSubmit',
        'class'=>'login-form',
        'method'=>'POST',
        'url'=>route('admin.login'),
        'redirect_url'=>route('admin.dashboard'),
        'redirect_back'=>route('admin.login.main'),
        'name'=>'',
        'autocomplete'=>'off'
      ])
    }}
	<h3 class="form-title">Login to your account</h3>
	<div class="alert alert-danger display-hide">
		<button class="close" data-close="alert"></button>
		<span>
		Enter email and password. </span>
	</div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Email</label>
		<div class="input-icon">
			<i class="fa fa-user"></i>
			<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Password</label>
		<div class="input-icon">
			<i class="fa fa-lock"></i>
			<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
		</div>
	</div>
	<div class="form-actions">
		<label class="checkbox">
		<input type="checkbox" name="remember" value="1"/> Remember me </label>
		<button type="submit" class="btn green-haze pull-right">
		Login <i class="m-icon-swapright m-icon-white"></i>
		</button>
	</div>
	<div class="forget-password">
		<h4>Forgot your password ?</h4>
		<p>
			 no worries, click <a href="javascript:;" id="forget-password">
			here </a>
			to reset your password.
		</p>
	</div>
	{{ Form::close() }}
	{{ Form::open([
        'id'=>'ajaxForgotPassword',
        'class'=>'forget-form',
        'method'=>'POST',
        'url'=>route('admin.forgot_password'),
        'redirect_url'=>route('admin.login'),
        'redirect_back'=>route('admin.login'),
        'name'=>'',
        'autocomplete'=>'off'
      ])
    }}
	<h3>Forget Password ?</h3>
	<p>
		 Enter your e-mail address below to reset your password.
	</p>
	<div class="form-group">
		<div class="input-icon">
			<i class="fa fa-envelope"></i>
			<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
		</div>
	</div>
	<div class="form-actions">
		<button type="button" id="back-btn" class="btn">
		<i class="m-icon-swapleft"></i> Back </button>
		<button type="submit" class="btn green-haze pull-right">
		Submit <i class="m-icon-swapright m-icon-white"></i>
		</button>
	</div>
	{{ Form::close() }}
</div>
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/plugins/select2/select2.min.js"></script>
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/admin/pages/scripts/login.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/js/toaster/toastr.css">
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/js/toaster/toastr.min.js"></script>
@include('admin::layouts.flashmessage')
<script>
jQuery(document).ready(function() {
  Metronic.init();
  Layout.init();
  Login.init();
  Demo.init();
});
</script>
</body>
</html>
