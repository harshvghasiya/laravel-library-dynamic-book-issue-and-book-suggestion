@section('title')
  {{trans('lang_data.dashboard_label')}} | {{trans('lang_data.smart_home_work_label')}}
@endsection
@extends('admin::layouts.master')
@section('content')
<div class="canvas_clock col-md-12" style="float: left;margin-bottom: 20px;">
  <div class="canvas_clock col-md-4" style="float: left">
    <canvas id="canvas" width="400" height="400" style="background-color:#ededed;height:120px;float: left"></canvas>  
  </div>
  <div class="col-md-8">
    <div class="dashboard_heading col-md-12" style="padding-bottom:20px;text-align: left;font-weight: 900;font-size: 26px;margin-top: 45px;">
      <h3>{{trans('lang_data.welcome_to_admin')}}</h3>
    </div>
  </div>
</div>
<div class="container-fluid pt-25">
  <!-- Row -->
  <div class="row">
   <a href="{{route('admin.banners.index')}}">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="panel panel-default card-view pa-0 bg-gradient2">
            <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                <div class="sm-data-box">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-xs-8 text-center pl-0 pr-0 txt-light data-wrap-left">
                        <span class="txt-light block counter"><span class="counter-anim">{{$count['banner']}}</span></span>
                        <span class="weight-500 uppercase-font block">{{trans('lang_data.banner_dashboard_label')}}</span> 
                      </div>
                      <div class="col-xs-4 text-center  pl-0 pr-0 txt-light data-wrap-right">
                        <i class="fa fa-image data-right-rep-icon"></i>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </a>
    <a href="{{route('admin.email-template.index')}}">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="panel panel-default card-view pa-0 bg-gradient3">
            <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                <div class="sm-data-box">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
                        <span class="txt-light block counter"><span class="">{{$count['email']}}</span></span>
                        <span class="weight-500 uppercase-font block font-13 txt-light">{{trans('lang_data.email_management_label')}}</span>
                      </div>
                      <div class="col-xs-4 text-center  pl-0 pr-0 data-wrap-right">
                        <i class="fa fa-envelope data-right-rep-icon txt-light"></i>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </a>
    <a href="{{route('admin.social_medias.index')}}">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="panel panel-default card-view pa-0 bg-gradient1">
            <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                <div class="sm-data-box">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
                        <span class="txt-light block counter"><span class="">{{$count['social']}}</span></span>
                        <span class="weight-500 uppercase-font block font-13 txt-light">{{trans('lang_data.social_media_management_label')}}</span>
                      </div>
                      <div class="col-xs-4 text-center  pl-0 pr-0 data-wrap-right">
                        <i class="fa fa-youtube-square fa-5x data-right-rep-icon txt-light"></i>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </a>
    <a href="{{route('admin.contactus.index')}}">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="panel panel-default card-view pa-0 bg-gradient">
            <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                <div class="sm-data-box">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
                        <span class="txt-light block counter"><span class="">{{$count['contact_us']}}</span></span>
                        <span class="weight-500 uppercase-font block font-13 txt-light">{{trans('lang_data.contactus_label')}}</span>
                      </div>
                      <div class="col-xs-4 text-center  pl-0 pr-0 data-wrap-right">
                        <i class="fa fa-phone data-right-rep-icon txt-light"></i>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
  <div class="row">
    <a href="{{route('admin.category.index')}}">
       <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="panel panel-default card-view pa-0 bg-gradient2">
            <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                <div class="sm-data-box">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-xs-8 text-center pl-0 pr-0 txt-light data-wrap-left">
                        <span class="txt-light block counter"><span class="counter-anim">{{$count['category']}}</span></span>
                        <span class="weight-500 uppercase-font block">{{trans('lang_data.total_category')}}</span> 
                      </div>
                      <div class="col-xs-4 text-center  pl-0 pr-0 txt-light data-wrap-right">
                        <i class="fa fa-tags data-right-rep-icon"></i>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
    </a>
    <a href="{{route('admin.cms.index')}}">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="panel panel-default card-view pa-0 bg-gradient2">
            <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                <div class="sm-data-box">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-xs-8 text-center pl-0 pr-0 txt-light data-wrap-left">
                        <span class="txt-light block counter"><span class="counter-anim">{{$count['cms']}}</span></span>
                        <span class="weight-500 uppercase-font block">{{trans('lang_data.pages_module_label')}}</span> 
                      </div>
                      <div class="col-xs-4 text-center  pl-0 pr-0 txt-light data-wrap-right">
                        <i class="fa fa-book data-right-rep-icon"></i>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>    
    </a>  
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="panel panel-default card-view pa-0 bg-gradient2">
        <div class="panel-wrapper collapse in">
          <div class="panel-body pa-0">
            <div class="sm-data-box">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-8 text-center pl-0 pr-0 txt-light data-wrap-left">
                    <span class="txt-light block counter"><span class="counter-anim">{{$count['setting']}}</span></span>
                    <span class="weight-500 uppercase-font block">{{trans('lang_data.setting_label')}}</span> 
                  </div>
                  <div class="col-xs-4 text-center  pl-0 pr-0 txt-light data-wrap-right">
                    <i class="fa fa-gear fa-5x data-right-rep-icon"></i>
                  </div>
                </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="panel panel-default card-view pa-0 bg-gradient2">
        <div class="panel-wrapper collapse in">
          <div class="panel-body pa-0">
            <div class="sm-data-box">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-8 text-center pl-0 pr-0 txt-light data-wrap-left">
                    <span class="txt-light block counter"><span class="counter-anim">{{$count['newsLetter']}}</span></span>
                    <span class="weight-500 uppercase-font block">{{trans('lang_data.news_letter_label_single')}}</span> 
                  </div>
                  <div class="col-xs-4 text-center  pl-0 pr-0 txt-light data-wrap-right">
                    <i class="fa fa-newspaper-o fa-5x data-right-rep-icon"></i>
                  </div>
                </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascript')
<script>
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 1000);

function drawClock() {
  drawFace(ctx, radius);
  drawNumbers(ctx, radius);
  drawTime(ctx, radius);
}

function drawFace(ctx, radius) {
  var grad;
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2*Math.PI);
  ctx.fillStyle = 'lightgray';
  ctx.fill();
  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
  grad.addColorStop(0, '#333');
  grad.addColorStop(0.5, 'white');
  grad.addColorStop(1, '#333');
  ctx.strokeStyle = grad;
  ctx.lineWidth = radius*0.1;
  ctx.stroke();
  ctx.beginPath();
  ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
  ctx.fillStyle = '#333';
  ctx.fill();
}

function drawNumbers(ctx, radius) {
  var ang;
  var num;
  ctx.font = radius*0.15 + "px arial";
  ctx.textBaseline="middle";
  ctx.textAlign="center";
  for(num = 1; num < 13; num++){
    ang = num * Math.PI / 6;
    ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang);
    ctx.fillText(num.toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
}

function drawTime(ctx, radius){
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    //hour
    hour=hour%12;
    hour=(hour*Math.PI/6)+
    (minute*Math.PI/(6*60))+
    (second*Math.PI/(360*60));
    drawHand(ctx, hour, radius*0.5, radius*0.07);
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.07);
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.02);
}

function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
}
</script>
@endsection
