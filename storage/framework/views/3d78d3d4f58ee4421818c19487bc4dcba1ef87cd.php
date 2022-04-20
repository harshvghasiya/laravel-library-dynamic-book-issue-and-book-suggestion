<?php $__env->startSection('title'); ?>
    <?php if(isset($title) && $title !=""): ?>
        <title><?php echo e($title); ?> - <?php echo e(trans('lang_data.softtechover_com_label')); ?></title>
    <?php else: ?>
        <title><?php echo e(trans('lang_data.welcome_to_softtechover_com')); ?></title>
    <?php endif; ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="divider"></div>
<section class="vizew-post-area mb-50">
    <div class="container">
      <div id="all_blog_single_category"></div>
    </div>
</section>
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
      var categorySlug = "<?php echo e($categorySlug); ?>";
      $.ajax({
       url:"<?php echo e(route('front.category.single_pagination_all_blog')); ?>?page="+page,
       data:{"_token": "<?php echo e(csrf_token()); ?>",categorySlug:categorySlug},
       success:function(data)
       {
        $('#all_blog_single_category').html(data);
       }
      });
    }
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/softtechover/resources/views/front/category/blog/single_category_all_blog.blade.php ENDPATH**/ ?>