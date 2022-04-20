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
  <div class="stunning-header stunning-header-bg-lightviolet">
    <div class="stunning-header-content">
      <h1 class="stunning-header-title">{{$checkCategoryExit->name}}</h1>
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="{{route('front.home')}}">Home</a>
          <i class="seoicon-right-arrow"></i>
        </li>
        <li class="breadcrumbs-item active">
          <span href="#">{{trans('lang_data.category_label')}}</span>
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
  <div class="container">
    <div class="row medium-padding120">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <main class="main">
          <div id="latest_all_blog"></div>
        </main>
      </div>
      @include('front.common.blog-sidebar')
    </div>
  </div>
</div>
@endsection
@section('javascript')
<script>
  $(document).ready(function(){
    fetch_data(1);
    $(document).on('click', '.pagination a', function(event){
      event.preventDefault(); 
      var page = $(this).attr('href').split('page=')[1];
      fetch_data(page);
      $('html, body').animate({scrollTop:50}, 'slow');
    });
    function fetch_data(page)
    {   
      var categorySlug = "{{$categorySlug}}";
      $.ajax({
       url:"{{route('front.category.single_pagination_all_blog')}}?page="+page,
       data:{"_token": "{{ csrf_token() }}",categorySlug:categorySlug},
       success:function(data)
       {
        $('#latest_all_blog').html(data);
      }
    });
    }
  });
</script>
@endsection