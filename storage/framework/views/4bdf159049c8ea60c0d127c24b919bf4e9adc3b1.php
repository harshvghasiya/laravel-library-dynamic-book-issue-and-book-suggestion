<!DOCTYPE html>
<html lang="en" class="no-js">
    <?php echo $__env->make("admin::layouts.head", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
        <?php echo $__env->make("admin::layouts.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="page-container">
			<?php echo $__env->make("admin::layouts.sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<div class="page-content-wrapper">
					<div class="page-content">
						<div class="page-head">
							<div class="page-title">
								<h1>Dashboard <small>statistics & reports</small></h1>
							</div>
						</div>
						<?php echo $__env->yieldContent('style'); ?>
						<?php echo $__env->yieldContent('content'); ?>			
					</div>
				</div>
		</div>
		<?php echo $__env->make("admin::layouts.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make("admin::layouts.javascript", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::layouts.flashmessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('javascript'); ?>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\softtechover\Modules/Admin\Resources/views/layouts/master.blade.php ENDPATH**/ ?>