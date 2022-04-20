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
    <a href="{{route('admin.banners.index')}}">{{trans('lang_data.admin_user_listing')}}</a><i class="fa fa-circle"></i>
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
        <div class="tab-content">
          <div class="" id="tab_2">
            <div class="portlet box green">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>
                  @if(isset($adminUser))
                    {{trans('lang_data.edit_admin_user')}}
                  @else
                    {{trans('lang_data.add_admin_user')}}
                  @endif
                </div>
              </div>
              <div class="portlet-body form">
                  @if(isset($adminUser))
                    {{ Form::model($adminUser,
                      array(
                      'id'                => 'AddEditBanner',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.admin_user.index'),
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
                    <h3 class="form-section">{{trans('lang_data.admin_user_info_label')}}</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.right')}}</label>
                          <div class="col-md-9">
                            {!! Form::select('right_id',[""=>trans('lang_data.select_right_label')] + $rightList, null,['class' => 'form-control','id'=>'right_id']) !!}

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.name_label')}}</label>
                          <div class="col-md-9">
                            {{ Form::text('name',null,['placeholder'=>trans('lang_data.user_name'),'id'=>'name','class'=>'form-control'])}}
                          </div>
                        </div>
                      </div>
                     

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.email_label')}}</label>
                          <div class="col-md-9">
                            {{ Form::email('email',null,['placeholder'=>trans('lang_data.email_management_label'),'id'=>'email','class'=>'form-control'])}}
                        </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.status_label')}}</label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" {{ isset($adminUser)?($adminUser->status == 1)?'checked':'':'checked' }} />
                              {{trans('lang_data.active_label')}} </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" {{ isset($adminUser)?($adminUser->status == 0)?'checked':'':'' }} />
                              {{trans('lang_data.inactive_label')}} </label>
                            </div>
                          </div>
                        </div>
                      </div> 
                    </div>
                    @if(isset($adminUser) && !empty($adminUser))
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3"></label>
                          <div class="col-md-9">
                            {{ Form::checkbox('change_password',1,null,["class"=>"change_password"]) }}
                                  Change Password
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="row" id="show_hide_password" style="display: none;">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.password_label')}}</label>
                            <div class="col-md-9">
                              {{ Form::password('password',['placeholder'=>trans('lang_data.password_label'),'id'=>'password','class'=>'form-control'])}}
                          </div>
                          </div>
                        </div>
                      </div>
                    @else
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.password_label')}}</label>
                            <div class="col-md-9">
                              {{ Form::password('password',['placeholder'=>trans('lang_data.password_label'),'id'=>'password','class'=>'form-control'])}}
                          </div>
                          </div>
                        </div>
                      </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.profile_image_label')}}</label>
                            <div class="col-md-9">
                               <input type="file" name="image[]" id="filer_input">
                               <input type="hidden" name="delete_image" id="delete_image" value="0">
                              @if(isset($adminUser) && $adminUser->image !=null)
                                <div class="row">
                                    <div class="col-sm-6 imgUp">
                                      <div class="imagePreview" style="background: url({{$adminUser->getAdminUserImageUrl()}})"></div>
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
                            <a href="{{route('admin.admin_user.index')}}" type="button" class="btn default">{{trans('lang_data.cancel_label')}}</a>
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
        },
        errorPlacement: function(error, element) {
          $(element).closest('div').append(error);
        }
    });
});
</script>
@endsection
