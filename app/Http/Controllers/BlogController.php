<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{

    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct()
    {
        $this->blog = new \App\Models\Blog;
    }

    /**
     * [totalViewCount To get total count of post]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function totalViewCount(Request $request){
        
        $blog = \App\Models\Blog::select('id','total_visitor')->where('id',\Crypt::decrypt($request->blog_id))->first();
        if ($blog !=null) {
            $count =$blog->total_visitor; 
            $blog->total_visitor = $count+1;
            $blog->save();
            return "true";
        }
    }    
 
    /**
     * [blogDetail To get blog detail]
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function blogDetail($slug){
        
        return $this->blog->getBlogDetailsFront($slug);
    }

    /**
     * [searchPost This function is used to search data of blog]
     * @return [type] [description]
     */
    public function searchPost()
    {   
        $title = "Blog";

        return view('front.blog.index',compact('title'));
    }

}
