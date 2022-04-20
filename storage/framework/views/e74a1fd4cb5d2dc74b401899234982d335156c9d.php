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
    <a href="<?php echo e(route('admin.teams.index')); ?>"><?php echo e(trans('lang_data.team_listing_label')); ?></a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    <?php if(isset($team)): ?>
      <?php echo e(trans('lang_data.edit_team')); ?>

    <?php else: ?>
      <?php echo e(trans('lang_data.add_team')); ?>

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
                  <?php if(isset($team)): ?>
                    <?php echo e(trans('lang_data.edit_team')); ?>

                  <?php else: ?>
                    <?php echo e(trans('lang_data.add_team')); ?>

                  <?php endif; ?>
                </div>
              </div>
              <div class="portlet-body form">
                  <?php if(isset($team)): ?>
                    <?php echo e(Form::model($team,
                      array(
                      'id'                => 'AddEditTeam',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.teams.index'),
                      'url'               => route('admin.teams.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))); ?>

                  <?php else: ?>
                    <?php echo e(Form::open([
                      'id'=>'AddEditTeam',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.teams.store'),
                      'data-redirect_url'=>route('admin.teams.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])); ?>

                  <?php endif; ?>
                  <div class="form-body">
                    <h3 class="form-section"><?php echo e(trans('lang_data.team_info_label')); ?></h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.name_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('name',null,['placeholder'=>trans('lang_data.add_team_title'),'id'=>'name','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.role_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('role',null,['placeholder'=>trans('lang_data.role_title'),'id'=>'role','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.status_label')); ?></label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" <?php echo e(isset($team)?($team->status == 1)?'checked':'':'checked'); ?> />
                              <?php echo e(trans('lang_data.active_label')); ?> </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" <?php echo e(isset($team)?($team->status == 0)?'checked':'':''); ?> />
                              <?php echo e(trans('lang_data.inactive_label')); ?> </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <h3 class="form-section"><?php echo e(trans('lang_data.upload_image_label')); ?></h3>
                     <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3"><?php echo e(trans('lang_data.image_label')); ?> <span class="required">*</span> </label>
                            <div class="col-md-9">
                               <input type="file" name="image[]" id="filer_input">
                               <input type="hidden" name="delete_image" id="delete_image" value="0">
                              <?php if(isset($team) && $team->image !=null): ?>
                                <div class="row">
                                    <div class="col-sm-6 imgUp">
                                      <div class="imagePreview" style="background: url(<?php echo e($team->getTeamImageUrl()); ?>)"></div>
                                        <label class="btn btn-danger"><a id="deleteImage" data-name="image" href="javascript:void(0)"><?php echo e(trans('lang_data.delete_label')); ?></a></label>
                                    </div>
                                  </div>
                              <?php endif; ?>
                            </div>
                          </div>
                        </div>
                    </div>
                     <h3 class="form-section"><?php echo e(trans('lang_data.description_label')); ?></h3>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                              <?php echo e(Form::textarea('short_description',null,['id'=>'short_description','class'=>'form-control editor-tinymce'])); ?>

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
                            <a href="<?php echo e(route('admin.teams.index')); ?>" type="button" class="btn default"><?php echo e(trans('lang_data.cancel_label')); ?></a>
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
</script>
<script>
  $(document).ready(function(){
    $("#AddEditTeam").validate({
        rules: {
           'name': { required: true},
           'role': { required: true},
           'image[]': { required: function(){

                  if ($(".imgUp").length == 0) {

                    return true;

                  }else{

                    return false;
                  }
           },extension: "jpg|png|jpeg"},
          
        },
        messages:{
           'name': { required:"<?php echo e(trans('lang_data.team_name_required_label')); ?>"},
           'role': { required:"<?php echo e(trans('lang_data.team_role_required_label')); ?>"},
           'image[]': { required:"<?php echo e(trans('lang_data.please_select_image_label')); ?>"},
        },
        errorPlacement: function(error, element) {
          $(element).closest('div').append(error);
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\newlaunch\Modules/Admin\Resources/views/team/addedit.blade.php ENDPATH**/ ?>