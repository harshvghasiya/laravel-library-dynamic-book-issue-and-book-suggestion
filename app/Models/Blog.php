<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class Blog extends Model
{

  protected $table="blogs";
  const STATUS_ACTIVE ='1';
  const STATUS_INACTIVE ='0';

    /**
     * [category To get category data with relationship with blog]
     * @return [type] [description]
     */
    public function category(){

      return $this->belongsTo('\App\Models\Category','category_id','id');

    }

    /**
     * [multipleBlogCategory This function will return multiple category of blog relationship]
     * @return [type] [description]
     */
    public function multipleBlogCategory(){

      return $this->hasMany('\App\Models\MultipleCategory','blog_id','id');

    }

    /**
     * [multipleBlogCategory This function will return multiple category of blog relationship]
     * @return [type] [description]
     */
    public function multipleTag(){

      return $this->hasMany('\App\Models\MultipleTag','blog_id','id');

    }

    /**
     * [multipleBlogCategory This function will return multiple category of blog relationship]
     * @return [type] [description]
     */
    public function multipleTagCategory(){

      return $this->hasMany('\App\Models\MultipleTag','blog_id','id');

    }

    /**
     * [createdBy This function will return created of blog user data]
     * @return [type] [description]
     */
    public function createdBy(){

      return $this->belongsTo('\App\Models\User','created_by','id');

    }

    /**
     * [getBlogListData To get blog list data]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getBlogListData($request){


    	$sql=self::with(["category"])->select("*");
      return Datatables::of($sql)
      ->addColumn('action',function($data){

        $string = '<a href="'.route('admin.blogs.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

        if (env('ACCESS_TO_DELETE') == true) {

          $string .='<a href="javascript:void(0)" data-route="'.route('admin.blogs.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
        } 

        if ($data->is_demo == 1) {
          
          $string .='<a target="_blank" href="'.$data->demo_url.'" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>'; 
        }
        return $string;
      })
      ->editColumn('id',function($data){
        return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
      })
      ->editColumn('image',function($data){

        return '<img style="height:50px;width:100px" src="'.$data->getBlogImageUrl().'"/>';
      })
      ->addColumn('status',function($data){
        return getStatusIcon($data);
      })
      ->editColumn('category_id',function($data){

       if (!$data->multipleBlogCategory->isEmpty()) {
        
        $categoryName = "";

        foreach ($data->multipleBlogCategory as $key => $value) {
          
          if ($value->category !=null) {
            
            if ($data->multipleBlogCategory->keys()->last() == $key) {

              $append ="";

            }else{
              $append = ",";
            }
            $categoryName .= $value->category->name.$append;
          }

        }

        return  $categoryName;

      }else{

        return "None";
      }
      return !empty($data->category) ? $data->category->name : "None" ;
    })
      ->filter(function ($query) use ($request) {

        if (isset($request['status']) && $request['status'] != "") {
          $query->where('status', $request['status']);
        }                    

        if (isset($request['show_on_header']) && $request['show_on_header'] != "") {
          $query->where('display_on_header', $request['show_on_header']);
        }

      })
      ->rawColumns(['id','action','status','category_id','image'])
      ->make(true);
    }
    
    /**
     * [saveBlog To save and updatea blog data]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function saveBlog($r,$id=NULL){

    	$errors="";
    	$input = $r->all();
    	if ($id !== NULL) {

        $id=Crypt::decrypt($id);
        $obj = self::find($id);
        $obj->last_updated_by=\Auth::user()->id;

      }else{

       $obj = new self;
       $obj->created_by=\Auth::user()->id;
     }

     if (isset($input['delete_image']) && $input['delete_image'] == 1) {
      
      if ($obj->image !=null) {

        if(file_exists(BLOG_IMAGE_UPLOAD_PATH().$obj->image))
        {
          \File::delete(BLOG_IMAGE_UPLOAD_PATH().$obj->image);
        }
      }
    }

        /*if (isset($input['image']) && !empty($input['image'])) {

            $imageName = UPLOAD_FILE($r,'image',BLOG_IMAGE_UPLOAD_PATH());
            if ($imageName !="") {
              $obj->image = $imageName;
            }
          } */


          if ($r->file('image')) {

            foreach($r->file('image') as $file)
            { 
              $uploadPath = BLOG_IMAGE_UPLOAD_PATH();
              $filenamewithextension = $file->getClientOriginalName();
              
              $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
              
              $extension = $file->getClientOriginalExtension();
              
              //filename to store
              $filenametostore = $filename.'_'.time().'.'.$extension;
              $thumbFilenametostore = 'thumbnail_'.$filenametostore;
              $mediumFilenametostore = 'medium_'.$filenametostore;

              $file->move($uploadPath, $filenametostore);
              copy($uploadPath.'/'.$filenametostore, $uploadPath.'/'.$thumbFilenametostore);
              
              //Resize image here
              $thumbnailpath = BLOG_IMAGE_UPLOAD_PATH().$thumbFilenametostore;
              $img = \Image::make($thumbnailpath)->resize(100,200, function($constraint) {
                $constraint->aspectRatio();
              });
              $img->save($thumbnailpath);
              
              copy($uploadPath.'/'.$filenametostore, $uploadPath.'/'.$mediumFilenametostore);
              
              //Resize image here
              $thumbnailpath = BLOG_IMAGE_UPLOAD_PATH().$mediumFilenametostore;
              $img = \Image::make($thumbnailpath)->resize(800,1200, function($constraint) {
                $constraint->aspectRatio();
              });
              $img->save($thumbnailpath);

              $obj->image = $filenametostore;
            }

          }


          $obj->name= $input['name'];
          $obj->slug= CREATE_SLUG($input['name']);
          $obj->is_demo = isset($input['is_demo']) ? $input['is_demo'] : 0;
          $obj->demo_url = isset($input['demo_url']) ? $input['demo_url'] : NULL;
          $obj->short_description = isset($input['short_description']) ? $input['short_description'] : NULL;
          $obj->long_description = isset($input['long_description']) ? $input['long_description'] : NULL;
          $obj->status = $input['status'];
          $obj->seo_title = isset($input['seo_title']) ? $input['seo_title'] : NULL;
          $obj->seo_keyword = isset($input['seo_keyword']) ? $input['seo_keyword'] : NULL;
          $obj->seo_description = isset($input['seo_description']) ? $input['seo_description'] : NULL;
          $obj->save();

        // MULTIPLE CATEGORY
          \App\Models\MultipleCategory::where('blog_id',$obj->id)->delete();

          if (isset($input['category_id']) && !empty($input['category_id'])){
            
            $Category = $input['category_id'];
            foreach ($Category as $key => $value) {
              
              $mCategory = new \App\Models\MultipleCategory;
              $mCategory->category_id = $value;
              $mCategory->blog_id = $obj->id;
              $mCategory->status = $obj->status;
              $mCategory->save();
            }
          }

        // MULTIPLE TAG
          \App\Models\MultipleTag::where('blog_id',$obj->id)->delete();

          if (isset($input['tag_id']) && !empty($input['tag_id'])){
            
            $Tag = $input['tag_id'];
            foreach ($Tag as $key => $value) {
              
              $mTag = new \App\Models\MultipleTag;
              $mTag->tag_id = $value;
              $mTag->blog_id = $obj->id;
              $mTag->save();
            }
          }

          $msg = trans('lang_data.record_successfully_saved_label');
          flashMessage('success',$msg);
          return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);

        }

    /**
     * [getBlog To get blog data this functio is used]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getBlog($id)
    {
      $blog =self::with('multipleBlogCategory')->findOrfail($id);
      return $blog;
    }

    /**
     * [deleteAll This function is used to delete resources]
     * @param  [type] $r [description]
     * @return [type]    [description]
     */
    public function deleteAll($r){

      $input=$r->all();
      foreach ($input['checkbox'] as $key => $c) {

        $obj = $this->findOrFail(Crypt::decrypt($c));
        $obj->delete();
        $msg = trans('lang_data.record_successfully_deleted_label');
      }
      return response()->json(['success' => 1, 'msg' => trans('lang_data.record_successfully_deleted_label') ]);
    }

    /**
     * [getCategoryDropDown This function is used to get category list]
     * @return [type] [description]
     */
    public static function getCategoryDropDown(){

      return self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
    }

    /**
     * [SingleStatusChange To change specific record status]
     * @param [type] $r [description]
     */
    public function SingleStatusChange($r){

      $l = self::where('id',\Crypt::decrypt($r->id))->first();

      if ($l !=NULL) {
        
        if ($l->status == 1) {
          $l->status = self::STATUS_INACTIVE;

          \App\Models\MultipleCategory::where('blog_id',$l->id)->update(['status'=>\App\Models\MultipleCategory::STATUS_INACTIVE]);

        }else{
          $l->status = self::STATUS_ACTIVE;
          \App\Models\MultipleCategory::where('blog_id',$l->id)->update(['status'=>\App\Models\MultipleCategory::STATUS_ACTIVE]);
        }
        $l->save();
        return response()->json(['status' => $l->status]);
      }

    }

  /**
   * [getBlogImageUrl This function will return blog image url]
   * @return [type] [description]
   */
  public function getBlogImageUrl($type = null){

    $imageUrl_u= NO_IMAGE_URL().'no_image.png';

    if ($type == 'thumbnail_') {
      
      $imagePath = BLOG_IMAGE_UPLOAD_PATH().'thumbnail_'.$this->image;
      $imageUrl = BLOG_IMAGE_UPLOAD_URL().'thumbnail_'.$this->image;

    }elseif ($type == 'medium_') {
      
      $imagePath = BLOG_IMAGE_UPLOAD_PATH().'medium_'.$this->image;
      $imageUrl = BLOG_IMAGE_UPLOAD_URL().'medium_'.$this->image;

    }else{

      $imagePath = BLOG_IMAGE_UPLOAD_PATH().$this->image;
      $imageUrl = BLOG_IMAGE_UPLOAD_URL().$this->image;

    }

    if (isset($this->image) && !empty($this->image) && file_exists($imagePath) ) {

      return $imageUrl;

    }else{

      $imageUrl=$imageUrl_u;

    }

    return $imageUrl;
  }

  /**
   * [bloAjax This function will return blog list data]
   * @param  [type] $request [description]
   * @return [type]          [description]
   */
  public function blogAjax($request){
    
    $checkRequest = CHECK_REQUEST_TIME_WEB_OR_API(); 
    $routeDemo = false;

    $blogList = \App\Models\Blog::select('id','slug','category_id','name',
      'image','short_description','total_visitor','status','created_at','created_by',"demo_url","is_demo")
    ->has('multipleBlogCategory')
    ->with(['multipleBlogCategory','createdBy'=>function($query){

      $query->select('id','name');

    },'multipleBlogCategory.category','multipleTag','multipleTag.tag'])
    ->whereHas('multipleBlogCategory',function($rc){

      $rc->whereHas('category',function($rcd){

        $rcd->select('id','slug','name','status')
        ->where('status',\App\Models\Category::STATUS_ACTIVE); 

      });
    })
    ->orderBy('id','DESC')
    ->where('status',\App\Models\Blog::STATUS_ACTIVE);
    

    if (isset($request->routeName) && $request->routeName !="" && $request->routeName == 'front.demo') 
    {   
      $routeDemo = true;
      $blogList = $blogList->where('is_demo',1);
    }
    
    if (isset($request->search) && $request->search !="" && $request->search !='undefined') 
    {
      $searchKeyword = $request->search;   
      $blogList = $blogList->where('name','LIKE','%' . $request->search . '%')
      ->paginate(5);

    }else{   
      
     $searchKeyword = "";   
     $blogList = $blogList->paginate(5);
   }

   if ($checkRequest) {
    
    if (!$blogList->isEmpty()) {
      foreach ($blogList as $key => $value) {
        
        $value->image = $value->getBlogImageUrl();
        $blogList[$key]['createdDate'] = date('M-d-Y',strtotime($value->created_at));
        
      }

      return response()->json(['status' => 200,'msg'=>trans('lang_data.data_successfully_retrived_label'),'data' => $blogList ]);exit;

    }else{

      return response()->json(['status' => 204,'msg'=>trans('lang_data.there_is_no_data_found_label'),'data' => (object)[] ]);exit;
    }

  }else{

    return view('front.blog.pagination_all_blog',compact("blogList","searchKeyword","routeDemo"))->render();

  }                                                  
}

    /**
     * [getBlogDetailsFront This function will retuen blog detail data]
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function getBlogDetailsFront($slug){
      $checkRequest = CHECK_REQUEST_TIME_WEB_OR_API();

      $getBlogDetail = \App\Models\Blog::select('id','slug','name',
        'image','total_visitor','status','short_description','long_description','seo_title','seo_keyword','seo_description','created_at','created_by',"demo_url","is_demo") 
      ->has('multipleBlogCategory')
      ->with(['multipleBlogCategory','createdBy'=>function($query){

        $query->select('id','name');

      },'multipleBlogCategory.category','multipleTag','multipleTag.tag'])
      ->whereHas('multipleBlogCategory',function($rc){

        $rc->whereHas('category',function($rcd){

          $rcd->select('id','slug','name','status')
          ->where('status',\App\Models\Category::STATUS_ACTIVE); 

        });
      })
      ->where('slug',$slug)
      ->where('status',1)
      ->first();

      if ($getBlogDetail == null) {
        
        if ($checkRequest) {

         return response()->json(['status' => 204,'msg'=>trans('lang_data.there_is_no_data_found_label'),'data' => (object)[] ]);exit;

       }else{

        return abort(404);
      }
    }
    $title = $getBlogDetail->name;
    $allCategory = GET_CATEGORY_BLOG_COUNT();
    $nextPageUrl=self::select('id','slug','name')->where('id','>',$getBlogDetail->id)->first();
    $prevPageUrl=self::select('id','slug','name')->where('id','<',$getBlogDetail->id)->first();
    if ($checkRequest) {
      
      $getBlogDetail->image = $getBlogDetail->getBlogImageUrl();
      
      $getBlogDetail->created_date = date('M-d-Y',strtotime($getBlogDetail->created_at));
      return response()->json(['status' => 200,'msg'=>trans('lang_data.data_successfully_retrived_label'),'data' => $getBlogDetail ]);exit;

    }else{

      return view('front.blog.blog_detail',compact("getBlogDetail","allCategory","title","nextPageUrl","prevPageUrl"));
      
    }
  } 
}
