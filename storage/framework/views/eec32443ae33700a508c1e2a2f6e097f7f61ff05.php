<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(trans('lang_data.home_label')); ?></a><i class="fa fa-circle"></i>
  </li>
  <li>
    <a href="<?php echo e(route('admin.brand.index')); ?>"><?php echo e(trans('lang_data.banner_listing_label')); ?></a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    <?php if(isset($brand)): ?>
      <?php echo e(trans('lang_data.edit_brand_label')); ?>

    <?php else: ?>
      <?php echo e(trans('lang_data.add_brand_label')); ?>

    <?php endif; ?>
  </li>
</ul>
<div class="row">
    <div class="col-md-12">
      <div class="tabbable tabbable-custom tabbable-noborder tabbable-reversed">
        <div class="tab-content">
          <div class="" id="tab_2">
            <div class="portlet box green">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>
                  <?php if(isset($brand)): ?>
                    <?php echo e(trans('lang_data.edit_brand_label')); ?>

                  <?php else: ?>
                    <?php echo e(trans('lang_data.add_brand_label')); ?>

                  <?php endif; ?>
                </div>
              </div>
              <div class="portlet-body form">
                  <?php if(isset($brand)): ?>
                    <?php echo e(Form::model($brand,
                      array(
                      'id'                => 'validateBrand',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.brand.index'),
                      'url'               => route('admin.brand.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))); ?>

                  <?php else: ?>
                    <?php echo e(Form::open([
                      'id'=>'validateBrand',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.brand.store'),
                      'data-redirect_url'=>route('admin.brand.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])); ?>

                  <?php endif; ?>
                  <div class="form-body">
                    <h3 class="form-section"><?php echo e(trans('lang_data.brand_info_label')); ?></h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.name_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('name',null,['placeholder'=>trans('lang_data.name_label'),'id'=>'name','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.status_label')); ?></label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" <?php echo e(isset($brand)?($brand->status == 1)?'checked':'':'checked'); ?> />
                              <?php echo e(trans('lang_data.active_label')); ?> </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" <?php echo e(isset($brand)?($brand->status == 0)?'checked':'':''); ?> />
                              <?php echo e(trans('lang_data.inactive_label')); ?> </label>
                            </div>
                          </div>
                        </div>
                      </div>                       
                    </div>
                    
                    <h3 class="form-section"><?php echo e(trans('lang_data.brand_description_label')); ?></h3>
                     <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                               <?php echo e(Form::textarea('description',null,['id'=>'description','class'=>'form-control editor-tinymce'])); ?>

                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green"><?php echo e(trans('lang_data.submit_label')); ?></button>
                            <a href="<?php echo e(route('admin.brand.index')); ?>" type="button" class="btn default"><?php echo e(trans('lang_data.cancel_label')); ?></a>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                      </div>
                    </div>
                  </div>
                  <?php echo e(Form::close()); ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function(){

    $("#validateBrand").validate({
        rules: {
           name: { required: true },
        },
        messages:{
          name:{ required:'Name field is required'},
        },
        errorPlacement: function(error, element) {
          $(element).closest('div').append(error);
        }

    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_ecommerce/Modules/Admin/Resources/views/brand/addedit.blade.php ENDPATH**/ ?>