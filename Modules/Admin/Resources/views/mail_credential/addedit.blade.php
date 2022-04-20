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
     {{trans('lang_data.edit_mail_credential')}}
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
                      <i class="fa fa-gift"></i>{{trans('lang_data.edit_mail_credential')}}
                    </div>
                  </div>
                  <div class="portlet-body form">
                    @if(isset($mailcredential))
                    {{ Form::model($mailcredential,
                      array(
                        'id'                => 'AddEditMailCredential',
                        'class'             => 'FromSubmit form-horizontal',
                        'data-redirect_url' => route('admin.mailcredential.index'),
                        'url'               => route('admin.mailcredential.update', $encryptedId),
                        'method'            => 'PUT',
                        'enctype'           =>"multipart/form-data"
                      ))
                    }}

                    @else
                    {{
                      Form::open([
                        'id'=>'AddEditMailCredential',
                        'class'=>'FromSubmit form-horizontal',
                        'url'=>route('admin.mailcredential.store'),
                        'data-redirect_url'=>route('admin.mailcredential.index'),
                        'name'=>'socialMedia',
                        'enctype' =>"multipart/form-data"

                      ])
                    }}
                    @endif
                    <div class="form-body">
                      <h3 class="form-section">{{trans('lang_data.mail_crdential_label')}}</h3>
                      <div class="row">
                        <div class="col-md-10">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.mail_driver_label')}}</label>
                            <div class="col-md-9">
                              {{ Form::text('mail_driver',null,['placeholder'=>trans('lang_data.mail_driver_label'),'id'=>'mail_driver','class'=>'form-control'])}}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.mail_host')}}</label>
                            <div class="col-md-9">
                              {{ Form::text('mail_host',null,['placeholder'=>trans('lang_data.mail_host'),'id'=>'mail_host','class'=>'form-control'])}}
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-10">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.mail_port')}}</label>
                            <div class="col-md-9">
                              {{ Form::text('mail_port',null,['placeholder'=>trans('lang_data.mail_port'),'id'=>'mail_port','class'=>'form-control'])}}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.mail_username')}}</label>
                            <div class="col-md-9">
                              {{ Form::text('mail_username',null,['placeholder'=>trans('lang_data.mail_username'),'id'=>'mail_username','class'=>'form-control mail_username'])}}
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-10">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.mail_password')}}</label>
                            <div class="col-md-9">
                              {{ Form::text('mail_password',Crypt::encrypt($mailcredential->mail_password),['placeholder'=>trans('lang_data.mail_password'),'id'=>'mail_new_password','class'=>'form-control'])}}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.mail_encryption')}}</label>
                            <div class="col-md-9">
                              {{ Form::text('mail_encryption',null,['placeholder'=>trans('lang_data.mail_encryption'),'id'=>'mail_encryption','class'=>'form-control'])}}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.status_label')}}</label>
                            <div class="col-md-9">
                              <div class="radio-list">
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="1" {{ isset($mailcredential)?($mailcredential->status == 1)?'checked':'':'checked' }} />
                                {{trans('lang_data.active_label')}} </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="0" {{ isset($mailcredential)?($mailcredential->status == 0)?'checked':'':'' }} />
                                {{trans('lang_data.inactive_label')}} </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <h3 class="form-section">{{trans('lang_data.mail_from_crdential_label')}}</h3>

                      <div class="row">
                        <div class="col-md-10">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.mail_from_address')}}</label>
                            <div class="col-md-9">
                              {{ Form::text('mail_from_address',null,['placeholder'=>trans('lang_data.mail_from_address'),'id'=>'mail_from_address','class'=>'form-control'])}}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.mail_from_name')}}</label>
                            <div class="col-md-9">
                              {{ Form::text('mail_from_name',null,['placeholder'=>trans('lang_data.mail_from_name'),'id'=>'mail_from_name','class'=>'form-control'])}}
                            </div>
                          </div>
                        </div>
                       
                      </div>
                    </div>
                    <div class="form-actions">
                      <div class="row">
                        <div class="col-md-10">
                          <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                              <button type="submit" class="btn green">{{trans('lang_data.submit_label')}}</button>
                              <a href="{{route('admin.dashboard')}}" type="button" class="btn default">{{trans('lang_data.cancel_label')}}</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-10">
                        </div>
                      </div>
                    </div>
                        {{ Form::close()}}
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

  $(document).on('keyup', '.mail_username', function(event) {
    event.preventDefault();
    var mail_username=$(this).val();
     
  });

    $("#AddEditMailCredential").validate({
        rules: {
           mail_username: { required: true },
           mail_host: { required: true,maxlength:20 },
           mail_driver: { required: true},
           mail_port: { required: true},
           mail_encryption: { required: true},
           mail_from_name: { required: true},
           mail_from_address: { required: true},

        },
        messages:{
           mail_username: { required: "{{trans('lang_data.mail_username_required')}}"},
           mail_host: { required: '{{trans('lang_data.mail_host_required')}}'},
           mail_encryption: { required: '{{trans('lang_data.mail_encryption_required')}}'},
           mail_port: { required: '{{trans('lang_data.mail_port_required')}}'},
           mail_driver: { required: '{{trans('lang_data.mail_driver_required')}}'},
           mail_from_name: { required: '{{trans('lang_data.mail_from_name_required')}}'},
           mail_from_address: { required: '{{trans('lang_data.mail_from_address_required')}}'},
        },
        errorPlacement: function(error, element) {
          $(element).closest('div').append(error);
        }
    });
});
</script>
@endsection
