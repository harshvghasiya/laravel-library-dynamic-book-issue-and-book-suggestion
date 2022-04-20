<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagController extends Controller
{

    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct()
    {
        $this->tag = new \App\Models\Tag;
    }
    
    /**
     * [blogDetail To get blog detail]
     * @param  [type] $slug [description]
     * @return [type]       [description]
    */
    public function frontTagDetail($slug){
        
        $tagDetail = \App\Models\Tag::where('slug',$slug)->where('status',\App\Models\Tag::STATUS_ACTIVE)->first();

        if ($tagDetail !=null) {
            
            return view('front.tag.index',compact('tagDetail'));

        }else{

            return abort(404);
        }

    }

    public function tagAjax(Request $request){

        return $this->tag->tagAjax($request);
    }
}
