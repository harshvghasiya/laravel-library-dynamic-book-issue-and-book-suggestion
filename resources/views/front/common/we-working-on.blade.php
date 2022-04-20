 @php 
 $technology = \App\Models\Technology::where('status',\App\Models\Technology::STATUS_ACTIVE)->get();
 @endphp 
 @if(isset($technology) && !$technology->isEmpty())
 <div class="container-fluid info-boxes pt100">
  <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
    <div class="heading align-center">
      <h4 class="h2 heading-title">{{$ourMostPopularWebPlatFrom->name}}</h4>
      <div class="heading-line">
        <span class="short-line"></span>
        <span class="long-line"></span>
      </div>
      <p class="heading-text"> 
       @if(!empty($ourMostPopularWebPlatFrom->short_description))
       {!! $ourMostPopularWebPlatFrom->short_description !!}
       @endif
     </p>
   </div>
 </div>
 <div class="container">
  <div class="row">
    @foreach($technology as $key=>$v)
    @if(!empty($v->font_icon))
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <div class="info-box--standard" data-mh="info-boxes" style="display: flex;">
        <div class="info-box-image">
          <i class="{{$v->font_icon}} dev_iconnn" title="{{$v->title}}"></i>
        </div>
        <div class="info-box-content">
          <h6 class="info-box-title" style="font-weight: bold;">{{$v->title}}</h6>
        </div>
      </div>
    </div>
    @endif
    @endforeach
  </div>
</div>
</div>
@endif