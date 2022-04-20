@extends('admin::layouts.master')
@section('content')
<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Cms Content</h3>
            </div>
              @if(isset($cmsContent))
                {{ Form::model($cmsContent,
                array(
                'id'                => 'AddEditCmsContent',
                'class'             => 'FromSubmit form-horizontal',
                'data-redirect_url' => route('admin.cms_contents.index'),
                'url'               => route('admin.cms_contents.update', $encryptedId),
                'method'            => 'PUT'
                ))
                }}
              @else
                {{
                  Form::open([
                  'id'=>'AddEditCmsContent',
                  'class'=>'FromSubmit form-horizontal',
                  'url'=>route('admin.cms_contents.store'),
                  'data-redirect_url'=>route('admin.cms_contents.index'),
                  'name'=>'cmsContent'

                  ])
                }}
              @endif
              <div class="box-body">
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Parent Title <span class="has-error">*</span></label>
                  <div class="col-sm-5">
                    {{ Form::select('cms_id',[''=>'Select Cms page']+ \App\Models\Cms::getCmsDropDown(),null,['id'=>'',"class"=>"form-control"])
                  }}
                  </div>
                </div>
                <div class="form-group box-footer">
                  <label for="exampleInputName" class="col-sm-2 control-label">Name <span class="has-error">*</span></label>
                  <div class="col-sm-5">
                    {{ Form::text('name',null,['placeholder'=>'Enter Name','id'=>'name','class'=>'form-control'])}}
                  </div>
                </div>
                <div class="form-group box-footer">
                  <label for="from" class="col-sm-2 control-label">Image <span class="has-error">*</span></label>
                  <div class="col-sm-5">
                    {{ Form::file('image',null,['id'=>'image','class'=>'form-control'])}}
                  </div>
                </div>
                 <div class="form-group box-footer">
                  <label for="subject" class="col-sm-2 control-label">Short Description <span class="has-error">*</span></label>
                  <div class="col-sm-8">
                    {{ Form::textarea('short_description',null,['id'=>'short_description','class'=>'form-control'])}}
                  </div>
                </div>
                 <div class="form-group box-footer">
                  <label for="subject" class="col-sm-2 control-label">Long Description <span class="has-error">*</span></label>
                  <div class="col-sm-8">
                    {{ Form::textarea('long_description',null,['id'=>'long_description','class'=>'form-control'])}}
                  </div>
                </div>
               
                 <div class="box-footer">
                   <div class="form-group">
                    <label for="subject" class="col-sm-2 control-label">Status <span class="has-error">*</span></label>
                      <div class="col-sm-5">
                        <div class="checkbox">
                          <label class="radio-inline">
                            {{ Form::radio('status',1,['id'=>'','class'=>''])}}
                            Active
                          </label>
                          <label class="radio-inline">
                            {{ Form::radio('status',0,['id'=>'','class'=>''])}}
                            InActive
                          </label>
                        </div>
                      </div>
                   </div> 
                </div>

              </div>
              <div class="box-footer">
                <div class="col-sm-12 col-sm-offset-2">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="{{route('admin.cms_contents.index')}}" class="btn btn-danger">Cancel</a>
                </div>
              </div>
            {{ Form::close()}}
          </div>
	 </div>	
@endsection
@section('javascript')
 <script>
        var editor = CKEDITOR.replace( 'short_description', {
            
        });
        CKEDITOR.config.allowedContent = true;
    </script>
    <script>
        var editor = CKEDITOR.replace( 'long_description', {
            
        });
        CKEDITOR.config.allowedContent = true;
    </script>
<script type="text/javascript">
  $(document).ready(function(){
  
    $("#AddEditCmsContent").validate({
        rules: {
           name: { required: true }
        },
        messages:{
          name:{ required:'Name field is required'},
        },
        tooltip_options: {
           name: { placement: 'top' },
        }
    
    });
});
  </script>
@endsection