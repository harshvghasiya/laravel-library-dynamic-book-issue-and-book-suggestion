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
    <a href="<?php echo e(route('admin.cms.index')); ?>"><?php echo e(trans('lang_data.pages_list_label')); ?></a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    <?php if(isset($cms)): ?>
      <?php echo e(trans('lang_data.edit_page_label')); ?>

    <?php else: ?>
      <?php echo e(trans('lang_data.add_page')); ?>

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
                  <?php if(isset($cms)): ?>
                    <?php echo e(trans('lang_data.edit_page_label')); ?>

                  <?php else: ?>
                    <?php echo e(trans('lang_data.add_page')); ?>

                  <?php endif; ?>
                </div>
              </div>
              <div class="portlet-body form">
                  <?php if(isset($cms)): ?>
                    <?php echo e(Form::model($cms,
                      array(
                      'id'                => 'AddEditCms',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.cms.index'),
                      'url'               => route('admin.cms.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))); ?>

                  <?php else: ?>
                    <?php echo e(Form::open([
                      'id'=>'AddEditCms',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.cms.store'),
                      'data-redirect_url'=>route('admin.cms.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])); ?>

                  <?php endif; ?>
                  <div class="form-body">
                    <h3 class="form-section"><?php echo e(trans('lang_data.content_info_label')); ?></h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.page_title_label')); ?></label>
                          <div class="col-md-9">

                            <?php echo e(Form::select('parent_id',[''=>trans('lang_data.select_parent_page_label')]+ \App\Models\Cms::getCmsDropDown(),null,['id'=>'',"class"=>"form-control"])); ?>

                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.module_label')); ?></label>
                          <div class="col-md-9">
                            <?php 

                              $moduleArray = null;

                              if (isset($cms) && !$cms->multipleCmsModule->isEmpty()) {

                                $moduleArray = $cms->multipleCmsModule->pluck('module_id')->toArray();
                              }

                            ?>
                            <?php echo e(Form::select('module_id[]',[''=>trans('lang_data.select_module_type_label')]+ \App\Models\Module::getModuleDropDown(),$moduleArray,['multiple'=>true,'id'=>'',"class"=>"form-control"])); ?>

                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.name_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('name',null,['placeholder'=>trans('lang_data.enter_name_placeholder_label'),'id'=>'name','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.secondary_title_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('secondary_title',null,['placeholder'=>trans('lang_data.secondary_title_placeholder_label'),'id'=>'secondary_title','class'=>'form-control'])); ?>

                        </div>
                        </div>
                      </div>
                    </div>
                    
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">Redirect URL</label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('redirect_url',null,['placeholder'=>'Redirect URL','id'=>'redirect_url','class'=>'form-control'])); ?>

                        </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.status_label')); ?></label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" <?php echo e(isset($cms)?($cms->status == 1)?'checked':'':'checked'); ?> />
                              <?php echo e(trans('lang_data.active_label')); ?> </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" <?php echo e(isset($cms)?($cms->status == 0)?'checked':'':''); ?> />
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
                               <input type="hidden" name="delete_image" id="delete_image" value="0">
                              <?php if(isset($cms) && $cms->image !=null): ?>
                                <div class="row">
                                    <div class="col-sm-6 imgUp">
                                      <div class="imagePreview" style="background: url(<?php echo e($cms->getCmsImageUrl()); ?>)"></div>
                                        <label class="btn btn-danger"><a id="deleteImage" data-name="image" href="javascript:void(0)"><?php echo e(trans('lang_data.delete_label')); ?></a></label>
                                    </div>
                                  </div>
                              <?php endif; ?>
                            </div>
                          </div>
                        </div>
                    </div>
                    <h3 class="form-section"><?php echo e(trans('lang_data.seo_section_label')); ?></h3>
                     <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3"><?php echo e(trans('lang_data.seo_title_label_label')); ?></label>
                            <div class="col-md-9">
                              <?php echo e(Form::text('seo_title',null,['placeholder'=>trans('lang_data.enter_seo_title_label'),'id'=>'seo_title','class'=>'form-control'])); ?>

                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3"><?php echo e(trans('lang_data.seo_keyword_label_label')); ?></label>
                            <div class="col-md-9">
                              <?php echo e(Form::text('seo_keyword',null,['placeholder'=>trans('lang_data.Enter_seo_Keyword_label'),'id'=>'seo_keyword','class'=>'form-control'])); ?>

                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.seo_description_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::textarea('seo_description',null,['id'=>'seo_description','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>
                    </div>
                    <h3 class="form-section"><?php echo e(trans('lang_data.description_label')); ?></h3>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label col-md-3"><?php echo e(trans('lang_data.short_description_label')); ?></label>
                            <div class="col-md-10 col-md-offset-1">
                              <?php echo e(Form::textarea('short_description',null,['id'=>'short_description','class'=>'form-control editor-tinymce'])); ?>

                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.long_description_label')); ?></label>
                          <div class="col-md-10 col-md-offset-1">
                            <?php echo e(Form::textarea('long_description',null,['id'=>'long_description','class'=>'form-control editor-tinymce'])); ?>

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
                            <a href="<?php echo e(route('admin.cms.index')); ?>" type="button" class="btn default"><?php echo e(trans('lang_data.cancel_label')); ?></a>
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
</script>
<script>
  $(document).ready(function(){
    $("#AddEditCms").validate({
        rules: {
           name: { required: true },
           redirect_url: { url: true },
          'image[]': { extension: "jpg|png|jpeg"},
        },
        messages:{
          name:{ required:'<?php echo e(trans('lang_data.name_required')); ?>'},
        },
        errorPlacement: function(error, element) {
          $(element).closest('div').append(error);
        }
    });
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_ecommerce/Modules/Admin/Resources/views/cms/addedit.blade.php ENDPATH**/ ?>