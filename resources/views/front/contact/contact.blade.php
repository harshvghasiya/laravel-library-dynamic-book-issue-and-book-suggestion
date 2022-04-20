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
  @include('front.pages.common_banner_section',['cmsPageDetail'=>$cmsPageDetail])
  <div class="container-fluid">
    <div class="row medium-padding80 bg-border-color contacts-shadow">
      <div class="container">
        <div class="row">
          <div class="contacts">
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
              <div class="contacts-item">
                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/contact7.png" alt="phone">
                <div class="content">
                  <a href="#" class="title">Bhavnagar,India</a>
                  <p class="sub-title">155,Vijayrajnagar</p>
                </div>
              </div>
            </div>
            @if(isset($setting) && !empty($setting->email))
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
              <div class="contacts-item">
                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/contact8.png" alt="phone">
                <div class="content">
                  <a  href="mailto:info@softtechover.com" class="title">info@softtechover.com</a>
                  <a  class="sub-title" href="mailto:{{$setting->second_email}}" class="title">{{$setting->second_email}}</a>
                </div>
              </div>
            </div>
            @endif 
            @if(isset($setting) && !empty($setting->mobile))
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
              <div class="contacts-item">
                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/contact9.png" alt="phone">
                <div class="content">
                  <a href="tel:+{{$setting->mobile}}" class="title">{{$setting->mobile}}</a>
                  <p class="sub-title">Mon-Fri 9am-6pm</p>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section">
    <div id="map"></div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat:{{$setting->address_latitude}}, lng: {{$setting->address_longitude}}},
          zoom: 12,
          scrollwheel: false
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBESxStZOWN9aMvTdR3Nov66v6TXxpRZMM&callback=initMap"
    async defer></script>
  </div>
  <div class="container">
    <div class="contact-form medium-padding120">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="heading">
            <h4 class="heading-title">Have You Any Questions?</h4>
            <div class="heading-line">
              <span class="short-line"></span>
              <span class="long-line"></span>
            </div>
            <p class="heading-text">Please contact us using the form and we’ll get back to you as soon as possible.</p>
          </div>
        </div>
      </div>
      {{
        Form::open([
          'id'=>'contactUsPageHome',
          'class'=>'FromSubmit',
          'url'=>route('front.contact_us.store'),
          'data-redirect_url'=>route('front.home'),
          'name'=>'contactus',
          'role' =>'form',
          'enctype' =>"multipart/form-data",
        ])
      }}
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
          <input name="name" class="input-standard-grey form-control" placeholder="Your Name" type="text" >
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
          <input name="email" class=" input-standard-grey form-control" placeholder="Email Address" type="email" >
        </div>
      </div></br>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group" >
          <input name="subject" class=" input-standard-grey form-control" placeholder="Subject" type="text" >
        </div>
      </div><br>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
          <textarea name="message" class=" input-standard-grey form-control" placeholder="Message"></textarea>
        </div>
      </div><br>  
      @if(env('Is_CAPTCHA_SHOW')) 
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="g-recaptcha" id="feedback-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY')  }}"></div>
        </div>
      </div><br>
      @endif
      <div class="row">
        <div class="submit-block table">
          <div class="col-lg-3 table-cell">
            <button type="submit" class="btn btn-small btn--primary">
              Submit Now
            </button>
          </div>
          <div class="col-lg-5 table-cell">
            <div class="submit-block-text">
              Please, let us know any particular things to check and the best time
              to contact you by Email (if provided).
            </div>
          </div>
        </div>
      </div>
      {{ Form::close()}}
      <div class="error" id="contactUsPageHome1" style="color: red;"> </div>
    </div>
  </div>
  <style>
    .error {
      color: red; 
    }  
  </style>
</div>
@include('layouts.flashmessage')
@endsection
@section('javascript')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
  $(document).ready(function() {
    $("#contactUsPageHome").validate({
      rules: {
        name: "required",
        email: "required",
        message: "required",
        subject: "required",
      },
      messages: {
        name: { required: "{{trans('lang_data.name_required')}}"},
        email: { required: "{{trans('lang_data.please_enter_your_email_address_label')}}"},
        message: { required: "{{trans('lang_data.message_required')}}"},
        subject: { required: "{{trans('lang_data.subject_required')}}"},
      }
    });
  });
</script>
@endsection

