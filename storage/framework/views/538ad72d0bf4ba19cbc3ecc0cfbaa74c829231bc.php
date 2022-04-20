<?php if($message = Session::get('success')): ?>
<script type="text/javascript">
	toastr.success('<?php echo $message; ?>', { timeOut:5000})
</script>
<?php  Session::forget('success'); ?>
<?php endif; ?>

<?php if($message = Session::get('error')): ?>
<script type="text/javascript">
	toastr.error('<?php echo $message; ?>', { timeOut:5000})
</script>
<?php  Session::forget('error'); ?>
<?php endif; ?>

<?php if($message = Session::get('warning')): ?>
<script type="text/javascript">
	toastr.warning('<?php echo $message; ?>', { timeOut:5000})
</script>
<?php  Session::forget('warning'); ?>
<?php endif; ?>

<?php if($message = Session::get('info')): ?>
<script type="text/javascript">
	toastr.info('<?php echo $message; ?>','Info Alert', { timeOut:5000})
</script>
<?php  Session::forget('info'); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\makeupnoor-master\Modules/Admin\Resources/views/layouts/flashmessage.blade.php ENDPATH**/ ?>