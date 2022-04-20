@extends('layouts.app')
@section('title')
@if(isset($title) && $title !="")
<title>{{$title}}</title>
@else
<title>{{trans('lang_data.welcome_to_softtechover_com')}}</title>
@endif 
@endsection
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
  <div class="header-spacer"></div>
  <div class="container-full-width">
    <div class="swiper-container main-slider" data-effect="fade" data-autoplay="4000">
      <div class="swiper-wrapper">
        @php
        $color=['primary','green','orange','secondary'];
        @endphp
        @if(!$ourTopWebDevelopmentSolution->multipleCmsPage->isEmpty())
        @foreach($ourTopWebDevelopmentSolution->multipleCmsPage as $key=>$value)
        <div class="swiper-slide bg-{{$color[$key]}}-color main-slider-bg-dark">
          <div class="container table">
            <div class="row table-cell">
              <div class="col-lg-6 table-cell">
                <div class="slider-content">
                  <h3 class="h1 slider-content-title c-dark" data-swiper-parallax="-100">{{$value->name}}
                  </h3>
                  <h5 class="slider-content-text" data-swiper-parallax="-200">{!! $value->short_description !!}
                  </h5>
                  <div class="main-slider-btn-wrap" data-swiper-parallax="-300">        
                  </div>
                </div>
              </div>
              <div class="col-lg-6 table-cell">
                <div class="slider-thumb" data-swiper-parallax="-300" data-swiper-parallax-duration="500">
                  <img src="{{$value->getCmsImageUrl()}}" alt="slider">
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @endif
      </div>
      <svg class="btn-next btn-next-black">
        <use xlink:href="#arrow-right"></use>
      </svg>
      <svg class="btn-prev btn-prev-black">
        <use xlink:href="#arrow-left"></use>
      </svg>
      <div class="slider-slides">
       @if(!$ourTopWebDevelopmentSolution->multipleCmsPage->isEmpty())
       @foreach($ourTopWebDevelopmentSolution->multipleCmsPage as $key=>$value)
       <a href="#" class="slides-item  bg-{{$color[$key]}}-color">
        <div class="content">
          <div class="text-wrap">
            <h4 class="slides-title">{{$value->name}}</h4>
          </div>
          <div class="slides-number">0{{$key}}</div>
        </div>
      </a>
      @endforeach
      @endif
    </div>
  </div>
</div>
@include('front.common.we-working-on')
<div class="container-fluid">
  <div class="row pt80">
    <div class="testimonial-slider scrollme">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 col-lg-offset-1 col-md-8 col-sm-12 col-xs-12">
            <div class="testimonial-item">
              <div class="swiper-container testimonial__thumb overflow-visible" data-effect="fade" data-loop="false">
                <div class="swiper-wrapper">
                  <div class="testimonial-slider-item swiper-slide">
                    <div class="testimonial-content">
                      <h2 class="text" data-swiper-parallax="-200">Why Choose Softechover ??</h2>
                      <p class="text" data-swiper-parallax="-200">Top Indian Web Design and Development Services Company,
                      </p>
                      <a href="{{route('front.home')}}" class="author" data-swiper-parallax="-150">SofttechOver</a>
                    </div>
                    <div class="avatar" data-swiper-parallax="-50">
                      <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/avatar.png" alt="avatar">
                    </div>
                  </div>
                  <div class="testimonial-slider-item swiper-slide">
                    <div class="testimonial-content">
                      <p class="text" data-swiper-parallax="-200">Providing Web Solutions at Affordable Cost
                        In the advanced era of technology, it’s very vital to generate online presence to stay ahead in the business market,
                      </p>
                      <a href="{{route('front.home')}}" class="author" data-swiper-parallax="-150">SofttechOver</a>
                    </div>
                    <div class="avatar" data-swiper-parallax="-50">
                      <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/avatar.png" alt="avatar">
                    </div>
                  </div>
                  <div class="testimonial-slider-item swiper-slide">
                    <div class="testimonial-content">
                      <p class="text" data-swiper-parallax="-200">For this purpose, having an eye-catching and SEO friendly business website is very crucial. The reason is that it is one of the best methods to promote your company’s products and services online,
                      </p>
                      <a href="{{route('front.home')}}" class="author" data-swiper-parallax="-150">SofttechOver</a>
                    </div>
                    <div class="avatar" data-swiper-parallax="-50">
                      <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/avatar.png" alt="avatar">
                    </div>
                  </div>
                  <div class="testimonial-slider-item swiper-slide">
                    <div class="testimonial-content">
                      <p class="text" data-swiper-parallax="-200"> This can be accomplished by getting a website developed that features those products and services. We are a design and development company having clients located all over the globe.
                      </p>
                      <a href="{{route('front.home')}}" class="author" data-swiper-parallax="-150">SofttechOver</a>
                    </div>
                    <div class="avatar" data-swiper-parallax="-50">
                      <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/avatar.png" alt="avatar">
                    </div>
                  </div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="quote">
                  <i class="seoicon-quotes"></i>
                </div>
              </div>
              <div class="testimonial__thumb-img">
                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/testimonial1.png" alt="image">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@if(isset($bestWebDevelopmentCompany) && $bestWebDevelopmentCompany !=null)
<div class="container-fluid background-mountains  scrollme">
 <div class="images">
  <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/mountain1.png" alt="mountain">
  <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/mountain2.png" alt="mountain">
