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
  @if(Request::has('search'))  
  <div class="stunning-header stunning-header-bg-lightviolet">
    <div class="stunning-header-content">
      <h1 class="stunning-header-title">Search Blog</h1>
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="index.html">Home</a>
          <i class="seoicon-right-arrow"></i>
        </li>
        <li class="breadcrumbs-item active">
          <span href="#">Search Blog</span>
          <i class="seoicon-right-arrow"></i>
        </li>
      </ul>
    </div>
  </div>
  @else
  <div class="stunning-header stunning-header-bg-lightviolet">
    <div class="stunning-header-content">
      <h1 class="stunning-header-title">Blog</h1>
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="{{ route('front.home') }}">Home</a>
          <i class="seoicon-right-arrow"></i>
        </li>
        <li class="breadcrumbs-item active">
          <span href="#">Blog</span>
          <i class="seoicon-right-arrow"></i>
        </li>
      </ul>
    </div>
  </div>
  @endif
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
    $(document).on('click', '.pagination a', function(event){
      event.preventDefault(); 
      var page = $(this).attr('href').split('page=')[1];
      fetch_data(page);
      $('html, body').animate({scrollTop:50}, 'slow');    
    });
    function fetch_data(page)
    {   
      var search = "{{\Request::get('search')}}";
      var routeName =  "{{\Request::route()->getName()}}";
      $.ajax({
       url:"{{route('front.home.blog_ajax')}}?page="+page,
       data:{"_token": "{{ csrf_token() }}",search:search,routeName:routeName},
       success:function(data)
       {
        $('#latest_all_blog').html(data);
       }
      });
    }
    fetch_data(1)
});
</script>
@endsection
