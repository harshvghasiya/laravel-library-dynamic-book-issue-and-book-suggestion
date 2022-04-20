<?php $__env->startSection('title'); ?>
<title>404 - Page Not Found - <?php echo e(trans('lang_data.softtechover_com_label')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<style>
.page_404{ padding:25px 0; background:#fff; font-family: 'Arvo', serif;
}
.page_404  img{ width:100%;}
.four_zero_four_bg{background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);height: 400px;background-position: center; }
 .four_zero_four_bg h1{
 font-size:80px;}
 .four_zero_four_bg h3{font-size:80px;}
.link_404{color: #fff!important;padding: 10px 20px;background: #17b4b8;margin: 20px 0;
    display: inline-block;}
	.contant_box_404{ margin-top:-50px;}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="page_404">
	<div class="container">
		<div class="row">	
		<div class="col-sm-12 ">
		<div class="col-sm-10 col-sm-offset-1  text-center">
		<div class="four_zero_four_bg">
			<h1 class="text-center ">404</h1>
		</div>
		<div class="contant_box_404">
		<h3 class="h2">Look like you're lost</h3>
		<p>the page you are looking for not avaible!</p>
		<a href="<?php echo e(route('front.home')); ?>" class="link_404">Go to Home</a>
	</div>
		</div>
		</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\makeupnoor-master\resources\views/errors/404.blade.php ENDPATH**/ ?>