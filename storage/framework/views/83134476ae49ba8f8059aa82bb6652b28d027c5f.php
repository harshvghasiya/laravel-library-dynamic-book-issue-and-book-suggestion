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
    <a href="<?php echo e(route('admin.social_medias.index')); ?>"><?php echo e(trans('lang_data.social_media_label')); ?></a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    <?php if(isset($socialMedia)): ?>
      <?php echo e(trans('lang_data.edit_social_media')); ?>

    <?php else: ?>
      <?php echo e(trans('lang_data.add_social_media')); ?>

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
                  <?php if(isset($socialMedia)): ?>
                    <?php echo e(trans('lang_data.edit_social_media')); ?>

                  <?php else: ?>
                    <?php echo e(trans('lang_data.add_social_media')); ?>

                  <?php endif; ?>
                </div>
              </div>
              <div class="portlet-body form">
                  <?php if(isset($socialMedia)): ?>
                    <?php echo e(Form::model($socialMedia,
                      array(
                      'id'                => 'AddEditSocialMedia',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.social_medias.index'),
                      'url'               => route('admin.social_medias.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))); ?>

                  <?php else: ?>
                    <?php echo e(Form::open([
                      'id'=>'AddEditSocialMedia',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.social_medias.store'),
                      'data-redirect_url'=>route('admin.social_medias.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])); ?>

                  <?php endif; ?>
                  <div class="form-body">
                    <h3 class="form-section"><?php echo e(trans('lang_data.social_media_info_label')); ?></h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.title_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('title',null,['placeholder'=>trans('lang_data.title_label'),'id'=>'title','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.font_awesome_icon_syntax_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('font_awesome',null,['placeholder'=>trans('lang_data.font_awesome_icon_syntax_label'),'id'=>'from','class'=>'form-control'])); ?>

                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.url_single_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('url',null,['placeholder'=>trans('lang_data.url_single_label'),'id'=>'url','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.status_label')); ?></label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" <?php echo e(isset($socialMedia)?($socialMedia->status == 1)?'checked':'':'checked'); ?> />
                              <?php echo e(trans('lang_data.active_label')); ?> </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" <?php echo e(isset($socialMedia)?($socialMedia->status == 0)?'checked':'':''); ?> />
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
                            <label class="control-label col-md-3"><?php echo e(trans('lang_data.image_label')); ?></label>
                            <div class="col-md-9">
                               <input type="file" name="image[]" id="filer_input">
                              <?php if(isset($socialMedia)): ?>
                                <div class="row">
                                    <div class="col-sm-6 imgUp">
                                      <div class="imagePreview" style="background: url(<?php echo e($socialMedia->getSocialMediaImageUrl()); ?>)"></div>
                                        <label class="btn btn-danger"><a id="deleteImage" href="javascript:void(0)">Delete</a></label>
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
                            <a href="<?php echo e(route('admin.social_medias.index')); ?>" type="button" class="btn default"><?php echo e(trans('lang_data.cancel_label')); ?></a>
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
  $('#filer_input').filer({
    showThumbs: true,
    addMore: false,
    allowDuplicates: false
  });
});
</script>
<script>
  $(document).ready(function(){
     $("#AddEditSocialMedia").validate({
        rules: {
           title: { required: true },
           url: { required: true }
        },
        messages:{
          title:{ required:"<?php echo e(trans('lang_data.title_filed_required')); ?>"},
          url:{ required:"<?php echo e(trans('lang_data.url_required')); ?>"},
        }
    });
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\softtechover\Modules/Admin\Resources/views/social_media/addedit.blade.php ENDPATH**/ ?>