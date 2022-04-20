@extends('layouts.app')
@section('title')
@if(isset($title) && $title !="")
<title>{{$title}} - {{trans('lang_data.softtechover_com_label')}}</title>
@else
<title>{{trans('lang_data.welcome_to_softtechover_com')}}</title>
@endif 
@endsection
@section('style')
<style>
    li.main_menu a {
        color: #00aff0;
        margin-bottom: 5px;
    }
    li.sub_menu_site_map {
        margin-left: 13px;
        margin-bottom: 5px;
    }
    li.sub_menu_site_map a {
        margin-left: 13px;
        color: black !important;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
  <div class="header-spacer"></div>
  <div class="stunning-header stunning-header-bg-lightviolet">
    <div class="stunning-header-content">
        <h1 class="stunning-header-title">SiteMap</h1>
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="{{route('front.home')}}">Home</a>
          <i class="seoicon-right-arrow"></i>
      </li>
      <li class="breadcrumbs-item active">
          <a href="">SiteMap</a>
          <i class="seoicon-right-arrow"></i>
      </li>
  </ul>
</div>
</div>
<div class="container">
 <div class="service_section service_content full-width-service">
    <div class="container">
        <h2>{!! $cmsPageDetail->secondary_title !!}</h2>
        <div class="clear"></div>
        {!! $cmsPageDetail->long_description !!}
        <?php 
        $getAll = false;
        $category = ALL_CATEGORY_LISTING($getAll);
        ?>
        <ul>
            <li class="main_menu"><a href="{{route('front.home')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;Home</a></li>
            @if(isset($headerSectionLink) && !$headerSectionLink->isEmpty())
            @foreach($headerSectionLink as $key=>$v)
            @if($v->id != \App\Models\Cms::SITE_MAP_CONSTANT)
            <li class="main_menu"><a href="{{route('front.cms.details',$v->slug)}}"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;{{$v->name}}</a></li>
            @if($v->id == \App\Models\Cms::CONST_SERVICE_PAGE)
            <?php $getAllService = getSingleCmsAppChildPages(\App\Models\Cms::CONST_SERVICE_PAGE); ?>
            @if(isset($getAllService) && $getAllService != null && !$getAllService->multipleCmsPage->isEmpty())
            <ul>
                @foreach($getAllService->multipleCmsPage as $key=>$v)
                <li class="sub_menu_site_map"><a href="{{route('front.cms.details',$v->slug)}}"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;{{$v->name}}</a></li>
                @endforeach
            </ul>
            @endif
            @endif
            @endif
            @endforeach
            @endif
            @if(isset($category) && !$category->isEmpty())
            <li class="main_menu"><a href="{{route('front.category.get_all_category')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;Categories</a>
                <ul>
                    @foreach($category as $key=>$v)
                    <li class="sub_menu_site_map"><a href="{{route('front.category.category_single',$v->slug)}}"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;{{$v->name}}</a></li>
                    @endforeach
                </ul>
            </li>
            @endif
        </ul>
    </div>
</div></div>
</div>
</div>
@include('layouts.flashmessage')
@endsection
@section('javascript')
@endsection
