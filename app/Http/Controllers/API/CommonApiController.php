<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiCommanFunctionController as ApiCommanFunctionController;
use Validator;
use \App\Models\Cms;
use \App\Models\Category;
use \App\Models\Setting;
use \App\Models\SocialMedia;

class CommonApiController extends ApiCommanFunctionController
{

    /**
     * [ApiHomePagePopularpost To get popular post data]
     * @param Request $r [description]
     */
    public function ApiHomePagePopularpost(Request $r){

        return app('App\Http\Controllers\HomeController')->popularSection();
    }    

    /**
     * [ApiFooterCmsPage This function is used to get footer cms pages data]
     * @param Request $r [description]
     */
    public function ApiFooterCmsPage(Request $r){

        return Cms::ApiFooterCmsPage($r);
    }   

    /**
     * [ApiGetCmsPageDetail This function is used to get cms detail page data]
     * @param [type] $slug [description]
     */
    public function ApiGetCmsPageDetail($slug){
        $obj = new Cms;
        return $obj->getCmsPageDetail($slug);
    }    

    /**
     * [ApiFooterCategory This function is used to get footer category]
     * @param Request $r [description]
     */
    public function ApiFooterCategory(Request $r){

        return Category::ApiFooterCategory($r);
    }    

    /**
     * [ApiGetSettingData This function is used to get setting data]
     * @param Request $r [description]
     */
    public function ApiGetSettingData(Request $r){

        return Setting::ApiGetSettingData($r);
    }    

    /**
     * [ApiGetSocialMedia This function is used to get social media data]
     * @param Request $r [description]
     */
    public function ApiGetSocialMedia(Request $r){

        return SocialMedia::ApiGetSocialMedia($r);
    }

    /**
     * [ApiGetAllCategoryList This function is used to get all category list]
     */
    public function ApiGetAllCategoryList(){
        return ALL_CATEGORY_LISTING(true);
    }    

    /**
     * [ApiGetHomePageLatestPost This function is used to get home pagge latest post]
     * @param Request $request [description]
     */
    public function ApiGetHomePageLatestPost(Request $request){

        $obj = new \App\Models\Blog;
        return $obj->blogAjax($request);
    }

    /**
     * [ApiGetAllCommonCategoryList This function is used to get all common category list]
     */
    public function ApiGetAllCommonCategoryList(){

        $data = GET_CATEGORY_BLOG_COUNT();

         if (!$data->isEmpty()) {
          
              return response()->json(['status' => 200,'msg'=>trans('lang_data.data_successfully_retrived_label'),'data' => $data ]);exit;
          }else{

             return response()->json(['status' => 204,'msg'=>trans('lang_data.there_is_no_data_found_label'),'data' => (object)[] ]);exit;
          }
    } 

    /**
     * [ApigetSingleBlogDetail This function is used to get single blog details]
     * @param [type] $slug [description]
     */
    public function ApigetSingleBlogDetail($slug){

        $obj = new \App\Models\Blog;
        return $obj->getBlogDetailsFront($slug);
    }
}