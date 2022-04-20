@extends('admin::layouts.master')
@section('content')
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Countries</h3>
            </div>
              @if(isset($country))
                {{ Form::model($country,
                array(
                'id'                => 'AddEditCountry',
                'class'             => 'FromSubmit form-horizontal',
                'data-redirect_url' => route('admin.countries.index'),
                'url'               => route('admin.countries.update', $encryptedId),
                'method'            => 'PUT'
                ))
                }}
              @else
                {{
                  Form::open([
                  'id'=>'AddEditCountry',
                  'class'=>'FromSubmit form-horizontal',
                  'url'=>route('admin.countries.store'),
                  'data-redirect_url'=>route('admin.countries.index'),
                  'name'=>'cms'

                  ])
                }}
              @endif
              <div class="box-body" >
                <div class="form-group">
                  <label for="exampleInputName" class="col-sm-2 control-label">{{trans('lang_data.name_label')}} <span class="has-error">*</span></label>
                  <div class="col-sm-5">
                    {{ Form::text('name',null,['placeholder'=>trans('lang_data.name_label'),'id'=>'name','class'=>'form-control required'])}}
                  </div>
                </div>
                <div class="box-footer">
                  <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">{{trans('lang_data.status_label')}} <span class="has-error">*</span></label>
                      <div class="col-sm-5">
                        <div class="checkbox">
                          <label class="radio-inline">
                            {{ Form::radio('status',1,['id'=>'','class'=>''])}}
                            {{trans('lang_data.active_label')}}
                          </label>
                          <label class="radio-inline">
                            {{ Form::radio('status',0,['id'=>'','class'=>''])}}
                            {{trans('lang_data.inactive_label')}}
                          </label>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="box-footer">
                  <div class="col-sm-12 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">{{trans('lang_data.submit_label')}}</button>
                    <a href="{{route('admin.countries.index')}}" class="btn btn-danger">{{trans('lang_data.cancel_label')}}</a>
                  </div>
                </div>
                {{ Form::close()}}
              </div>
          </div>
	 </div>	
@endsection
@section('javascript')
<script type="text/javascript">
  $(document).ready(function(){

  $("#AddEditCountry").validate({
        rules: {
           name: { required: true }
        },
        messages:{
          name:{ required:'Name field is required'},
        },
        tooltip_options: {
           name: { placement: 'top' },
        },
         success: function(element) {
                   alert('test');
                },
        submitHandler: function(form, event) { 
            alert("Do some stuff...");
        },
    });
});
  </script>
@endsection