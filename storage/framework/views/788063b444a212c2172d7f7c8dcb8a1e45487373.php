<?php $__env->startSection('style'); ?>
<style>
  .imagePreview {
    width: 100% !important;
    height: 180px !important;
    background-position: center center !important;
    background-color:#fff !important;
    background-size: cover !important;
    background-repeat:no-repeat !important;
    display: inline-block !important;
    box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2) !important;
}
.btn-danger
{
  display:block;
  border-radius:0px;
  box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);
  margin-top:-5px;
}
.btn-danger a{
  color: white !important;
}
.imgUp
{
  margin-bottom:15px;
}
</style>
<link href="<?php echo e(asset('public/admin/jquery_filter/jquery.filer.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(trans('lang_data.home_label')); ?></a><i class="fa fa-circle"></i>
  </li>
  <li>
    <a href="<?php echo e(route('admin.banners.index')); ?>"><?php echo e(trans('lang_data.admin_user_listing')); ?></a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    <?php if(isset($adminUser)): ?>
      <?php echo e(trans('lang_data.edit_admin_user')); ?>

    <?php else: ?>
      <?php echo e(trans('lang_data.add_admin_user')); ?>

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
                  <?php if(isset($adminUser)): ?>
                    <?php echo e(trans('lang_data.edit_admin_user')); ?>

                  <?php else: ?>
                    <?php echo e(trans('lang_data.add_admin_user')); ?>

                  <?php endif; ?>
                </div>
              </div>
              <div class="portlet-body form">
                  <?php if(isset($adminUser)): ?>
                    <?php echo e(Form::model($adminUser,
                      array(
                      'id'                => 'AddEditBanner',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.admin_user.index'),
                      'url'               => route('admin.admin_user.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))); ?>

                  <?php else: ?>
                    <?php echo e(Form::open([
                      'id'=>'AddEditBanner',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.admin_user.store'),
                      'data-redirect_url'=>route('admin.admin_user.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])); ?>

                  <?php endif; ?>

                  <?php if(isset($adminUser)): ?>
                    <input type="hidden" name="id" value="<?php echo e(\Crypt::encrypt($adminUser->id)); ?>">
                  <?php else: ?>
                    <input type="hidden" name="id" value="">
                  <?php endif; ?>
                  
                  <div class="form-body">
                    <h3 class="form-section"><?php echo e(trans('lang_data.admin_user_info_label')); ?></h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.right')); ?></label>
                          <div class="col-md-9">
                            <?php echo Form::select('right_id',[""=>trans('lang_data.select_right_label')] + $rightList, null,['class' => 'form-control','id'=>'right_id']); ?>


                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.name_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('name',null,['placeholder'=>trans('lang_data.user_name'),'id'=>'name','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>
                     

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.email_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::email('email',null,['placeholder'=>trans('lang_data.email_management_label'),'id'=>'email','class'=>'form-control'])); ?>

                        </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.status_label')); ?></label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" <?php echo e(isset($adminUser)?($adminUser->status == 1)?'checked':'':'checked'); ?> />
                              <?php echo e(trans('lang_data.active_label')); ?> </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" <?php echo e(isset($adminUser)?($adminUser->status == 0)?'checked':'':''); ?> />
                              <?php echo e(trans('lang_data.inactive_label')); ?> </label>
                            </div>
                          </div>
                        </div>
                      </div> 
                    </div>
                    <?php if(isset($adminUser) && !empty($adminUser)): ?>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"></label>
                          <div class="col-md-9">
                            <?php echo e(Form::checkbox('change_password',1,null,["class"=>"change_password"])); ?>

                                  Change Password
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="row" id="show_hide_password" style="display: none;">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3"><?php echo e(trans('lang_data.password_label')); ?></label>
                            <div class="col-md-9">
                              <?php echo e(Form::password('password',['placeholder'=>trans('lang_data.password_label'),'id'=>'password','class'=>'form-control'])); ?>

                          </div>
                          </div>
                        </div>
                      </div>
                    <?php else: ?>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3"><?php echo e(trans('lang_data.password_label')); ?></label>
                            <div class="col-md-9">
                              <?php echo e(Form::password('password',['placeholder'=>trans('lang_data.password_label'),'id'=>'password','class'=>'form-control'])); ?>

                          </div>
                          </div>
                        </div>
                      </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3"><?php echo e(trans('lang_data.profile_image_label')); ?></label>
                            <div class="col-md-9">
                               <input type="file" name="image[]" id="filer_input">
                               <input type="hidden" name="delete_image" id="delete_image" value="0">
                              <?php if(isset($adminUser) && $adminUser->image !=null): ?>
                                <div class="row">
                                    <div class="col-sm-6 imgUp">
                                      <div class="imagePreview" style="background: url(<?php echo e($adminUser->getAdminUserImageUrl()); ?>)"></div>
                                        <label class="btn btn-danger"><a id="deleteImage" data-name="image" href="javascript:void(0)">Delete</a></label>
                                    </div>
                                  </div>
                              <?php endif; ?>
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
                            <a href="<?php echo e(route('admin.admin_user.index')); ?>" type="button" class="btn default"><?php echo e(trans('lang_data.cancel_label')); ?></a>
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
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/jquery_filter/jquery.filer.min.js"></script>
<script>

  $(document).ready(function(){
    
    $(document).on("click","#deleteImage",function(){

      var imageName = $(this).attr("data-name");
      $("#delete_"+imageName).val(1);
      $(this).parent().parent().remove();  
      
    });

    $('#filer_input').filer({
      showThumbs: true,
      addMore: false,
      allowDuplicates: false
    });

  });

  $(document).ready(function(){


    $(document).on("click",".change_password",function(){

          if ($(".change_password").prop("checked")) {

             $("#show_hide_password").show();

          }else{

            $("#show_hide_password").hide();

          }
    });

    $("#AddEditBanner").validate({
        rules: {
           'right_id': { required: true},
           'name': { required: true},
           'image[]': { extension: "jpg|png|jpeg"},
           'email': { required: true,email:true},
           'password': { required: function(){

                if ($('.change_password').length > 0) {

                  if ($(".change_password").prop("checked")) {

                    return true;

                  }else{

                    return false;
                  }

                }else{

                  return true;
                }


           }},
           'status': { required: true},
        },
        messages:{
           'right_id': { required:"<?php echo e(trans('lang_data.please_select_right_label')); ?>"},
           'name': { required:"<?php echo e(trans('lang_data.name_required')); ?>"},
           'email': { required:"<?php echo e(trans('lang_data.email_required')); ?>"},
           'password': { required:"<?php echo e(trans('lang_data.password_required')); ?>"},
           'status': { required:"<?php echo e(trans('lang_data.select_status_label')); ?>"},
        },
        errorPlacement: function(error, element) {
          $(element).closest('div').append(error);
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/softtechover/Modules/Admin/Resources/views/admin_user/addedit.blade.php ENDPATH**/ ?>