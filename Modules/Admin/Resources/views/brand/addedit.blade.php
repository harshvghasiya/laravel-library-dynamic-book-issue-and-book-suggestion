@extends('admin::layouts.master')
@section('style')
@endsection
@section('content')
<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="{{route('admin.dashboard')}}">{{trans('lang_data.home_label')}}</a><i class="fa fa-circle"></i>
  </li>
  <li>
    <a href="{{route('admin.brand.index')}}">{{trans('lang_data.banner_listing_label')}}</a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    @if(isset($brand))
      {{trans('lang_data.edit_brand_label')}}
    @else
      {{trans('lang_data.add_brand_label')}}
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
                  @if(isset($brand))
                    {{trans('lang_data.edit_brand_label')}}
                  @else
                    {{trans('lang_data.add_brand_label')}}
                  @endif
                </div>
              </div>
              <div class="portlet-body form">
                  @if(isset($brand))
                    {{ Form::model($brand,
                      array(
                      'id'                => 'validateBrand',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.brand.index'),
                      'url'               => route('admin.brand.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))
                    }}
                  @else
                    {{
                      Form::open([
                      'id'=>'validateBrand',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.brand.store'),
                      'data-redirect_url'=>route('admin.brand.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])
                    }}
                  @endif
                  <div class="form-body">
                    <h3 class="form-section">{{trans('lang_data.brand_info_label')}}</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.name_label')}}</label>
                          <div class="col-md-9">
                            {{ Form::text('name',null,['placeholder'=>trans('lang_data.name_label'),'id'=>'name','class'=>'form-control'])}}
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.status_label')}}</label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" {{ isset($brand)?($brand->status == 1)?'checked':'':'checked' }} />
                              {{trans('lang_data.active_label')}} </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" {{ isset($brand)?($brand->status == 0)?'checked':'':'' }} />
                              {{trans('lang_data.inactive_label')}} </label>
                            </div>
                          </div>
                        </div>
                      </div>                       
                    </div>
                    
                    <h3 class="form-section">{{trans('lang_data.brand_description_label')}}</h3>
                     <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                               {{ Form::textarea('description',null,['id'=>'description','class'=>'form-control editor-tinymce'])}}
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
                            <a href="{{route('admin.brand.index')}}" type="button" class="btn default">{{trans('lang_data.cancel_label')}}</a>
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
<script>
$(document).ready(function(){

    $("#validateBrand").validate({
        rules: {
           name: { required: true },
        },
        messages:{
          name:{ required:'Name field is required'},
        },
        errorPlacement: function(error, element) {
          $(element).closest('div').append(error);
        }

    });
});
</script>
@endsection
