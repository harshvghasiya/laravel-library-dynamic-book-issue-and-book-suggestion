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
    <a href="{{route('admin.blogs.index')}}">{{trans('lang_data.blog_list_label')}}</a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
    @if(isset($blog))
      {{trans('lang_data.edit_blog_label')}}
    @else
      {{trans('lang_data.add_blog_label')}}
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
                  @if(isset($blog))
                    {{trans('lang_data.edit_blog_label')}}
                  @else
                    {{trans('lang_data.add_blog_label')}}
                  @endif
                </div>
              </div>
              <div class="portlet-body form">
                  @if(isset($blog))
                    {{ Form::model($blog,
                      array(
                      'id'                => 'AddEditBlog',
                      'class'             => 'FromSubmit form-horizontal',
                      'data-redirect_url' => route('admin.blogs.index'),
                      'url'               => route('admin.blogs.update', $encryptedId),
                      'method'            => 'PUT',
                      'enctype'           =>"multipart/form-data"
                      ))
                    }}
                  @else
                    {{
                      Form::open([
                      'id'=>'AddEditBlog',
                      'class'=>'FromSubmit form-horizontal',
                      'url'=>route('admin.blogs.store'),
                      'data-redirect_url'=>route('admin.blogs.index'),
                      'name'=>'socialMedia',
                      'enctype' =>"multipart/form-data"
                      ])
                    }}
                  @endif
                  <div class="form-body">
                    <h3 class="form-section">{{trans('lang_data.blog_info_label')}}</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.name_label')}}</label>
                          <div class="col-md-9">
                            {{ Form::text('name',null,['placeholder'=>trans('lang_data.enter_name_placeholder_label'),'id'=>'name','class'=>'form-control'])}}
                        </div>
                      </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.status_label')}}</label>
                          <div class="col-md-9">
                            <div class="radio-list">
                              <label class="radio-inline">
                              <input type="radio" name="status" value="1" {{ isset($blog)?($blog->status == 1)?'checked':'':'checked' }} />
                              {{trans('lang_data.active_label')}} </label>
                              <label class="radio-inline">
                              <input type="radio" name="status" value="0" {{ isset($blog)?($blog->status == 0)?'checked':'':'' }} />
                              {{trans('lang_data.inactive_label')}} </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Is Demo Post</label>
                            <div class="col-md-9" style="margin-top: 10px">
                              {{ Form::checkbox('is_demo',1,null,["class"=>"form-control is_demo"])
                                    }} 
                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.demo_url')}}</label>
                            <div class="col-md-9">
                              {{ Form::url('demo_url',null,['placeholder'=>trans('lang_data.demo_url'),'id'=>'demo_url','class'=>'form-control'])}}
                          </div>
                        </div>
                      </div>
                    </div>
                    <h3 class="form-section">{{trans('lang_data.total_category')}}</h3>
                    <div class="row">
                      <div class="col-md-12 col-md-offset-1">
                        <div class="form-group">
                          <?php $categoryData = \App\Models\Category::getCatDropDown(); ?>
                            @if(isset($categoryData) && !empty($categoryData))
                              @if(isset($blog) && !empty($blog))
                                @if(isset($blog->multipleBlogCategory) && !$blog->multipleBlogCategory->isEmpty())
                                      @foreach($categoryData as $key=>$v)
                                        <div class="col-md-3">
                                        <?php $catId = false; ?>
                                        @foreach($blog->multipleBlogCategory as $key2=>$v2)
                                          @if($v2->category_id == $key)
                                              <?php $catId = true;break; ?>
                                          @endif
                                        @endforeach
                                        {{ Form::checkbox('category_id[]',$key,$catId,["class"=>"form-control category_id"])
                                        }} {{$v}}
                                        </div>
                                      @endforeach                                                               
                                @else
                                  @foreach($categoryData as $key=>$v)
                                    <div class="col-md-3">
                                    {{ Form::checkbox('category_id[]',$key,null,["class"=>"form-control category_id"])
                                    }} {{$v}}
                                    </div>
                                  @endforeach                                    
                                @endif                                  
                              @else
                                @foreach($categoryData as $key=>$v)
                                  <div class="col-md-3">  
                                  {{ Form::checkbox('category_id[]',$key,null,["class"=>"form-control category_id"])
                                  }} {{$v}}
                                  </div>
                                @endforeach
                              @endif
                            @endif
                        </div>
                      </div>
                    </div>
                    <h3 class="form-section">{{trans('lang_data.tag')}}</h3>
                    <div class="row">
                      <div class="col-md-12 col-md-offset-1">
                        <div class="form-group">
                          <?php $tagData = \App\Models\Tag::getCatDropDown(); ?>
                            @if(isset($tagData) && !empty($tagData))
                              @if(isset($blog) && !empty($blog))
                                @if(isset($blog->multipleTagCategory) && !$blog->multipleTagCategory->isEmpty())
                                      @foreach($tagData as $key=>$v)
                                        <div class="col-md-3">
                                        <?php $catId = false; ?>
                                        @foreach($blog->multipleTagCategory as $key2=>$v2)
                                          @if($v2->tag_id == $key)
                                              <?php $catId = true;break; ?>
                                          @endif
                                        @endforeach
                                        {{ Form::checkbox('tag_id[]',$key,$catId,["class"=>"form-control tag_id"])
                                        }} {{$v}}
                                        </div>
                                      @endforeach                                                               
                                @else
                                  @foreach($tagData as $key=>$v)
                                    <div class="col-md-3">
                                    {{ Form::checkbox('tag_id[]',$key,null,["class"=>"form-control tag_id"])
                                    }} {{$v}}
                                    </div>
                                  @endforeach                                    
                                @endif                                  
                              @else
                                @foreach($tagData as $key=>$v)
                                  <div class="col-md-3">  
                                  {{ Form::checkbox('tag_id[]',$key,null,["class"=>"form-control tag_id"])
                                  }} {{$v}}
                                  </div>
                                @endforeach
                              @endif
                            @endif
                        </div>
                      </div>
                    </div>
                    <h3 class="form-section">{{trans('lang_data.seo_section_label')}}</h3>
                     <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.seo_title_label_label')}}</label>
                            <div class="col-md-9">
                              {{ Form::text('seo_title',null,['placeholder'=>trans('lang_data.enter_seo_title_label'),'id'=>'seo_title','class'=>'form-control'])}}
                            </div>
                          </div>
                        </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.seo_keyword_label_label')}}</label>
                          <div class="col-md-9">
                            {{ Form::text('seo_keyword',null,['placeholder'=>trans('lang_data.Enter_seo_Keyword_label'),'id'=>'seo_keyword','class'=>'form-control'])}}
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.seo_description_label')}}</label>
                          <div class="col-md-9">
                            {{ Form::textarea('seo_description',null,['id'=>'seo_description','class'=>'form-control'])}}
                          </div>
                        </div>
                      </div>
                    </div>
                     <h3 class="form-section">{{trans('lang_data.description_label')}}</h3>
                     <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label col-md-3">{{trans('lang_data.short_description_label')}}</label><br><br>
                            <div class="col-md-10 col-md-offset-1">
                              {{ Form::textarea('short_description',null,['id'=>'short_description','class'=>'form-control editor-tinymce '])}}
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label col-md-3">{{trans('lang_data.long_description_label')}}</label><br><br>
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
                            <label class="control-label col-md-3">{{trans('lang_data.image_label')}}</label>
                            <div class="col-md-9">
                               <input type="file" name="image[]" id="filer_input">
                               <input type="hidden" name="delete_image" id="delete_image" value="0">
                              @if(isset($blog) && $blog->image !=null)
                                <div class="row">
                                    <div class="col-sm-6 imgUp">
                                      <div class="imagePreview" style="background: url({{$blog->getBlogImageUrl()}})"></div>
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
                            <a href="{{route('admin.blogs.index')}}" type="button" class="btn default">{{trans('lang_data.cancel_label')}}</a>
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
    $("#AddEditBlog").validate({
        rules: {
           'name': { required: true},
            'image[]': { extension: "jpg|png|jpeg"},
           'url': { required: true,url:true },
        },
        messages:{
           'name': { required:"{{trans('lang_data.banner_name_required_label')}}"},
        },
        errorPlacement: function(error, element) {
          $(element).closest('div').append(error);
        }
    });
});
</script>
@endsection
