<?php $__env->startSection('title'); ?>
    <?php if(isset($title) && $title !=""): ?>
        <title><?php echo e($title); ?> - <?php echo e(trans('lang_data.softtechover_com_label')); ?></title>
    <?php else: ?>
        <title><?php echo e(trans('lang_data.welcome_to_softtechover_com')); ?></title>
    <?php endif; ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="section_popular_home_page"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function(){
  fetch_data(1);
  $(document).on('click', '.pagination a', function(event){
    event.preventDefault(); 
    var page = $(this).attr('href').split('page=')[1];
    fetch_data(page);
    $('html, body').animate({scrollTop:50}, 'slow');
  });

  function fetch_data(page)
  {   
    var search = "<?php echo e(\Request::get('search')); ?>";
    $.ajax({
     url:"<?php echo e(route('front.category.category_pagination_ajax')); ?>?page="+page,
     data:{"_token": "<?php echo e(csrf_token()); ?>",search:search},
     success:function(data)
     {
      $('#section_popular_home_page').html(data);
     }
    });
  }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\softtechover\resources\views/front/category/all_category_listing.blade.php ENDPATH**/ ?>