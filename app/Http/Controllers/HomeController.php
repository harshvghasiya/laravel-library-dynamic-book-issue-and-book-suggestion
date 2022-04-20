<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct(Request $request)
    {
      
        $this->blog = new \App\Models\Blog;
    }

    /**
     * [testSize This functin is used to test api data]
     * @return [type] [description]
     * @author Chirag Ghevariya
     */
    public function testSize(){

         $categoryCount =  \App\Models\Blog::select('id','slug','category_id','name',
                                            'image','short_description','total_visitor','status','created_by')
                                            ->with(['category'=>function($query){

                                               $query->select('id','slug','name','status');

                                            },'createdBy'=>function($query){

                                                $query->select('id','name');

                                            }])
                                            ->whereHas('category',function($query){
                                                
                                                $query->where('status',1);

                                            })
                                            ->where('status',1)
                                            ->orderBy('id','DESC')->get();       

        return response()->json($categoryCount);
                                    
    }
    
    /**
     * [index This function is used to get home page and  demo page listing data]
     * @param  [type] $pa [description]
     * @return [type]     [description]
     * @author Chirag Ghevariya
     */
    public function index()
    {       
        $banner = \App\Models\Banner::where('status',\App\Models\Banner::STATUS_ACTIVE)->get();  
        $clientIndustry = getCmsMultipleData(\App\Models\Cms::CONST_OUR_CLIENT_INDUSTRY);
        $homePageBox = getCmsMultipleData(\App\Models\Cms::CONST_HOME_PAGE_BOX_SECTION);
        $ourTopWebDevelopmentSolution = getCmsMultipleData(\App\Models\Cms::CONST_OUR_TOP_WEB_DEVELOPMENT_SOLUTION);                   
        $ourMostPopularWebPlatFrom = getSingleCmsPageData(\App\Models\Cms::CONST_OUT_MOST_POPULAR_WEB_DEV_PLATFORM);                
        $bestWebDevelopmentCompany = getSingleCmsPageData(\App\Models\Cms::CONST_BEST_WEB_DEVELOPMENT_COMPANY);                
        $wecreatedMoreThan = getSingleCmsPageData(\App\Models\Cms::CONST_WE_CREATED_MORE_THEN);
         

        return view('home',compact("banner","clientIndustry","ourMostPopularWebPlatFrom","wecreatedMoreThan","ourTopWebDevelopmentSolution","homePageBox","bestWebDevelopmentCompany"));
    }

    /**
     * [demo To get demo page view this functio is used]
     * @return [type] [description]
     * @author Chirag Ghevariya
     */
    public function demo(){

        $isDemo = true;
        return $this->index($isDemo);
    }    

    /**
     * [recentSection This functin will return recent post of blog data]
     * @return [type] [description]
     * @author Chirag Ghevariya
     */
    public function recentSection()
    {   
        $recentBlog = \App\Models\Blog::with(['category'])
                                        ->whereHas('category',function($query){

                                            $query->where('status',1);
                                        })
                                        ->where('status',1)
                                        ->orderBy('id','DESC')
                                        ->take(3)
                                        ->get();
        return view('front.home.section_recent',compact("recentBlog"));
    }    

    /**
     * [popularSection This function is used to get popular post data of blog
     * @return [type] [description]
     * @author Chirag Ghevariya
     */
    public function popularSection()
    {   
        $popularSection =  \App\Models\Blog::select('id','slug','category_id','name','image','total_visitor','status')
                                        ->with(['category'=>function($query){
                                            $query->select('id','slug','name','status');
                                        }])
                                        ->whereHas('category',function($query){

                                            $query->where('status',\App\Models\Category::STATUS_ACTIVE);
                                        })
                                        ->where('status',1)
                                        ->orderBy('total_visitor','DESC')
                                        ->take(3)
                                        ->get();

        $checkRequest = CHECK_REQUEST_TIME_WEB_OR_API(); 
        if ($checkRequest) {

            if (!$popularSection->isEmpty()) {

                foreach ($popularSection as $key => $value) {
                        
                    $value->image = $value->getBlogImageUrl();
                }
                
               return response()->json(['status' => 200,'msg'=>trans('lang_data.data_successfully_retrived_label'),'data' => $popularSection ]);exit;
            }else{

               return response()->json(['status' => 204,'msg'=>trans('lang_data.there_is_no_data_found_label'),'data' => (object)[] ]);exit;
            }

        }else{

            return view('front.home.popular_post',compact("popularSection"));
        }                               
    }    

    /**
     * [CategoryBlogAjax This function is used to get blog category wise blog data using ajax and pagination]
     * @param   $slug 
     * @return view
     * @author Chirag Ghevariya
     */
    public function blogAjax(Request $request){
        
        return $this->blog->blogAjax($request);
    }    

}
