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
<link href="{{asset('public/admin/jquery_filter/jquery.filer.css')}}" rel="stylesheet">
@endsection
@section('content')
<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="{{route('admin.dashboard')}}">{{trans('lang_data.home_label')}}</a><i class="fa fa-circle"></i>
  </li>
  <li>
    <a href="{{route('admin.social_medias.index')}}">{{trans('lang_data.social_media_label')}}</a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    @if(isset($socialMedia))
      {{trans('lang_data.edit_social_media')}}
    @else
      {{trans('lang_data.add_social_media')}}
    @endif
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
                  @if(isset($socialMedia))
                    {{trans('lang_data.edit_social_media')}}
                  @else
                    {{trans('lang_data.add_social_media')}}
                  @endif
                </div>
              </div>
              <div class="portlet-body form">
                  @if(isset($socialMedia))
                    {{ Form::model($socialMedia,
                      array(
                      'id'                => 'AddEditSocialMedia',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.social_medias.index'),
                      'url'               => route('admin.social_medias.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))
                    }}
                  @else
                    {{
                      Form::open([
                      'id'=>'AddEditSocialMedia',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.social_medias.store'),
                      'data-redirect_url'=>route('admin.social_medias.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])
                    }}
                  @endif
                  <div class="form-body">
                    <h3 class="form-section">{{trans('lang_data.social_media_info_label')}}</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.title_label')}}</label>
                          <div class="col-md-9">
                            {{ Form::text('title',null,['placeholder'=>trans('lang_data.title_label'),'id'=>'title','class'=>'form-control'])}}
                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.font_awesome_icon_syntax_label')}}</label>
                          <div class="col-md-9">
                            {{ Form::text('font_awesome',null,['placeholder'=>trans('lang_data.font_awesome_icon_syntax_label'),'id'=>'from','class'=>'form-control'])}}
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.url_single_label')}}</label>
                          <div class="col-md-9">
                            {{ Form::text('url',null,['placeholder'=>trans('lang_data.url_single_label'),'id'=>'url','class'=>'form-control'])}}
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.status_label')}}</label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" {{ isset($socialMedia)?($socialMedia->status == 1)?'checked':'':'checked' }} />
                              {{trans('lang_data.active_label')}} </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" {{ isset($socialMedia)?($socialMedia->status == 0)?'checked':'':'' }} />
                              {{trans('lang_data.inactive_label')}} </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <h3 class="form-section">{{trans('lang_data.upload_image_label')}}</h3>
                     <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.image_label')}}</label>
                            <div class="col-md-9">
                              <input type="file" name="image[]" id="filer_input">
                              <input type="hidden" name="delete_image" id="delete_image" value="0">
                              @if(isset($socialMedia) && $socialMedia->image !=null)
                                <div class="row">
                                    <div class="col-sm-6 imgUp">
                                      <div class="imagePreview" style="background: url({{$socialMedia->getSocialMediaImageUrl()}})"></div>
                                         <label class="btn btn-danger"><a id="deleteImage" data-name="image" href="javascript:void(0)">{{trans('lang_data.delete_label')}}</a></label>
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
                            <a href="{{route('admin.social_medias.index')}}" type="button" class="btn default">{{trans('lang_data.cancel_label')}}</a>
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
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/jquery_filter/jquery.filer.min.js"></script>
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
     $("#AddEditSocialMedia").validate({
        rules: {
           title: { required: true },
           'image[]': { extension: "jpg|png|jpeg"},
           url: { required: true }
        },
        messages:{
          title:{ required:"{{trans('lang_data.title_filed_required')}}"},
          url:{ required:"{{trans('lang_data.url_required')}}"},
        },
        errorPlacement: function(error, element) {
          $(element).closest('div').append(error);
        }
    });
  });
</script>
@endsection
