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
    <a href="{{route('admin.banners.index')}}">{{trans('lang_data.portfolio_listing')}}</a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    @if(isset($portfolio))
      {{trans('lang_data.edit_portfolio')}}
    @else
      {{trans('lang_data.add_portfolio')}}
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
                  @if(isset($portfolio))
                    {{trans('lang_data.edit_portfolio')}}
                  @else
                    {{trans('lang_data.add_portfolio')}}
                  @endif
                </div>
              </div>
              <div class="portlet-body form">
                  @if(isset($portfolio))
                    {{ Form::model($portfolio,
                      array(
                      'id'                => 'AddEditPortfolio',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.portfolio.index'),
                      'url'               => route('admin.portfolio.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))
                    }}
                  @else
                    {{
                      Form::open([
                      'id'=>'AddEditPortfolio',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.portfolio.store'),
                      'data-redirect_url'=>route('admin.portfolio.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])
                    }}
                  @endif
                  <div class="form-body">
                    <h3 class="form-section">{{trans('lang_data.portfolio_info')}}</h3>
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">Category</label>
                          <div class="col-md-9">
                            {{ Form::select('category_id',[''=>trans('lang_data.select_category_label')]+\App\Models\PortfolioCategory::getDropDown(),null,['id'=>'category_id','class'=>'form-control'])}}
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.title_label')}}</label>
                          <div class="col-md-9">
                            {{ Form::text('title',null,['placeholder'=>trans('lang_data.title_label'),'id'=>'title','class'=>'form-control'])}}
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.url_label')}}</label>
                            <div class="col-md-9">
                              {{ Form::text('url',null,['placeholder'=>trans('lang_data.add_banner_url'),'id'=>'from','class'=>'form-control'])}}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.status_label')}}</label>
                            <div class="col-md-9">
                              <div class="radio-list">
                                <label class="radio-inline">
                                <input type="radio" name="status" value="1" {{ isset($portfolio)?($portfolio->status == 1)?'checked':'':'checked' }} />
                                {{trans('lang_data.active_label')}} </label>
                                <label class="radio-inline">
                                <input type="radio" name="status" value="0" {{ isset($portfolio)?($portfolio->status == 0)?'checked':'':'' }} />
                                {{trans('lang_data.inactive_label')}} </label>
                              </div>
                            </div>
                          </div>
                        </div>  
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.description_label')}}</label>
                            <div class="col-md-9">
                              {{ Form::textarea('description',null,['id'=>'description','class'=>'form-control'])}}
                            </div>
                          </div>
                        </div>
                    </div>
                    <h3 class="form-section">{{trans('lang_data.description_portfolio')}}</h3>
                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                              {{ Form::textarea('long_description',null,['id'=>'long_description','class'=>'form-control editor-tinymce'])}}
                            </div>
                          </div>
                        </div>
                    </div>
                    <h3 class="form-section">{{trans('lang_data.upload_image_label')}}</h3>
                     <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.image_label')}} <span class="required">*</span> </label>
                            <div class="col-md-9">
                               <input type="file" name="image[]" id="filer_input">
                               <input type="hidden" name="delete_image" id="delete_image" value="0">
                              @if(isset($portfolio) && $portfolio->image !=null)
                                <div class="row">
                                    <div class="col-sm-6 imgUp">
                                      <div class="imagePreview" style="background: url({{$portfolio->getPortfolioImageUrl()}})">
                                      </div>
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
                            <a href="{{route('admin.portfolio.index')}}" type="button" class="btn default">{{trans('lang_data.cancel_label')}}</a>
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
    $("#AddEditPortfolio").validate({
        rules: {
           'category_id': { required: true},
           'title': { required: true},
           'image[]': { required: function(){

                  if ($(".imgUp").length == 0) {

                    return true;

                  }else{

                    return false;
                  }
           },extension: "jpg|png|jpeg"},
           'url': { required: false,url:true },
        },
        messages:{
           'category_id': { required:"{{trans('lang_data.category_filed_required')}}"},
           'title': { required:"{{trans('lang_data.title_filed_required')}}"},
           'image[]': { required:"{{trans('lang_data.please_select_image_label')}}"},
           'url': { required: "{{trans('lang_data.please_enter_banner_URL_label')}}",url:"{{trans('lang_data.please_enter_valid_banner_URL_label')}}" }
        },
        errorPlacement: function(error, element) {
          $(element).closest('div').append(error);
        }
    });
});
</script>
@endsection
