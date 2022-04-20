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
<div class="content-wrapper">
    <div class="header-spacer"></div>
  <div class="stunning-header stunning-header-bg-olive">
    <div class="stunning-header-content">
      <h1 class="stunning-header-title">Portfolio</h1>
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="{{route('front.home')}}">Home</a>
          <i class="seoicon-right-arrow"></i>
        </li>
        <li class="breadcrumbs-item active">
          <span href="#">Portfolio</span>
          <i class="seoicon-right-arrow"></i>
        </li>
      </ul>
    </div>
  </div>
  <div class="overlay_search">
    <div class="container">
      <div class="row">
        <div class="form_search-wrap">
          <form>
            <input class="overlay_search-input" placeholder="Type and hit Enter..." type="text">
            <a href="#" class="overlay_search-close">
              <span></span>
              <span></span>
            </a>
          </form>
        </div>
      </div>
    </div>
  </div>
 @include('front.common.portfolio')
</div>
@endsection
@section('javascript')
@endsection
