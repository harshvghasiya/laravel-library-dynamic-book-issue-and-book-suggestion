@if(isset($blogList) && !$blogList->isEmpty())
@foreach($blogList as $key=>$blog)
<article class="hentry post post-standard has-post-thumbnail sticky">
  <div class="post-thumb">
    <img src="{{$blog->getBlogImageUrl('medium_')}}" alt="{{$blog->name}}" alt="seo">
    <div class="overlay"></div>
    <a href="{{$blog->getBlogImageUrl('medium_')}}"  class="link-image js-zoom-image">
      <i class="seoicon-zoom"></i>
    </a>
    <a href="{{route('front.blog.details',$blog->slug)}}" class="link-post">
      <i class="seoicon-link-bold"></i>
    </a>
  </div>
  <div class="post__content">
    <div class="post__author author vcard">
      <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/avatar6.png" alt="author">
      Posted by
      <div class="post__author-name fn">
        <a href="#" class="post__author-link">{{$blog->createdBy->name}}</a>
      </div>
    </div>
    <div class="post__content-info">
      <h2 class="post__title entry-title ">
        <a href="{{route('front.blog.details',$blog->slug)}}">{{$blog->name}}</a>
      </h2>
      <div class="post-additional-info">
        <span class="post__date">
          <i class="seoicon-clock"></i>
          <time class="published" datetime="2016-04-17 12:00:00">
           {{ date('M-d-Y',strtotime($blog->created_at))}}
         </time>
       </span>
       <span class="category">
        <i class="seoicon-tags"></i>
        @if(!$blog->multipleBlogCategory->isEmpty())
        @foreach($blog->multipleBlogCategory as $key=>$v)
        <a href="{{route('front.category.category_single',$v->category->slug)}}" class="post-cata cata-sm">{{$v->category->name}}</a>
        @endforeach
        @endif
      </span>
    </div>
    <p class="post__text">
      {!! \Str::limit($blog->short_description, $limit = 225, $end = '...') !!}
    </p>
    <a href="{{route('front.blog.details',$blog->slug)}}" class="btn btn-small btn--dark btn-hover-shadow">
      <span class="text">Continue Reading</span>
      <i class="seoicon-right-arrow"></i>
    </a>
  </div>
</div>
</article>
@endforeach
  <div class="blog-pagination">
    {!! $blogList->links() !!}
  </div>
  </div>
  @else
  <h3 class="data_not_found">Data not found !!</h3>    
  @endif
