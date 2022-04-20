@extends('layouts.app')
@section('title')
@if(isset($title) && $title !="")
<title>{{$title}} - {{trans('lang_data.softtechover_com_label')}}</title>
@else
<title>{{trans('lang_data.welcome_to_softtechover_com')}}</title>
@endif 
@endsection
@section('metaData')
<meta property="og:description" content="{{$getBlogDetail->seo_description}}" />
<meta property="og:url" content="{{\URL::current()}}" />
<meta property="og:title" content="{{$getBlogDetail->seo_title}}" />
<meta property="og:image:url" content="{{$getBlogDetail->getBlogImageUrl()}}" />
<meta name="title" content="{{$getBlogDetail->seo_title}}"/>
<meta name="description" content="{{$getBlogDetail->seo_description}}"/>
<meta name="keywords" content="{{$getBlogDetail->seo_keyword}}"/>
<link rel="canonical" href="{{\URL::current()}}" />
@endsection
@section('content')
<div class="content-wrapper">
  <div class="header-spacer"></div>
  <div class="stunning-header stunning-header-bg-lightviolet">
    <div class="stunning-header-content">
      <h1 class="stunning-header-title">{!! \Str::limit($getBlogDetail->name, $limit = 25, $end = '...') !!}</h1>
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="{{route('front.home')}}">Home</a>
          <i class="seoicon-right-arrow"></i>
        </li>
        <li class="breadcrumbs-item active">
          <a href="{{route('front.blog.list')}}">Blog</a>
          <i class="seoicon-right-arrow"></i>
        </li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="row medium-padding120">
      <main class="main">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <article class="hentry post post-standard-details">
            <div class="post-thumb">
              <img src="{{$getBlogDetail->getBlogImageUrl()}}" alt="{{$getBlogDetail->name}}" alt="seo">
            </div>
            <div class="post__content">
              <h2 class="h2 post__title entry-title ">
                <a href="{{route('front.blog.details',$getBlogDetail->slug)}}">{{$getBlogDetail->name}}</a>
              </h2>
              <div class="post-additional-info">
                <div class="post__author author vcard">
                 <i class="icofont-user"></i>
                 Posted by
                 <div class="post__author-name fn">
                  <a href="{{route('front.blog.details',$getBlogDetail->slug)}}" class="post__author-link">{{$getBlogDetail->createdBy->name}}</a></div>
              </div>
              <span class="post__date">
                <i class="seoicon-clock"></i>
                <time class="published" datetime="2016-03-20 12:00:00">
                 {{ date('M-d-Y',strtotime($getBlogDetail->created_at))}}
               </time>
             </span>
              @if(!$getBlogDetail->multipleBlogCategory->isEmpty())
                <span class="category">
                  <i class="seoicon-tags"></i>
                  @foreach($getBlogDetail->multipleBlogCategory as $key=>$v)
                  <a href="{{route('front.category.category_single',$v->category->slug)}}">{{$v->category->name}}</a>
                  @endforeach
                </span>
              @endif
            </div>
            <div class="post__content-info">
              {!! $getBlogDetail->short_description !!}
              {!! $getBlogDetail->long_description !!}
              @if($getBlogDetail->is_demo == 1 && $getBlogDetail->demo_url !="")   
                  <div>
                    <center>
                      <a href="{{$getBlogDetail->demo_url}}" target="_blank"><button class="btn btn-small btn--blue  btn-hover-shadow"><strong>View Demo</strong></button></a>
                    </center>
                  </div>
              @endif
            </div>
          </article>
      <div class="blog-details-author">
        <div class="blog-details-author-thumb">
          <img src="{{$settingData->getsettineAuthorImgDynamic()}}" class="authorimg"  alt="{{ $settingData->author_name ? $settingData->author_name : ''}}">
        </div>
        <div class="blog-details-author-content">
          <div class="author-info">
            <h5 class="author-name">{{ $settingData->author_name ? $settingData->author_name : ''}}</h5>
            <p class="author-info">Author</p>
          </div>
            @if(isset($setting->author_description_one) && !empty($setting->author_description_one))
              <p class="text">
                {{$setting->author_description_one}}
              </p>
            @endif
        </div>
      </div>
      <div class="pagination-arrow">
        @if($nextPageUrl != null)
        <a href="{{route('front.blog.details',$nextPageUrl->slug)}}" class="btn-prev-wrap">
          <svg class="btn-prev">
            <use xlink:href="#arrow-left"></use>
          </svg>
          <div class="btn-content">
            <div class="btn-content-title">Previous Post</div>
            <p class="btn-content-subtitle">{!! \Str::limit($nextPageUrl->name, $limit = 25, $end = '...') !!}</p>
          </div>
        </a>
        @endif
        @if($prevPageUrl != null)
        <a href="{{route('front.blog.details',$prevPageUrl->slug)}}" class="btn-next-wrap">
          <div class="btn-content">
            <div class="btn-content-title">Next Post</div>
            <p class="btn-content-subtitle">{!! \Str::limit($prevPageUrl->name, $limit = 25, $end = '...') !!}</p>
          </div>
          <svg class="btn-next">
            <use xlink:href="#arrow-right"></use>
          </svg>
        </a>
        @endif
      </div>
    </div>
    @include('front.common.blog-sidebar')
  </main>
</div>
</div>
</div>
<script async src="https://platform-api.sharethis.com/js/sharethis.js#property=5ece7228606f5b0012eb58ed&product=sticky-share-buttons"></script>
@endsection
@section('javascript')
<link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/css/prism.css">
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/js/prism.js"></script>
<script>
  var blog_id = "{{\Crypt::encrypt($getBlogDetail->id)}}";
  $.ajax({
      type: 'post',
      url: '{{route("front.blog.total_view_count")}}',
      data: {
       "_token": "{{ csrf_token() }}",blog_id:blog_id,
      },
      success: function (response) {
      }
  });
</script>
@endsection

