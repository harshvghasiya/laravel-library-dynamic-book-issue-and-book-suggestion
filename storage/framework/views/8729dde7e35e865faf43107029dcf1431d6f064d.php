<?php $__env->startSection('style'); ?>
<style>
  

  a.margin_class {
      padding: 20px;
      font-size: 20px;
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
    <a href="<?php echo e(route('admin.product.index')); ?>"><?php echo e(trans('lang_data.product_list_label')); ?></a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    <?php if(isset($product)): ?>
      <?php echo e(trans('lang_data.edit_product_label')); ?>

    <?php else: ?>
      <?php echo e(trans('lang_data.add_product_label')); ?>

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
                  <?php if(isset($product)): ?>
                    <?php echo e(trans('lang_data.edit_product_label')); ?>

                  <?php else: ?>
                    <?php echo e(trans('lang_data.add_product_label')); ?>

                  <?php endif; ?>
                </div>
              </div>
              <div class="portlet-body form">
                  <?php if(isset($product)): ?>
                    <?php echo e(Form::model($product,
                      array(
                      'id'                => 'productValidation',
                      'class'             => 'form-horizontal',
                      'data-redirect_url' => route('admin.product.index'),
                      'url'               => route('admin.product.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))); ?>

                  <?php else: ?>
                    <?php echo e(Form::open([
                      'id'=>'productValidation',
                      'class'=>'form-horizontal',
                      'url'=>route('admin.product.store'),
                      'data-redirect_url'=>route('admin.product.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])); ?>

                  <?php endif; ?>
                  <div class="form-body">
                    <h3 class="form-section"><?php echo e(trans('lang_data.product_info_label')); ?></h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.name_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('name',null,['placeholder'=>trans('lang_data.placeholde_product_name_label'),'id'=>'name','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>  

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.sku_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('sku',null,['placeholder'=>trans('lang_data.sku_label'),'id'=>'sku','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.category_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::select('category_id',[''=>'Select category']+ \App\Models\SubCategory::getSubCategoryDropDown(),null,['id'=>'category_id','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.brand_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::select('brand_id',[''=>'select brand']+ \App\Models\Brand::getBrandDropDown(),null,['id'=>'category_id','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.country_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::select('country_id',[''=>'select country']+\App\Models\Country::getCountryDropDown(),null,['id'=>'country_id','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.product_code_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('product_code',null,['placeholder'=>trans('lang_data.product_code_label'),'id'=>'product_code','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.shn_code_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('hsn_code',null,['placeholder'=>trans('lang_data.shn_code_label'),'id'=>'hsn_code','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>


                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.speak_to_expert_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('speak_to_expert',null,['placeholder'=>trans('lang_data.speak_to_expert_label'),'id'=>'speak_to_expert','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.availability_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('availability',null,['placeholder'=>trans('lang_data.availability_label'),'id'=>'availability','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.price_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('price',null,['placeholder'=>trans('lang_data.price_label'),'id'=>' price','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.redirect_url_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::text('contact_url',null,['placeholder'=>trans('lang_data.redirect_url_label'),'id'=>' contact_url','class'=>'form-control'])); ?>

                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.status_label')); ?></label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" <?php echo e(isset($product)?($product->status == 1)?'checked':'':'checked'); ?> />
                              <?php echo e(trans('lang_data.active_label')); ?> </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" <?php echo e(isset($product)?($product->status == 0)?'checked':'':''); ?> />
                              <?php echo e(trans('lang_data.inactive_label')); ?> </label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.featured_product_label')); ?></label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="checkbox" name="is_featured" value="1" <?php echo e(isset($product)?($product->is_featured == 1)?'checked':'':''); ?> />
                              <?php echo e(trans('lang_data.yes_label')); ?> </label>
                            </div>
                          </div>
                        </div>
                      </div>


                    </div>


                    <h3 class="form-section">Media Info</h3>
                     <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3"><?php echo e(trans('lang_data.embeded_video_link_label')); ?></label>
                            <div class="col-md-9">
                              <?php echo e(Form::text('video_link',null,['placeholder'=>trans('lang_data.embeded_video_link_label'),'id'=>'video_link','class'=>'form-control'])); ?>

                            </div>
                          </div>
                        </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"><?php echo e(trans('lang_data.attachment_label')); ?></label>
                          <div class="col-md-9">
                            <?php echo e(Form::file('attachment[]',null,['id'=>'attachment','class'=>'form-control'])); ?>


                            <?php if(isset($product) && !empty($product->getProductAttachmentUrl())): ?>
                              <br>
                              <input type="hidden" name="delete_attachment" id="delete_attachment" value="">
                              <div class="parent_attachment">
                                <a href="<?php echo e($product->getProductAttachmentUrl()); ?>" target="_blank">View</a>
                                <a href="javascript:void(0)" id="delete_attachment">Delete</a>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>

                    

                    </div>


                    <h3 class="form-section"><?php echo e(trans('lang_data.technical_specification_label')); ?></h3>
                        <div class="field_wrapper">

                              <?php if(isset($product) && !$product->productFeature->isEmpty()): ?>

                                  <?php $__currentLoopData = $product->productFeature; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="row">
                                      <div class="col-md-3 col-md-offset-1">
                                          <div class="form-group">
                                            <input type="text" name="f_name[]" placeholder="Feature" value="<?php echo e($v->f_name); ?>" class="form-control" />
                                          </div>

                                      </div>
                                      <div class="col-md-3 col-md-offset-1">
                                        
                                          <div class="form-group">
                                              
                                             <input type="text" name="f_value[]" placeholder="Feature value" value="<?php echo e($v->f_value); ?>" class="form-control" />
                                          </div>

                                      </div>
                                      <a href="javascript:void(0)" data-id="<?php echo e($v->id); ?>" class="removed_dynamic margin_class" title="Remove field"><i class="fa fa-minus-circle removed_dynamic" aria-hidden="true"></i></a>

                                    </div>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              <?php endif; ?>

                            <div class="row">

                                <div class="col-md-3 col-md-offset-1">
                                    <div class="form-group">
                                      <input type="text" name="f_name[]" placeholder="Feature" value="" class="form-control" />
                                    </div>

                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                  
                                    <div class="form-group">
                                        
                                       <input type="text" name="f_value[]" placeholder="Feature value" value="" class="form-control" />
                                    </div>

                                </div>
                                <a href="javascript:void(0);" class="add_button margin_class" title="Add field"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                            </div>
                        </div>

                    <h3 class="form-section"><?php echo e(trans('lang_data.product_description_label')); ?></h3>
                     <div class="row">

                        <div class="col-md-10 col-md-offset-1">
                          <div class="form-group">
                            <label class="control-label"><?php echo e(trans('lang_data.short_description_label')); ?></label>
                            <?php echo e(Form::textarea('short_description',null,['id'=>'short_description','class'=>'form-control'])); ?>

                          </div>
                        </div>
                        
                        <div class="col-md-10 col-md-offset-1">
                          <div class="form-group">
                            <label class="control-label"><?php echo e(trans('lang_data.description_label')); ?></label>
                            <?php echo e(Form::textarea('description',null,['id'=>'description','class'=>'form-control editor-tinymce'])); ?>

                          </div>
                        </div>
                        
                        <div class="col-md-10 col-md-offset-1">
                          <div class="form-group">
                            <label class="control-label"><?php echo e(trans('lang_data.technical_description_label')); ?></label>
                            <?php echo e(Form::textarea('technical_description',null,['id'=>'technical_description','class'=>'form-control editor-tinymce'])); ?>

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

                       <div class="col-md-10 col-md-offset-1">
                       <div class="form-group">
                          <div class="file-loading">
                            <input id="dropzone-input" name="images[]" type="file" accept="image/*" multiple>
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
                            <a href="<?php echo e(route('admin.product.index')); ?>" type="button" class="btn default"><?php echo e(trans('lang_data.cancel_label')); ?></a>
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

    $("#productValidation").validate({
        rules: {
          name: { required: true },
          category_id: { required: true },
          sku: { required: true },
          country_id: { required: true },
          availability: { required: true },
          speak_to_expert: { number: true },
          attachment: { extension: "docx|rtf|doc|pdf" },
          contact_url: { url: true }
        },
        messages:{
          description:{ required:'Description field is required'},
          attachment:{ extension:'Only docx,rtf,doc,pdf file type are allowed.'},
        },
        errorPlacement: function(error, element) {
          $(element).closest('div').append(error);
        }

    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = ' <div class="row"><div class="col-md-3 col-md-offset-1"><div class="form-group"><input type="text" placeholder="Feature" name="f_name[]" value="" class="form-control" /></div></div><div class="col-md-3 col-md-offset-1"><div class="form-group"><input type="text" name="f_value[]" placeholder="Feature value" value="" class="form-control" /></div></div><a href="javascript:void(0);" class="remove_button margin_class" title="Remove field"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

  $(document).on("click",".removed_dynamic",function(){
        
      swal({
        title: "Are you sure want to delete this record ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
              var id = $(this).attr('data-id');
              var cur =$(this);
              $.ajax({
                type:"POST",
                url:"<?php echo e(route('admin.product.single_feature_delete')); ?>",
                data:{"id":id,"_token": "<?php echo e(csrf_token()); ?>"},
                success:function(data){
                    cur.parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                  }
              })
          swal("<?php echo e(trans('lang_data.admin_user_record_successfully_deleted')); ?>", {
                      icon: "success",
          });
        } 
      });
    });

});

  $(document).on("click","#delete_attachment",function(){
        
      swal({
        title: "Are you sure want to detele attachment file ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
              
            $("#delete_attachment").val(1);
            $(".parent_attachment").empty();
        } 
      });
    })
</script>
  <?php echo $__env->make('admin::product.dropzone-upload', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_ecommerce/Modules/Admin/Resources/views/product/addedit.blade.php ENDPATH**/ ?>