@php
$portfolio = \App\Models\Portfolio::with('category')->where('status',\App\Models\Portfolio::STATUS_ACTIVE)
->inRandomOrder()->get();
$PortfolioCategory = \App\Models\PortfolioCategory::with(['portfolio'])
->where('status',\App\Models\PortfolioCategory::STATUS_ACTIVE)
->has('portfolio')
->get();
@endphp
<div class="container">
  <div class="row medium-padding120">
    <div class="col-lg-12">
      <div class="heading align-center">
        <h4 class="h1 heading-title">Our Recent Works</h4>
      </div>
      <ul class="cat-list align-center sorting-menu">
        <li class="cat-list__item active" data-filter="*"><a href="#" class="">All Projects</a></li>
        @if(isset($PortfolioCategory) && !$PortfolioCategory->isEmpty())
        @foreach($PortfolioCategory as $key=>$v)
        <li class="cat-list__item" data-filter=".filter-{{$v->slug}}"><a href="#" class="">{{$v->name}}</a></li>  
        @endforeach
        @endif
      </ul>
      <div class="row sorting-container" data-layout="fitRows">
        <div class="grid-sizer col-lg-4 col-md-4"></div>
        @foreach($portfolio as $key=>$v)
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 sorting-item filter-{{$v->category->slug}}" style="position: absolute; left: 0%; top: 1081.59px;">
          <div class="case-item align-center mb60">
            <div class="case-item__thumb mouseover lightbox shadow animation-disabled">
              <a  @if($v->url != null) target="_blank" href="{{$v->url}}" @else href="{{$v->getPortfolioImageUrl()}}" data-gall="portfolioGallery" class="venobox preview-link" @endif title="{{$v->title}}"><img src="{{$v->getPortfolioImageUrl()}}" alt="{{$v->title}}"></a>
            </div>
            <h6 class="case-item__title">
              <a target="_blank" @if($v->url !=null) href="{{$v->url}}" @endif>{{$v->title}}</a>
            </h6>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>