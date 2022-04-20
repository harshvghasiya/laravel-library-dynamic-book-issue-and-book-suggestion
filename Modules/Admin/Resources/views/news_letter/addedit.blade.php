@extends('admin::layouts.master')
@section('content')
<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="{{route('admin.dashboard')}}">{{trans('lang_data.home_label')}}</a><i class="fa fa-circle"></i>
  </li>
  <li>
    <a href="{{route('admin.news-letter.index')}}">{{trans('lang_data.news_letter_label')}}</a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    @if(isset($newsLetter))
      {{trans('lang_data.edit_newsletter_label')}}
    @else
      {{trans('lang_data.add_newsletter_label')}}
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
                  @if(isset($newsLetter))
                    {{trans('lang_data.edit_newsletter_label')}}
                  @else
                    {{trans('lang_data.add_newsletter_label')}}
                  @endif
                </div>
              </div>
              <div class="portlet-body form">
                  @if(isset($newsLetter))
                    {{ Form::model($newsLetter,
                      array(
                      'id'                => 'AddEditNewsLetter',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.news-letter.index'),
                      'url'               => route('admin.news-letter.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))
                    }}
                  @else
                    {{
                      Form::open([
                      'id'=>'AddEditNewsLetter',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.news-letter.store'),
                      'data-redirect_url'=>route('admin.news-letter.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])
                    }}
                  @endif
                  <div class="form-body">
                    <h3 class="form-section">{{trans('lang_data.news_letter_info_label')}}</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.email_management_label')}}</label>
                          <div class="col-md-9">
                            {{ Form::email('email',null,['placeholder'=>trans('lang_data.enter_email_placeholder_label'),'id'=>'email','class'=>'form-control'])}}
                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.status_label')}}</label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" {{ isset($newsLetter)?($newsLetter->status == 1)?'checked':'':'checked' }} />
                              {{trans('lang_data.active_label')}} </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" {{ isset($newsLetter)?($newsLetter->status == 0)?'checked':'':'' }} />
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
                            <a href="{{route('admin.news-letter.index')}}" type="button" class="btn default">{{trans('lang_data.cancel_label')}}</a>
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
     $("#AddEditNewsLetter").validate({
        rules: {
           email: { required: true,email:true },
        },
        messages:{
          email:{ required:"{{trans('lang_data.email_address_required_label')}}"},
        }
    });
  });
</script>
@endsection