</div>
<div class="container">
  <div class="row pt100">
    <div class="col-lg-12">
      <div class="heading">
        <h4 class="h2 heading-title">{{$bestWebDevelopmentCompany->name}}</h4>
        <div class="heading-line">
          <span class="short-line"></span>
          <span class="long-line"></span>
        </div>
        <p class="heading-text">{!! $bestWebDevelopmentCompany->long_description !!}
        </p>
      </div>
    </div>
  </div>
</div>
</div>
@endif
<div class="container-fluid">
  <div class="row">
    <div class="background-mountains medium-padding120 scrollme">
      <div class="images">
        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/mountain1.png" alt="mountain">
        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/mountain2.png" alt="mountain">
      </div>
      <div class="container">
        <div class="row">
         @if(isset($clientIndustry) && $clientIndustry !=null)
         <div class="col-md-offset-2 col-sm-12 col-xs-12">
          <div class="heading align-center">
            <h4 class="h1 heading-title">{{$clientIndustry->name}}</h4>
            <div class="heading-line">
              <span class="short-line"></span>
              <span class="long-line"></span>
            </div>
            <p class="heading-text"> 
              @if(!empty($clientIndustry->short_description))
              {!! $clientIndustry->short_description !!}
              @endif
              @if(!empty($clientIndustry->long_description))
              {!! $clientIndustry->long_description !!} 
              @endif
            </p>
          </div>
        </div>
        @endif
      </div>
      <div class="row">
        @if(!$clientIndustry->multipleCmsPage->isEmpty())
        @foreach($clientIndustry->multipleCmsPage as $key=>$v)
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="info-box--standard-centered client_box">
            <div class="info-box-image">
              <img src="{{$v->getCmsImageUrl()}}" class="client_icon"  alt="{{$v->name}}">
            </div>
          </div>
          <h4 class="info-box-title client_title">{{$v->name}}</h4>
        </div>
        @endforeach
        @endif
      </div>
    </div>
  </div>
</div>
</div>
<div class="container-fluid">
  <div class="row bg-green-color">
    <div class="container">
     @if(isset($wecreatedMoreThan) && $wecreatedMoreThan !=null)
     <h3  style="color: #fffafa;" class="mt60">We've created more than <span>25+ Websites and Apps</span> in past year!
      @if(!empty($wecreatedMoreThan->long_description))
      {!! $wecreatedMoreThan->long_description !!}</h3>
      @endif
      @endif
      <div class="row">
        <div class="counters">
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="counter-item">
              <div class="counter-numbers counter">
                <span data-speed="2000" data-refresh-interval="3" data-to="96" data-from="2">96%</span>
                <div class="units">%</div>
              </div>
              <span class="counter-title">Client Retention</span>
              <div class="counter-line">
                <span class="short-line"></span>
                <span class="long-line"></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="counter-item">
              <div class="counter-numbers counter">
                <span data-speed="2000" data-refresh-interval="3" data-to="10" data-from="0">10</span>
              </div>
              <span class="counter-title">Years of Service</span>
              <div class="counter-line">
                <span class="short-line"></span>
                <span class="long-line"></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="counter-item">
              <div class="counter-numbers counter">
                <span data-speed="2000" data-refresh-interval="3" data-to="70" data-from="2">230+</span>
                <div class="units">+</div>
              </div>
              <span class="counter-title">Professionals</span>
              <div class="counter-line">
                <span class="short-line"></span>
                <span class="long-line"></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="counter-item">
              <div class="counter-numbers counter">
                <span data-speed="2000" data-refresh-interval="3" data-to="690" data-from="400">690+</span>
                <div class="units">+</div>
              </div>
              <span class="counter-title">Satisfied Clients</span>
              <div class="counter-line">
                <span class="short-line"></span>
                <span class="long-line"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row medium-padding80">
    <div class="recent-case align-center">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
            <div class="heading align-center">
              <h4 class="h1 heading-title">Our Recent Works</h4>
              <div class="heading-line">
                <span class="short-line"></span>
                <span class="long-line"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="case-item-wrap">
            @foreach($portfolio as $key=>$v)
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="case-item">
                <div class="case-item__thumb">
                  <a @if($v->url != null) target="_blank" href="{{$v->url}}" @else href="{{$v->getPortfolioImageUrl()}}" data-gall="portfolioGallery" class="venobox preview-link" @endif title="{{$v->title}}"><img src="{{$v->getPortfolioImageUrl()}}" alt="{{$v->title}}"></a>
                </div>
                <h6 class="case-item__title"><a @if($v->url !=null) href="{{$v->url}}" @endif>{{$v->title}}</a>
                </h6>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        <a href="{{ route('front.get_port_folio_all') }}" class="btn btn-medium btn--dark">
          <span class="text">All Projects</span>
          <span class="semicircle"></span>
        </a>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row medium-padding80 ">
    <div class="recent-case align-center">
      @if(isset($homePageBox) && $homePageBox !=null)
      @if(!$homePageBox->multipleCmsPage->isEmpty())
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
          <div class="heading align-center">
            <h4 class="h1 heading-title">{{$homePageBox->name}}</h4>
            <div class="heading-line">
              <span class="short-line"></span>
              <span class="long-line"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        @php $img=[20,21,22] @endphp
        @foreach($homePageBox->multipleCmsPage as $key=>$v)
        <div class="col-lg-4 col-md-4 col-sm-12 col-sx-12">
          <div class="info-box--standard">
            <div class="info-box-image f-none">
              <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/info-box{{$img[$key]}}.png" alt="image">
            </div>
            <div class="info-box-content">
              <h5 class="info-box-title">{{$v->name}}</h5>
              <p class="text">{!! $v->short_description !!}
              </p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
      @endif
    </div>
  </div>
</div>
@endsection
