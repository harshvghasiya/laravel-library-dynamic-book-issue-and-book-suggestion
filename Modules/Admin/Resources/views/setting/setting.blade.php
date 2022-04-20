@section('title')
  @if(isset($banner))
  {{trans('lang_data.edit_banner')}}
  @else
  {{trans('lang_data.add_banner')}}
  @endif
  | {{trans('lang_data.smart_home_work_label')}}
@endsection
@extends('admin::layouts.master')
@section('style')
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
<link href="{{asset('public/admin/jquery_filter/jquery.filer.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="{{route('admin.dashboard')}}">{{trans('lang_data.home_label')}}</a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
     {{trans('lang_data.edit_setting')}}
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
                      <i class="fa fa-gift"></i>{{trans('lang_data.edit_setting')}}
                    </div>
                  </div>
                  <div class="portlet-body form">
                      @if(isset($setting))
                        {{ Form::model($setting,
                        array(
                        'id'                => 'AddEditSetting',
                        'class'             => 'FromSubmit form-horizontal',
                        'data-redirect_url' => route('admin.settings.index'),
                        'url'               => route('admin.settings.update', $encryptedId),
                        'method'            => 'PUT',
                        'enctype'           =>"multipart/form-data"
                        ))
                        }}
                        
                      @else
                        {{
                          Form::open([
                          'id'=>'AddEditSetting',
                          'class'=>'FromSubmit form-horizontal',
                          'url'=>route('admin.settings.store'),
                          'data-redirect_url'=>route('admin.settings.index'),
                          'name'=>'socialMedia',
                          'enctype' =>"multipart/form-data"

                          ])
                        }}
                      @endif
                      <div class="form-body">
                        <h3 class="form-section">{{trans('lang_data.basic_info_label')}}</h3>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3">{{trans('lang_data.website_url')}}</label>
                              <div class="col-md-9">
                                {{ Form::text('site_url',null,['placeholder'=>trans('lang_data.website_url'),'id'=>'site_url','class'=>'form-control'])}}
                              </div>
                            </div>
                          </div>
                           <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3">{{trans('lang_data.author_name')}}</label>
                              <div class="col-md-9">
                                {{ Form::text('author_name',null,['placeholder'=>trans('lang_data.author_name'),'id'=>'author_name','class'=>'form-control'])}}
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3">{{trans('lang_data.email_label')}}</label>
                              <div class="col-md-9">
                                {{ Form::email('email',null,['placeholder'=>trans('lang_data.email_label'),'id'=>'email','class'=>'form-control'])}}
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3">{{trans('lang_data.second_email')}}</label>
                              <div class="col-md-9">
                                {{ Form::email('second_email',null,['placeholder'=>trans('lang_data.second_email'),'id'=>'second_email','class'=>'form-control'])}}
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3">{{trans('lang_data.mobile')}}</label>
                              <div class="col-md-9">
                                {{ Form::text('mobile',null,['placeholder'=>trans('lang_data.mobile'),'id'=>'mobile','class'=>'form-control'])}}
                              </div>
                            </div>
                          </div>
                           <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3">{{trans('lang_data.second_mobile')}}</label>
                              <div class="col-md-9">
                                {{ Form::text('second_mobile',null,['placeholder'=>trans('lang_data.second_mobile'),'id'=>'second_mobile','class'=>'form-control'])}}
                            </div>
                            </div>
                          </div>
                        </div>
                         <h3 class="form-section">{{trans('lang_data.description_details_label')}}</h3>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3">{{trans('lang_data.author_des_footer_label')}}</label>
                              <div class="col-md-9">
                                {{ Form::textarea('author_description_one',null,['id'=>'author_description_one','class'=>'form-control'])}}
                            </div>
                            </div>
                          </div>
                         <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3">{{trans('lang_data.author_des_sidebar_label')}}</label>
                              <div class="col-md-9">
                                {{ Form::textarea('author_description_two',null,['id'=>'author_description_two','class'=>'form-control'])}}
                            </div>
                            </div>
                          </div>
                        </div>    
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3">{{trans('lang_data.second_address')}}</label>
                              <div class="col-md-9">
                                {{ Form::textarea('second_address',null,['id'=>'second_address','class'=>'form-control'])}}
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="col-md-10 col-md-offset-1">
                              <label class="">{{trans('lang_data.address')}}</label>
                                {{ Form::textarea('address',null,['id'=>'address','class'=>'form-control editor-tinymce'])}}
                            </div>
                            </div>
                          </div>
                        </div>
                         <h3 class="form-section">{{trans('lang_data.map_detail_label')}}</h3>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3">{{trans('lang_data.latitude_lable')}}</label>
                              <div class="col-md-9">
                                {{ Form::text('address_latitude',null,['id'=>'address_latitude','class'=>'form-control'])}}
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3">{{trans('lang_data.longitude_lable')}}</label>
                              <div class="col-md-9">
                                {{ Form::text('address_longitude',null,['id'=>'longitude','class'=>'form-control'])}}
                              </div>
                            </div>
                          </div>

                           <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3">{{trans('lang_data.address_name_map_label')}}</label>
                              <div class="col-md-9">
                                {{ Form::textarea('map_address',null,['id'=>'map_address','class'=>'form-control'])}}
                            </div>
                            </div>
                          </div>
                        </div>
                        <h3 class="form-section">Upload Image</h3>
                         <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-3">{{trans('lang_data.logo')}}</label>
                                <div class="col-md-9">
                                   <input type="file" name="logo_image[]" id="filer_input">
                                   <input type="hidden" name="delete_logo_image" id="delete_logo_image" value="0">
                                  @if(isset($setting) && $setting->logo_image !=null)
                                    <div class="row">
                                        <div class="col-sm-6 imgUp">
                                          <div class="imagePreview" style="background: url({{$setting->getSettingLogoImageUrl()}})"></div>
                                          <label class="btn btn-danger"><a id="deleteImage" data-name="logo_image" href="javascript:void(0)">{{trans('lang_data.delete_label')}}</a></label>
                                        </div>
                                      </div>
                                  @endif
                                </div>
                              </div>
                            </div>
                             <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-3">{{trans('lang_data.favicon_logo')}}</label>
                                <div class="col-md-9">
                                   <input type="file" name="favicon_image[]" id="filer_input2">
                                   <input type="hidden" name="delete_favicon_image" id="delete_favicon_image" value="0">
                                  @if(isset($setting) && $setting->favicon_image !=null)
                                    <div class="row">
                                        <div class="col-sm-6 imgUp">
                                          <div class="imagePreview" style="background: url({{$setting->getsettineFaviconImgDynamic()}})"></div>
                                            <label class="btn btn-danger"><a id="deleteImage" data-name="favicon_image" href="javascript:void(0)">{{trans('lang_data.delete_label')}}</a></label>
                                        </div>
                                      </div>
                                  @endif
                                </div>
                              </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-3">{{trans('lang_data.email_logo')}}</label>
                                <div class="col-md-9">
                                   <input type="file" name="email_image[]" id="filer_input3">
                                   <input type="hidden" name="delete_email_image" id="delete_email_image" value="0">
                                  @if(isset($setting) && $setting->email_image !=null)
                                    <div class="row">
                                        <div class="col-sm-6 imgUp">
                                          <div class="imagePreview" style="background: url({{$setting->getsettineEmailImgDynamic()}})"></div>
                                            <label class="btn btn-danger"><a id="deleteImage" data-name="email_image" href="javascript:void(0)">{{trans('lang_data.delete_label')}}</a></label>
                                        </div>
                                      </div>
                                  @endif
                                </div>
                              </div>
                            </div>
                             <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-3">{{trans('lang_data.default_banner')}}</label>
                                <div class="col-md-9">
                                   <input type="file" name="home_page_banner_image[]" id="filer_input4">
                                   <input type="hidden" name="delete_home_page_banner_image" id="delete_home_page_banner_image" value="0">
                                  @if(isset($setting) && $setting->home_page_banner_image !="")
                                    <div class="row">
                                        <div class="col-sm-6 imgUp">
                                          <div class="imagePreview" style="background: url({{$setting->getsettineBannerImg()}})"></div>
                                          <label class="btn btn-danger"><a id="deleteImage" data-name="home_page_banner_image" href="javascript:void(0)">{{trans('lang_data.delete_label')}}</a></label>
                                        </div>
                                      </div>
                                  @endif
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-3">{{trans('lang_data.author_image_label')}}</label>
                                <div class="col-md-9">
                                   <input type="file" name="author_image[]" id="filer_input5">
                                   <input type="hidden" name="delete_author_image" id="delete_author_image" value="0">
                                  @if(isset($setting) && $setting->author_image !="")
                                    <div class="row">
                                        <div class="col-sm-6 imgUp">
                                          <div class="imagePreview" style="background: url({{$setting->getsettineAuthorImgDynamic()}})"></div>
                                            <label class="btn btn-danger"><a id="deleteImage" data-name="author_image" href="javascript:void(0)">{{trans('lang_data.delete_label')}}</a></label>
                                        </div>
                                      </div>
                                  @endif
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
                                <button type="submit" class="btn green">{{trans('lang_data.submit_label')}}</button>
                                <a href="{{route('admin.dashboard')}}" type="button" class="btn default">{{trans('lang_data.cancel_label')}}</a>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                          </div>
                        </div>
                      </div>
                      {{ Form::close()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('javascript')
<script src="{{asset('public/admin/jquery_filter/jquery.filer.min.js')}}"></script>
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
           mobile: { required: true},
           author_description_one: { required:true},
           author_description_two: { required:true},
           second_address: { required:true},
           'logo_image[]': { extension: "jpg|png|jpeg|svg" },
           'author_image[]': { extension: "jpg|png|jpeg|svg" },
           'email_image[]': { extension: "jpg|png|jpeg|svg" },
           'favicon_image[]': { extension: "jpg|png|jpeg|svg|ico" },
           'home_page_banner_image[]': { extension: "jpg|png|jpeg|svg" },

        },
        messages:{
           site_url: { required:"{{trans('lang_data.website_url_required')}}"},
           email: { required: "{{trans('lang_data.email_required')}}",email:"{{trans('lang_data.valid_email')}}" },
           second_email: { required: "{{trans('lang_data.email_required')}}",email:"{{trans('lang_data.valid_email')}}" },
           mobile: { required: 'Please enter number'}
        },
        errorPlacement: function(error, element) {
          $(element).closest('div').append(error);
        }
    });
});
</script>
@endsection
