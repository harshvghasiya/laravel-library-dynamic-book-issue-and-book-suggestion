<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{

    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct()
    {
        
    }

    /**
     * [getPortFolioAll This function is used to get portfolio data]
     * @return [type] [description]
     */
    public function getPortFolioAll(){

        $portfolio = \App\Models\Portfolio::where('status',\App\Models\Portfolio::STATUS_ACTIVE)->get();
        $title = trans('lang_data.portfolio');        
        return view('front.portfolio.index',compact('portfolio','title'));
    }    

    /**
     * [getPortFolioDetail This function is used to get portfolio detail]
     * @return [type] [description]
     */
    public function getPortFolioDetail($slug){

        $portfolioDetail = \App\Models\Portfolio::where('status',\App\Models\Portfolio::STATUS_ACTIVE)
                                                ->where('slug',$slug)->first();

        if ($portfolioDetail !=null) {
            
            $title = $portfolioDetail->title;
            return view('front.portfolio.detail',compact('portfolioDetail','title'));

        }else{

            return view('errors.404');
        }                                                
    }
}
