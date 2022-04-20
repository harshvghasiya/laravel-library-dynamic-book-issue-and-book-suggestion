<?php $__env->startSection('title'); ?>
<title>404 - Page Not Found</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="content-page-404">
				<div class="container">
					<div class="row">
						<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
							<h4 class="title">404</h4>
							<div class="subtitle">Sorry! The Page Not Found ;(</div>
							<p class="text">The Link You Folowed Probably Broken, or the page has been removed.</p>
							<a href="<?php echo e(route('front.home')); ?>" class="btn btn-small btn--primary btn-hover-shadow">
								<span class="text">Return to Home</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\newlaunch\resources\views/errors/404.blade.php ENDPATH**/ ?>