@extends('admin::layouts.master')
@section('style')
@endsection
@section('content')
<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="{{route('admin.dashboard')}}">{{trans('lang_data.home_label')}}</a><i class="fa fa-circle"></i>
  </li>
  <li>
    <a href="{{route('admin.banners.index')}}">{{trans('lang_data.right_listing')}}</a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    @if(isset($right))
      {{trans('lang_data.edit_right')}}
    @else
      {{trans('lang_data.add_right')}}
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
                  @if(isset($right))
                    {{trans('lang_data.edit_right')}}
                  @else
                    {{trans('lang_data.add_right')}}
                  @endif
                </div>
              </div>
              <div class="portlet-body form">
                  @if(isset($right))
                    {{ Form::model($right,
                      array(
                      'id'                => 'AddEditRight',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.right.index'),
                      'url'               => route('admin.right.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))
                    }}
                  @else
                    {{
                      Form::open([
                      'id'=>'AddEditRight',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.right.store'),
                      'data-redirect_url'=>route('admin.right.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])
                    }}
                  @endif

                  @if(isset($right))
                    <input type="hidden" name="id" value="{{\Crypt::encrypt($right->id)}}">
                  @else
                    <input type="hidden" name="id" value="">
                  @endif
                  <div class="form-body">
                    <h3 class="form-section">{{trans('lang_data.right_info_label')}}</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.name_label')}}</label>
                          <div class="col-md-9">
                            {{ Form::text('name',null,['placeholder'=>trans('lang_data.right_name_label'),'id'=>'name','class'=>'form-control'])}}
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.status_label')}}</label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" {{ isset($right)?($right->status == 1)?'checked':'':'checked' }} />
                              {{trans('lang_data.active_label')}} </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" {{ isset($right)?($right->status == 0)?'checked':'':'' }} />
                              {{trans('lang_data.inactive_label')}} </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                      <h3 class="form-section">{{trans('lang_data.module_list_label')}}</h3>
                      <div class="row">
                          @foreach($aclModule as $a)
                              <div class="col-md-4">
                                @if(isset($encryptedId) && !empty($encryptedId))
                                  <?php $check="";?>
                                  @foreach($rightModule as $b)
                                    @if($a->id === $b->module_id)
                                     <?php $check="checked";?>
                                    @endif
                                  @endforeach
                                   {{ Form::checkbox('acl_id[]',$a->id,$check,["class"=>"right_data"]) }}
                                  {{$a->title}}
                                @else
                                  {{ Form::checkbox('acl_id[]',$a->id,null,["class"=>"right_data"]) }}
                                  {{$a->title}}
                                @endif
                              </div>
                          @endforeach
                      </div>

                  </div>
                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">{{trans('lang_data.submit_label')}}</button>
                            <a href="{{route('admin.right.index')}}" type="button" class="btn default">{{trans('lang_data.cancel_label')}}</a>
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
    $("#AddEditRight").validate({
        rules: {
           'name': { required: true},
        },
        messages:{
           'name': { required:"{{trans('lang_data.name_required')}}"},
        }
    });

    if($("#checked_all").length>0)
    {
      $(document).on("click","#checked_all",function(){
        select_all_right();
      });
    }
    function select_all_right()
    {
      console.log("in");
      if($("#checked_all").prop("checked"))
      {
        $(".right_data").each(function(){
            $(this).prop("checked",true);
        });
      }
      else
      {
        $(".right_data").prop("checked",false);
      }
    }

});
</script>
@endsection
