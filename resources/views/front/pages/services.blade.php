@extends('layouts.app')
@section('title')
@if(isset($title) && $title !="")
<title>{{$title}} - {{trans('lang_data.softtechover_com_label')}}</title>
@else
<title>{{trans('lang_data.welcome_to_softtechover_com')}}</title>
@endif 
@endsection
@section('style')
@endsection
@section('content')
@if(isset($getAllService) && $getAllService != null && !$getAllService->multipleCmsPage->isEmpty())
<div class="content-wrapper">
  <div class="header-spacer"></div>
  <div class="stunning-header stunning-header-bg-rose">
    <div class="stunning-header-content">
      <h1 class="stunning-header-title">Services</h1>
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="{{route('front.home')}}">Home</a>
          <i class="seoicon-right-arrow"></i>
        </li>
        <li class="breadcrumbs-item active">
          <span href="#">Services</span>
          <i class="seoicon-right-arrow"></i>
        </li>
      </ul>
    </div>
  </div>
  @foreach($getAllService->multipleCmsPage as $key=>$v)
  @php 
  $lastKey = $getAllService->multipleCmsPage->reverse()->keys()->first();
  if (!empty($v->secondary_title)) {
    $title = $v->secondary_title;
  }else{
    $title = $v->name;
  }
  if ($lastKey == $key) {
    $lastkeyClass ='padding-botton-service'; 
  }else{
    $lastkeyClass ="";
  }
  @endphp
  @if($key%2 == 0)
  <div class="container @if($key != 0) second_service @endif">
    <div class="row @if($key == 0) pt120 @endif pb30">
      <div class="col-lg-12">
        <div class="product-description-challenge">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="product-description-thumb">
                <img src="{{$v->getCmsImageUrl()}}" alt="{{$title}}" class="shadow-image">
              </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
              <div class="product-description-content">
                <div class="heading">
                  <h4 class="h1 heading-title">{{$title}}</h4>
                  <div class="heading-line">
                    <span class="short-line"></span>
                    <span class="long-line"></span>
                  </div>
                  <p> {!! \Str::limit($v->short_description, $limit = 450, $end = '...') !!}
                  </p>
                  <p><a class="read_style" href="{{route('front.cms.details',$v->slug)}}" >Read More</a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="product-description-border"></div>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="container">
    <div class="row pt80 pb120">
      <div class="col-lg-12">
        <div class="product-description-solution">
          <div class="row">
            <div class="col-lg-5 col-lg-offset-1 col-md-5 col-md-offset-1 col-sm-12 col-xs-12">
              <div class="product-description-content">
                <div class="heading">
                  <h4 class="h1 heading-title">{{$title}}</h4>
                  <div class="heading-line">
                    <span class="short-line"></span>
                    <span class="long-line"></span>
                  </div>
                  <p>{!! \Str::limit($v->short_description, $limit = 450, $end = '...') !!}
                  </p>
                  <p><a class="read_style" href="{{route('front.cms.details',$v->slug)}}">Read More</a></p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="product-description-thumb">
                <img src="{{$v->getCmsImageUrl()}}" alt="{{$title}}" class="shadow-image">
              </div>
            </div>
          </div>
          <div class="product-description-border"></div>
        </div>
      </div>
    </div>
  </div>
  @endif
  @endforeach
</div>
@endif
@endsection
@section('javascript')
@endsection
