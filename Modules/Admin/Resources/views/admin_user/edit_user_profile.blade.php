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
  <li class="active">
    @if(isset($adminUser))
      {{trans('lang_data.edit_admin_user')}}
    @else
      {{trans('lang_data.add_admin_user')}}
    @endif
  </li>
</ul>
<div class="row">
    <div class="col-md-12">
      <div class="tabbable tabbable-custom tabbable-noborder tabbable-reversed">



          <div class="portlet box blue-hoki">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Update Profile
                </div>
              </div>
              <div class="portlet-body form">
                @if(isset($adminUser))
                    {{ Form::model($adminUser,
                      array(
                      'id'                => 'AddEditBanner',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => "",
                      'url'               => route('admin.admin_user.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))
                    }}
                  @else
                    {{
                      Form::open([
                      'id'=>'AddEditBanner',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.admin_user.store'),
                      'data-redirect_url'=>route('admin.admin_user.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])
                    }}
                  @endif

                  @if(isset($adminUser))
                    <input type="hidden" name="id" value="{{\Crypt::encrypt($adminUser->id)}}">
                  @else
                    <input type="hidden" name="id" value="">
                  @endif
                  <div class="form-body">
                    <div class="form-group">
                      <label class="col-md-3 control-label">{{trans('lang_data.right')}}</label>
                      <div class="col-md-4">
                        <strong>{{$adminUser->right->name}}</strong> 
                        <input type="hidden" name="right_id" value="{{$adminUser->right_id}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">{{trans('lang_data.name_label')}}</label>
                      <div class="col-md-4">
                        {{ Form::text('name',null,['placeholder'=>trans('lang_data.user_name'),'id'=>'name','class'=>'form-control'])}}
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">{{trans('lang_data.email_label')}}</label>
                      <div class="col-md-4">
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-envelope"></i>
                          </span>
                          {{ Form::email('email',null,['placeholder'=>trans('lang_data.email_management_label'),'id'=>'email','class'=>'form-control'])}}
                        </div>
                      </div>
                    </div>   
                    <div class="form-group">
                      <label class="col-md-3 control-label">{{trans('lang_data.change_password_label')}}</label>
                      <div class="col-md-4">
                        <div class="input-group">
                          {{ Form::checkbox('change_password',1,null,["class"=>"change_password"]) }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group" id="show_hide_password" style="display: none;">
                      <label class="col-md-3 control-label">{{trans('lang_data.password_label')}}</label>
                      <div class="col-md-4">
                        <div class="input-group">
                          {{ Form::password('password',['placeholder'=>trans('lang_data.password_label'),'id'=>'password','class'=>'form-control'])}}
                          <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">{{trans('lang_data.status_label')}}</label>
                      <div class="col-md-4">
                          <div class="radio-list">
                              <label class="radio-inline">
                                @if($adminUser->status == 1)
                                  <strong>{{trans('lang_data.active_label')}}</strong> 
                                @else
                                  <strong>{{trans('lang_data.inactive_label')}}</strong> 
                                @endif
                                <input type="hidden" name="status" value="{{$adminUser->status}}">
                              </label>

                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">{{trans('lang_data.profile_image_label')}}</label>
                      <div class="col-md-4">
                        <input type="file" name="image[]" id="filer_input">
                           <input type="hidden" name="delete_image" id="delete_image" value="0">
                          @if(isset($adminUser) && $adminUser->image !=null)
                            <div class="row">
                                <div class="col-sm-6 imgUp">
                                  <div class="imagePreview" style="background: url({{$adminUser->getAdminUserImageUrl()}})"></div>
                                    <label class="btn btn-danger"><a id="deleteImage" data-name="image" href="javascript:void(0)">Delete</a></label>
                                </div>
                              </div>
                          @endif
                      </div>
                    </div>
                  </div>
                   <div class="form-actions top">
                    <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn green">{{trans('lang_data.submit_label')}}</button>
                        <a href="{{route('admin.dashboard')}}" type="button" class="btn default">{{trans('lang_data.cancel_label')}}</a>
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

  $(document).ready(function(){


    $(document).on("click",".change_password",function(){

          if ($(".change_password").prop("checked")) {

             $("#show_hide_password").show();

          }else{

            $("#show_hide_password").hide();

          }
    });

    $("#AddEditBanner").validate({
        rules: {
           'right_id': { required: true},
           'name': { required: true},
           'image[]': { extension: "jpg|png|jpeg"},
           'email': { required: true,email:true},
           'password': { required: function(){

                if ($('.change_password').length > 0) {

                  if ($(".change_password").prop("checked")) {

                    return true;

                  }else{

                    return false;
                  }

                }else{

                  return true;
                }


           }},
           'status': { required: true},
        },
        messages:{
           'right_id': { required:"{{trans('lang_data.please_select_right_label')}}"},
           'name': { required:"{{trans('lang_data.name_required')}}"},
           'email': { required:"{{trans('lang_data.email_required')}}"},
           'password': { required:"{{trans('lang_data.password_required')}}"},
           'status': { required:"{{trans('lang_data.select_status_label')}}"},
        }
    });
});
</script>
@endsection
