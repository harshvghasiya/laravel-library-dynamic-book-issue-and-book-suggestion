<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CmsController extends Controller
{
    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct()
    {
        $this->cms =new \App\Models\Cms; 
    }

    /**
     * [detail This function is used to get cms page data]
     * @param   $slug 
     * @return Object 
     */
    public function detail($slug){

        return $this->cms->getCmsPageDetail($slug);
    }

}
