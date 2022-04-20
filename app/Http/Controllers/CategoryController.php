<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct()
    {
        
    }

    /**
     * [allCategory This function is used to get all category data]
     * @return [type] [description]
     */
    public function allCategory(){
        
        $title = trans('lang_data.category_label');
        return view('front.category.all_category_listing',compact("title"));
    }

    /**
     * [paginationCategory This function is used to get category with pagination data]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function paginationCategory(Request $request){

        if($request->ajax()){

            $getAll =true;
            $data = ALL_CATEGORY_LISTING($getAll);
	    	
            return view('front.category.pagination_category_data',compact("data"))->render();
         }
    }

    /**
     * [singleCategoryAllBlog This fucnction is used to get single category all blog data]
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
   	public function singleCategoryAllBlog($slug){

        $categorySlug = $slug;
        $checkCategoryExit =\App\Models\Category::select('id','slug','name','status')->where('slug',$slug)
                                        ->where('status',\App\Models\Category::STATUS_ACTIVE)
                                        ->has("multipleCategoryStatus")
                                        ->withCount('multipleCategoryStatus')
                                        ->with(["multipleCategoryStatus"=>function($rd){
                                                                                    $rd->where('status',1);
                                        }])
                                        ->first();
        if ($checkCategoryExit == null) {
            
            return abort(404);

        }else{

            $title = $checkCategoryExit->name .' Category';
            return view('front.category.single_category_all_blog',compact("categorySlug","title",'checkCategoryExit'));
        }
    }

    /**
     * [singlePaginationAllBlog This function is used to get all blog with pagination]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function singlePaginationAllBlog(Request $request){

        if($request->ajax()){

            $categoryDetail = \App\Models\Category::select('id','slug','name','status')->where('slug',$request->categorySlug)->where('status',1)->first();
            $blogList  = \App\Models\Blog::select('id','slug','name','image',
                                    'short_description','total_visitor','status','created_at','created_by')
                                        ->has('multipleBlogCategory')
                                          ->with(['multipleBlogCategory','multipleBlogCategory.category'])
                                          ->whereHas('multipleBlogCategory',function($rc) use($request){

                                            $rc->whereHas('category',function($rcd) use($request){

                                                $rcd->select('id','slug','name','status')
                                                    ->where('status',\App\Models\Category::STATUS_ACTIVE)
                                                    ->where('slug',$request->categorySlug); 
                                            });
                                        })
                                        ->where('status',1)
                                        ->orderBy('total_visitor','DESC')
                                        ->paginate(6);

            
	    	return view('front.category.pagination_single_category_all_blog',compact("blogList","categoryDetail"));
         }
    }
}
