@extends('admin::layouts.master')
@section('style')
@endsection
@section('content')
<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="{{route('admin.dashboard')}}">{{trans('lang_data.home_label')}}</a><i class="fa fa-circle"></i>
  </li>
  <li>
    <a href="{{route('admin.banners.index')}}">{{trans('lang_data.acl_listing')}}</a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    @if(isset($acl))
      {{trans('lang_data.edit_acl')}}
    @else
      {{trans('lang_data.add_acl')}}
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
                  @if(isset($acl))
                    {{trans('lang_data.edit_acl')}}
                  @else
                    {{trans('lang_data.add_acl')}}
                  @endif
                </div>
              </div>
              <div class="portlet-body form">
                  @if(isset($acl))
                    {{ Form::model($acl,
                      array(
                      'id'                => 'AddEditAcl',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.acl.index'),
                      'url'               => route('admin.acl.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))
                    }}
                  @else
                    {{
                      Form::open([
                      'id'=>'AddEditAcl',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.acl.store'),
                      'data-redirect_url'=>route('admin.acl.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])
                    }}
                  @endif

                  @if(isset($acl))
                    <input type="hidden" name="id" value="{{\Crypt::encrypt($acl->id)}}">
                  @else
                    <input type="hidden" name="id" value="">
                  @endif
                  <div class="form-body">
                    <h3 class="form-section">{{trans('lang_data.module_info_label')}}</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.name_label')}}</label>
                          <div class="col-md-9">
                            {{ Form::text('title',null,['placeholder'=>trans('lang_data.add_module_title'),'id'=>'title','class'=>'form-control'])}}
                          </div>
                        </div>
                      </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.status_label')}}</label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" {{ isset($acl)?($acl->status == 1)?'checked':'':'checked' }} />
                              {{trans('lang_data.active_label')}} </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" {{ isset($acl)?($acl->status == 0)?'checked':'':'' }} />
                              {{trans('lang_data.inactive_label')}} </label>
                            </div>
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
                            <a href="{{route('admin.acl.index')}}" type="button" class="btn default">{{trans('lang_data.cancel_label')}}</a>
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
    $("#AddEditAcl").validate({
        rules: {
           'title': { required: true},
        },
        messages:{
           'title': { required:"{{trans('lang_data.title_filed_required')}}"},
        }
    });
});
</script>
@endsection
