<?php $__env->startSection('title'); ?>
  <?php if(isset($banner)): ?>
  <?php echo e(trans('lang_data.edit_banner')); ?>

  <?php else: ?>
  <?php echo e(trans('lang_data.add_banner')); ?>

  <?php endif; ?>
  | <?php echo e(trans('lang_data.smart_home_work_label')); ?>

<?php $__env->stopSection(); ?>

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
<link href="<?php echo e(asset('public/admin/jquery_filter/jquery.filer.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(trans('lang_data.home_label')); ?></a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
     <?php echo e(trans('lang_data.edit_setting')); ?>

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
                      <i class="fa fa-gift"></i><?php echo e(trans('lang_data.edit_setting')); ?>

                    </div>
                  </div>
                  <div class="portlet-body form">
                      <?php if(isset($setting)): ?>
                        <?php echo e(Form::model($setting,
                        array(
                        'id'                => 'AddEditSetting',
                        'class'             => 'FromSubmit form-horizontal',
                        'data-redirect_url' => route('admin.settings.index'),
                        'url'               => route('admin.settings.update', $encryptedId),
                        'method'            => 'PUT',
                        'enctype'           =>"multipart/form-data"
                        ))); ?>

                        
                      <?php else: ?>
                        <?php echo e(Form::open([
                          'id'=>'AddEditSetting',
                          'class'=>'FromSubmit form-horizontal',
                          'url'=>route('admin.settings.store'),
                          'data-redirect_url'=>route('admin.settings.index'),
                          'name'=>'socialMedia',
                          'enctype'           =>"multipart/form-data"

                          ])); ?>

                      <?php endif; ?>
                      <div class="form-body">
                        <h3 class="form-section"><?php echo e(trans('lang_data.basic_info_label')); ?></h3>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3"><?php echo e(trans('lang_data.website_url')); ?></label>
                              <div class="col-md-9">
                                <?php echo e(Form::text('site_url',null,['placeholder'=>trans('lang_data.website_url'),'id'=>'site_url','class'=>'form-control'])); ?>

                              </div>
                            </div>
                          </div>
                           <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3"><?php echo e(trans('lang_data.author_name')); ?></label>
                              <div class="col-md-9">
                                <?php echo e(Form::text('author_name',null,['placeholder'=>trans('lang_data.author_name'),'id'=>'author_name','class'=>'form-control'])); ?>

                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3"><?php echo e(trans('lang_data.email_label')); ?></label>
                              <div class="col-md-9">
                                <?php echo e(Form::email('email',null,['placeholder'=>trans('lang_data.email_label'),'id'=>'email','class'=>'form-control'])); ?>

                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3"><?php echo e(trans('lang_data.second_email')); ?></label>
                              <div class="col-md-9">
                                <?php echo e(Form::email('second_email',null,['placeholder'=>trans('lang_data.second_email'),'id'=>'second_email','class'=>'form-control'])); ?>

                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3"><?php echo e(trans('lang_data.mobile')); ?></label>
                              <div class="col-md-9">
                                <?php echo e(Form::text('mobile',null,['placeholder'=>trans('lang_data.mobile'),'id'=>'mobile','class'=>'form-control'])); ?>

                              </div>
                            </div>
                          </div>
                           <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3"><?php echo e(trans('lang_data.second_mobile')); ?></label>
                              <div class="col-md-9">
                                <?php echo e(Form::text('second_mobile',null,['placeholder'=>trans('lang_data.second_mobile'),'id'=>'second_mobile','class'=>'form-control'])); ?>

                            </div>
                            </div>
                          </div>  

                         
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.set_home_page_category_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::select('category_id',[''=>'Select category']+ \App\Models\SubCategory::getSubCategoryDropDown(),null,['id'=>'category_id','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>

                        </div>
                        <h3 class="form-section"><?php echo e(trans('lang_data.description_details_label')); ?></h3>
                        
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-3"><?php echo e(trans('lang_data.second_address')); ?></label>
                                <div class="col-md-9">
                                  <?php echo e(Form::textarea('second_address',null,['id'=>'second_address','class'=>'form-control'])); ?>

                                </div>
                              </div>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="col-md-10 col-md-offset-1">
                              <label class=""><?php echo e(trans('lang_data.address')); ?></label>
                                <?php echo e(Form::textarea('address',null,['id'=>'address','class'=>'form-control editor-tinymce'])); ?>

                            </div>
                            </div>
                          </div>
                        </div>
                        <h3 class="form-section">Upload Image</h3>
                         <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-3"><?php echo e(trans('lang_data.logo')); ?></label>
                                <div class="col-md-9">
                                   <input type="file" name="logo_image[]" id="filer_input">
                                   <input type="hidden" name="delete_logo_image" id="delete_logo_image" value="0">
                                  <?php if(isset($setting) && $setting->logo_image !=null): ?>
                                    <div class="row">
                                        <div class="col-sm-6 imgUp">
                                          <div class="imagePreview" style="background: url(<?php echo e($setting->getSettingLogoImageUrl()); ?>)"></div>
                                          <label class="btn btn-danger"><a id="deleteImage" data-name="logo_image" href="javascript:void(0)"><?php echo e(trans('lang_data.delete_label')); ?></a></label>
                                        </div>
                                      </div>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </div>
                             <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-3"><?php echo e(trans('lang_data.favicon_logo')); ?></label>
                                <div class="col-md-9">
                                   <input type="file" name="favicon_image[]" id="filer_input2">
                                   <input type="hidden" name="delete_favicon_image" id="delete_favicon_image" value="0">
                                  <?php if(isset($setting) && $setting->favicon_image !=null): ?>
                                    <div class="row">
                                        <div class="col-sm-6 imgUp">
                                          <div class="imagePreview" style="background: url(<?php echo e($setting->getsettineFaviconImgDynamic()); ?>)"></div>
                                            <label class="btn btn-danger"><a id="deleteImage" data-name="favicon_image" href="javascript:void(0)"><?php echo e(trans('lang_data.delete_label')); ?></a></label>
                                        </div>
                                      </div>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-3"><?php echo e(trans('lang_data.email_logo')); ?></label>
                                <div class="col-md-9">
                                   <input type="file" name="email_image[]" id="filer_input3">
                                   <input type="hidden" name="delete_email_image" id="delete_email_image" value="0">
                                  <?php if(isset($setting) && $setting->email_image !=null): ?>
                                    <div class="row">
                                        <div class="col-sm-6 imgUp">
                                          <div class="imagePreview" style="background: url(<?php echo e($setting->getsettineEmailImgDynamic()); ?>)"></div>
                                            <label class="btn btn-danger"><a id="deleteImage" data-name="email_image" href="javascript:void(0)"><?php echo e(trans('lang_data.delete_label')); ?></a></label>
                                        </div>
                                      </div>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </div>
                             <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-3"><?php echo e(trans('lang_data.default_banner')); ?></label>
                                <div class="col-md-9">
                                   <input type="file" name="home_page_banner_image[]" id="filer_input4">
                                   <input type="hidden" name="delete_home_page_banner_image" id="delete_home_page_banner_image" value="0">
                                  <?php if(isset($setting) && $setting->home_page_banner_image !=""): ?>
                                    <div class="row">
                                        <div class="col-sm-6 imgUp">
                                          <div class="imagePreview" style="background: url(<?php echo e($setting->getsettineBannerImg()); ?>)"></div>
                                          <label class="btn btn-danger"><a id="deleteImage" data-name="home_page_banner_image" href="javascript:void(0)"><?php echo e(trans('lang_data.delete_label')); ?></a></label>
                                        </div>
                                      </div>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-3"><?php echo e(trans('lang_data.author_image_label')); ?></label>
                                <div class="col-md-9">
                                   <input type="file" name="author_image[]" id="filer_input5">
                                   <input type="hidden" name="delete_author_image" id="delete_author_image" value="0">
                                  <?php if(isset($setting) && $setting->author_image !=""): ?>
                                    <div class="row">
                                        <div class="col-sm-6 imgUp">
                                          <div class="imagePreview" style="background: url(<?php echo e($setting->getsettineAuthorImgDynamic()); ?>)"></div>
                                            <label class="btn btn-danger"><a id="deleteImage" data-name="author_image" href="javascript:void(0)"><?php echo e(trans('lang_data.delete_label')); ?></a></label>
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
                                <a href="<?php echo e(route('admin.dashboard')); ?>" type="button" class="btn default"><?php echo e(trans('lang_data.cancel_label')); ?></a>
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
<script src="<?php echo e(asset('public/admin/jquery_filter/jquery.filer.min.js')); ?>"></script>
<script>

  $(document).on("click","#deleteImage",function(){

    var imageName = $(this).attr("data-name");
    $("#delete_"+imageName).val(1);
    $(this).parent().parent().remove();  
    
  });

$(document).ready(function(){

  $('#filer_input').filer({
    showThumbs: true,
    addMore: false,
    allowDuplicates: false
  });
  $('#filer_input2').filer({
    showThumbs: true,
    addMore: false,
    allowDuplicates: false
  });
  $('#filer_input3').filer({
    showThumbs: true,
    addMore: false,
    allowDuplicates: false
  });
  $('#filer_input4').filer({
    showThumbs: true,
    addMore: false,
    allowDuplicates: false
  });  
  $('#filer_input5').filer({
    showThumbs: true,
    addMore: false,
    allowDuplicates: false
  });

    $("#AddEditSetting").validate({
        rules: {
           site_url: { required: true,url:true},
           email: { required: true,email:true },
           second_email: { required: true,email:true },
           author_name: { required: true,maxlength:20 },
           mobile: { required: true,number:true,minlength:10,maxlength:10},
           second_mobile: { number:true,minlength:10,maxlength:10},
           author_description_one: { required:true},
           author_description_two: { required:true},
           second_address: { required:true},
           'logo_image[]': { extension: "jpg|png|jpeg" },
           'author_image[]': { extension: "jpg|png|jpeg" },
           'email_image[]': { extension: "jpg|png|jpeg" },
           'favicon_image[]': { extension: "jpg|png|jpeg|ico" },
           'home_page_banner_image[]': { extension: "jpg|png|jpeg" },

        },
        messages:{
           site_url: { required:"<?php echo e(trans('lang_data.website_url_required')); ?>"},
           email: { required: "<?php echo e(trans('lang_data.email_required')); ?>",email:"<?php echo e(trans('lang_data.valid_email')); ?>" },
           second_email: { required: "<?php echo e(trans('lang_data.email_required')); ?>",email:"<?php echo e(trans('lang_data.valid_email')); ?>" },
           mobile: { required: 'Please enter number'}
        },
        errorPlacement: function(error, element) {
          $(element).closest('div').append(error);
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_ecommerce/Modules/Admin/Resources/views/setting/setting.blade.php ENDPATH**/ ?>