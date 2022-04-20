<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(trans('lang_data.home_label')); ?></a><i class="fa fa-circle"></i>
  </li>
  <li>
    <a href="<?php echo e(route('admin.banners.index')); ?>"><?php echo e(trans('lang_data.right_listing')); ?></a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    <?php if(isset($right)): ?>
      <?php echo e(trans('lang_data.edit_right')); ?>

    <?php else: ?>
      <?php echo e(trans('lang_data.add_right')); ?>

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
                  <?php if(isset($right)): ?>
                    <?php echo e(trans('lang_data.edit_right')); ?>

                  <?php else: ?>
                    <?php echo e(trans('lang_data.add_right')); ?>

                  <?php endif; ?>
                </div>
              </div>
              <div class="portlet-body form">
                  <?php if(isset($right)): ?>
                    <?php echo e(Form::model($right,
                      array(
                      'id'                => 'AddEditRight',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.right.index'),
                      'url'               => route('admin.right.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))); ?>

                  <?php else: ?>
                    <?php echo e(Form::open([
                      'id'=>'AddEditRight',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.right.store'),
                      'data-redirect_url'=>route('admin.right.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])); ?>

                  <?php endif; ?>

                  <?php if(isset($right)): ?>
                    <input type="hidden" name="id" value="<?php echo e(\Crypt::encrypt($right->id)); ?>">
                  <?php else: ?>
                    <input type="hidden" name="id" value="">
                  <?php endif; ?>
                  <div class="form-body">
                    <h3 class="form-section"><?php echo e(trans('lang_data.right_info_label')); ?></h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.name_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('name',null,['placeholder'=>trans('lang_data.right_name_label'),'id'=>'name','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.status_label')); ?></label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" <?php echo e(isset($right)?($right->status == 1)?'checked':'':'checked'); ?> />
                              <?php echo e(trans('lang_data.active_label')); ?> </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" <?php echo e(isset($right)?($right->status == 0)?'checked':'':''); ?> />
                              <?php echo e(trans('lang_data.inactive_label')); ?> </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                      <h3 class="form-section"><?php echo e(trans('lang_data.module_list_label')); ?></h3>
                      <div class="row">
                          <?php $__currentLoopData = $aclModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="col-md-4">
                                <?php if(isset($encryptedId) && !empty($encryptedId)): ?>
                                  <?php $check="";?>
                                  <?php $__currentLoopData = $rightModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($a->id === $b->module_id): ?>
                                     <?php $check="checked";?>
                                    <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   <?php echo e(Form::checkbox('acl_id[]',$a->id,$check,["class"=>"right_data"])); ?>

                                  <?php echo e($a->title); ?>

                                <?php else: ?>
                                  <?php echo e(Form::checkbox('acl_id[]',$a->id,null,["class"=>"right_data"])); ?>

                                  <?php echo e($a->title); ?>

                                <?php endif; ?>
                              </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>

                  </div>
                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green"><?php echo e(trans('lang_data.submit_label')); ?></button>
                            <a href="<?php echo e(route('admin.right.index')); ?>" type="button" class="btn default"><?php echo e(trans('lang_data.cancel_label')); ?></a>
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
    $("#AddEditRight").validate({
        rules: {
           'name': { required: true},
        },
        messages:{
           'name': { required:"<?php echo e(trans('lang_data.name_required')); ?>"},
        }
    });

    if($("#checked_all").length>0)
    {
      $(document).on("click","#checked_all",function(){
        select_all_right();
      });
    }
    function select_all_right()
    {
      console.log("in");
      if($("#checked_all").prop("checked"))
      {
        $(".right_data").each(function(){
            $(this).prop("checked",true);
        });
      }
      else
      {
        $(".right_data").prop("checked",false);
      }
    }

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/softtechover/Modules/Admin/Resources/views/right/addedit.blade.php ENDPATH**/ ?>