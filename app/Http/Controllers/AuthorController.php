<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{

    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct()
    {
        $this->author = new \App\Models\Author;
    }
    
    /**
     * [blogDetail To get blog detail]
     * @param  [type] $slug [description]
     * @return [type]       [description]
    */
    public function frontAuthorDetail($slug){
        
        $authorDetail = \App\Models\Author::where('slug',$slug)->where('status',\App\Models\Author::STATUS_ACTIVE)->first();

        if ($authorDetail !=null) {
            
            return view('front.author.index',compact('authorDetail'));

        }else{

            return abort(404);
        }

    }

    public function authorAjax(Request $request){

        return $this->author->authorAjax($request);
    }
}
