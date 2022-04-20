<div class="top-bar top-bar-dark">
  <div class="container">
    <div class="top-bar-contact">
      @if(isset($setting) && !empty($setting->mobile))
      <div class="contact-item">
       <a href="tel:+91{{$setting->email}}">{{$setting->mobile}}</a>
     </div>
     @endif
     @if(isset($setting) && !empty($setting->email))
     <div class="contact-item">
      <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
    </div>
    @endif
    
    @if(isset($setting) && !empty($setting->second_email))
    <div class="contact-item">
      <a href="mailto:{{$setting->second_email}}">{{$setting->second_email}}</a>
    </div>
    @endif
  </div>
  @if(isset($socialMediaContent) && !$socialMediaContent->isEmpty())
  <div class="follow_us">
    <span>Follow us:</span>
    <div class="socials">
      @foreach($socialMediaContent as $key=>$v)
      <a  href="{{$v->url}}" class="social__item">
        <img src="{{$v->getSocialMediaImageUrl()}}" alt="{{$v->title}}">
      </a>
      @endforeach
    </div>
  </div>
  @endif 
  <a href="#" class="top-bar-close" id="top-bar-close-js">
    <span></span><span></span>
  </a>
</div>
</div>
<header class="header" id="site-header">
  <div class="container">
    <div class="header-content-wrapper">
      <a href="#" id="top-bar-js" class="top-bar-link"><svg class="topbar_icon" viewBox="0 0 330 330">
      <path d="M165 0C74.019 0 0 74.02 0 165.001 0 255.982 74.019 330 165 330s165-74.018 165-164.999S255.981 0 165 0zm0 300c-74.44 0-135-60.56-135-134.999S90.56 30 165 30s135 60.562 135 135.001C300 239.44 239.439 300 165 300z"></path>
      <path d="M164.998 70c-11.026 0-19.996 8.976-19.996 20.009 0 11.023 8.97 19.991 19.996 19.991 11.026 0 19.996-8.968 19.996-19.991 0-11.033-8.97-20.009-19.996-20.009zM165 140c-8.284 0-15 6.716-15 15v90c0 8.284 6.716 15 15 15 8.284 0 15-6.716 15-15v-90c0-8.284-6.716-15-15-15z"></path>
    </svg></a>
    <div class="logo">
      <a href="{{route('front.home')}}" class="full-block-link"></a>
      <img src="{{$setting->getSettingLogoImageUrl()}}" alt="{{trans('lang_data.app_name')}}"  class="img-fluid logo_img">
    </div>
    <nav id="primary-menu" class="primary-menu">
      <a href='javascript:void(0)' id="menu-icon-trigger" class="menu-icon-trigger showhide">
        <span id="menu-icon-wrapper" class="menu-icon-wrapper" style="visibility: hidden">
          <svg width="1000px" height="1000px">
            <path id="pathD" d="M 300 400 L 700 400 C 900 400 900 750 600 850 A 400 400 0 0 1 200 200 L 800 800"></path>
            <path id="pathE" d="M 300 500 L 700 500"></path>
            <path id="pathF" d="M 700 600 L 300 600 C 100 600 100 200 400 150 A 400 380 0 1 1 200 800 L 800 200"></path>
          </svg>
        </span>
      </a>
     
     <ul class="primary-menu-menu">
       @php      
       if (\Request::route()->getName() == 'front.home') {
        $homePageActiveClass = 'active';  
      }else{
        $homePageActiveClass ='';
      }
      @endphp
      <li class="menu-item-has-children {{$homePageActiveClass}}">
        <a href="{{route('front.home')}}">Home</a>
      </li>
      @if(isset($menuLinks) && !$menuLinks->isEmpty())
      @foreach($menuLinks as $key=>$v)
      @php 
      if (\Request::route()->getName() == 'front.cms.details' && \Request::segment(1) == $v->menuitem->slug) {
        $cmsActiveClass = 'class=active'; 
      }else{
        $cmsActiveClass ='';
      }
      @endphp
      @if(isset($v->children_id) &&$v->children_id != null)
      <li {{$cmsActiveClass}}><a @if($v->menuitem->target == 2) target="_blank" @endif @if( $v->menuitem->slug != null && $v->menuitem->target != 3)href="{{route('front.cms.details',$v->menuitem->slug)}}"@else href="javascript:void();" @endif>{{$v->menuitem->name}}</a>
        <ul class="dropdown">
          @foreach(json_decode($v->children_id) as $k=>$val)
          <li class="hover-ver2">
            <a @if($val->target == 2) target="_blank" @endif @if( $val->slug != null && $val->target != 3) href="{{route('front.cms.details',$val->slug)}}" @else href="javascript:void();" @endif>
              {{$val->name}}
            </a>
          </li>
          @endforeach
        </ul>
      </li>
      @else

      <li {{$cmsActiveClass}}><a @if($v->menuitem->target == 2) target="_blank" @endif @if( $v->menuitem->slug != null && $v->menuitem->target != 3)href="{{route('front.cms.details',$v->menuitem->slug)}}"@else href="javascript:void();" @endif>{{$v->menuitem->name}}</a></li>
      @endif             
      @endforeach
      @endif
    </ul>
  </nav>

  <div class="user-menu open-overlay">
    <a href="#" class="user-menu-content  js-open-aside">
      <span></span>
      <span></span>
      <span></span>
    </a>
  </div>
</div>
</div>
</header>
<div class="mCustomScrollbar" data-mcs-theme="dark">
  <div class="popup right-menu">
    <div class="right-menu-wrap">
      <div class="user-menu-close js-close-aside">
        <a href="#" class="user-menu-content  js-clode-aside">
          <span></span>
          <span></span>
        </a>
      </div>
      <div class="logo">
        <a href="{{route('front.home')}}" class="full-block-link"></a>
        <img src="{{$setting->getSettingLogoImageUrl()}}" class="logo_img" alt="Softtechover">
      </div>
      <h5 class="title">Generate online presence to rule on the digital world.
      </h5><br>
      <p class="text">As we provide different types of web app projects to our clients, every business has become
        familiar with our brand. We are the first choice when it comes to developing websites and web
        app solutions as we provide low price website design in India. As a web site design and
        development company in India we provide front-end development services, web design and
      web development services in India.</p>
    </div>
    <div class="widget contacts">
      <h4 class="contacts-title">Get In Touch</h4>
      <div class="contacts-item">
        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/contact4.png" alt="phone">
        <div class="content">
          <a href="tel:+91{{$setting->mobile}}" class="title">{{$setting->mobile}}</a>
          <p class="sub-title">Mon-Fri 9am-6pm</p>
        </div>
      </div>
      <div class="contacts-item">
        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/contact5.png" alt="phone">
        <div class="content">
          <a href="mailto:{{$setting->email}}" class="title">{{$setting->email}}</a>
          <a href="mailto:{{$setting->second_email}}" class="sub-title">{{$setting->second_email}}</a>   
        </div>
      </div>
      <div class="contacts-item">
        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/contact6.png" alt="phone">
        <div class="content">
          <a href="#" class="title">{{$setting->second_address}}</a>
        </div>
      </div>
    </div>
  </div>
</div>