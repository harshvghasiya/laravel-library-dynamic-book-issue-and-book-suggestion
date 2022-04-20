<?php


function flashMessage($type,$message)
{
	\Session::put($type,$message);
    
}


function getStatusIcon($data){
	if ($data->status == 1) {
		return '<span title="'.trans('lang_data.click_on_button_change_status_label').'" class="btn btn-xs btn-success" id="active_inactive"
		status="1" data-id="'.\Crypt::encrypt($data->id).'">'.trans('lang_data.active_label').'</span>';
	}else{
		return '<span title="'.trans('lang_data.click_on_button_change_status_label').'" class="btn btn-xs btn-danger" id="active_inactive" 
		status="0" data-id="'.\Crypt::encrypt($data->id).'">'.trans('lang_data.inactive_label').'</span>';
	}
}

function UPLOAD_FILE($r,$name,$uploadPath){

	$image = $r->$name[0];
	$name = time().''.$image->getClientOriginalName();
	$large = 'large'.$name;

	$medium = 'medium'.$name;
	$thumb = 'thumb'.$name;

	$array = ['original','large_','medium','thumb'];

	$destinationPath = $uploadPath;

	foreach ($array  as $key => $value) {
        
		$image->move($uploadPath,$value.''.time().''.$image->getClientOriginalName());
	} 
	return  $name;

}

function createThumbnail($path, $width, $height)
{
	$img = Image::make($path)->resize($width, $height, function ($constraint) {
		$constraint->aspectRatio();
	});
	$img->save($path);
}

function MULTI_UPLOAD_FILE($r,$name,$uploadPath){

	foreach($r->file('product_image') as $file)
	{
		$name_logo[]=  $name = time().'_'.$file->getClientOriginalName();
		$destinationPath = $uploadPath;
		$file->move($destinationPath, $name);
	}
	return $name_logo;
}

function UPLOAD_AND_DOWNLOAD_PATH(){

	if (env('IS_LIVE_DEMO_LOCAL') == 'local') {

		return public_path();

	}elseif(env('IS_LIVE_DEMO_LOCAL') == 'softtechoverpreview') {

		return '/home/i1qxzjn7zpro/public_html/cdnify.softtechover.com/public';

	}elseif (env('IS_LIVE_DEMO_LOCAL') == 'live') {

		return '/home/i1qxzjn7zpro/public_html/public';
	}
}

// function getMenuLink()
// {
// $data=\App\Models\Menu::first();
// // dd(json_decode($data->location));
// if ($data != null && $data->location != null) {
   

// $menu=\App\Models\Menu::with(['parent_data','cms_data'=>function($q)
// {
//     $q->where('status',1);
// }])
// ->orderByRaw('FIELD (id, ' . implode(", ", json_decode($data->location)) . ') ASC')
// ->get();
// }else{

//     $menu=\App\Models\Menu::with(['parent_data','cms_data'=>function($q)
// {
//     $q->where('status',1);
// }])
// ->get();

// }
// return $menu;
// }

function getMenuLink()
{
    $menu_content=\App\Models\MenuContent::with(['menuitem','menuitem.cms_data'])
                           ->get();

    return $menu_content;
}

function GET_RECENT_WORK_PORTFOLIO()
{
	$data=\App\Models\Portfolio::with('category')->where('status',\App\Models\Portfolio::STATUS_ACTIVE)->limit(3)->get();
	return $data;
}

function UPLOAD_AND_DOWNLOAD_URL(){

	if (env('IS_LIVE_DEMO_LOCAL') == 'local') {

		return  asset('');

	}else if(env('IS_LIVE_DEMO_LOCAL') == 'softtechoverpreview') {

		return 'http://cdnify.softtechover.com/';

	}else if (env('IS_LIVE_DEMO_LOCAL') == 'live') {

		return 'https://softtechover.com/';
	}
}

	//  function UPLOAD_AND_DOWNLOAD_PATH(){

	//  	if (env('IS_LIVE_DEMO_LOCAL') == 'local') {

	//  		return public_path();

	//  	}elseif(env('IS_LIVE_DEMO_LOCAL') == 'softtechoverpreview') {

	//  		return '/home/i1qxzjn7zpro/public_html/cdnify.softtechover.com/public';

	//  	}elseif (env('IS_LIVE_DEMO_LOCAL') == 'live') {

	//  		return '/home/i1qxzjn7zpro/public_html/cdn.softtechover.com/public';
	//  	}
	//  }

	// function UPLOAD_AND_DOWNLOAD_URL(){

	//  	if (env('IS_LIVE_DEMO_LOCAL') == 'local') {

	//  		return asset('');

	//  	}else if(env('IS_LIVE_DEMO_LOCAL') == 'softtechoverpreview') {

	//  		return 'http://cdnify.softtechover.com/';

	//  	}else if (env('IS_LIVE_DEMO_LOCAL') == 'live') {

	//  		return 'http://cdn.softtechover.com/';
	//  	}
	//  }

function SOCIAL_MEDIA_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/social_media/';
}
function SOCIAL_MEDIA_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/social_media/';
}

function ADMIN_USER_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/admin_user/';
}
function ADMIN_USER_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/admin_user/';
}	

function TINYMCE_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/tinymce/';
}
function TINYMCE_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/tinymce/';
}

function CMS_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/cms/';
}
function CMS_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/cms/';
}
function CMS_CONTENT_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/cms_content/';
}
function CMS_CONTENT_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/cms_content/';
}
function BANNER_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/banner/';
}

function Team_IMAGE_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/team/';
}
function Team_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/team/';
}

function CATEGORY_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/category/';
}
function CATEGORY_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/category/';
}

function BLOG_IMAGE_UPLOAD_PATH(){

	return  UPLOAD_AND_DOWNLOAD_PATH().'/upload/blog/';
}
function BLOG_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/blog/';
}


function LANGUAGE_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/language/';
}
function LANGUAGE_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/language/';
}
function NO_IMAGE_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/admin/images/';
}
	 // SETTING lOGO
function SITE_LOGO_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/setting/logo/';
}
function SITE_LOGO_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/setting/logo/';
}
	 // SETTING AUTHOR LOGO
function SITE_AUTHOR_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/setting/author/';
}
function SITE_AUTHOR_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/setting/author/';
}
	 // EMAIL LOGO IMAGE
function EMAIL_LOGO_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/setting/email/';
}
function EMAIL_LOGO_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/setting/email/';
}
function FAVICON_LOGO_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/setting/favicon/';
}
function FAVICON_LOGO_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/setting/favicon/';
}
function USER_PROFILE_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/user/profile/';
}
function USER_PROFILE_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/user/profile/';
}
function HOME_PAGE_BANNER_LOGO_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/setting/home_page_banner/';
}
function HOME_PAGE_BANNER_LOGO_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/setting/home_page_banner/';
}
function FRONT_CSS_PATH(){

	return UPLOAD_AND_DOWNLOAD_URL().'/public/front/css/';
}
function FRONT_JS_PATH(){

	return UPLOAD_AND_DOWNLOAD_URL().'/public/front/js/';
}
function FRONT_VENDOR_PATH(){

	return UPLOAD_AND_DOWNLOAD_URL().'/public/front/vendor/';
}
function FRONT_IMAGE_PATH(){

	return UPLOAD_AND_DOWNLOAD_URL().'/public/front/images/';
}
function DEFAULT_LANGUAGE($lang=null){

	if ($lang == null) {
		return 'en';
	}else{
		return $lang;
	}

}

function SITE_PRODUCT_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/products/';
}
function SITE_PRODUCT_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/products/';
}


function SITE_MEMBERSHIP_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/membership/';
}
function MEMBERSHIP_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/membership/';
}
function ADMIN_JS_URL()
{
	return UPLOAD_AND_DOWNLOAD_URL().'public/admin/js/';
}
function ADMIN_CSS_URL()
{
	return UPLOAD_AND_DOWNLOAD_URL().'public/admin/css/';
}

function PSR_IMAGE_UPLOAD_PATH(){

	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/postsourcingrequest/';
}
function PSR_IMAGE_UPLOAD_URL(){

	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/postsourcingrequest/';
}
function GENERATE_CSRF_TOKEN()
{
	return "<input type='hidden' name='_token' value='".csrf_token()."'>";
}
function GET_SHOW_ON_HEADER_OR_FOOTER()
{	
	$data =[ 

		"1"=>"Yes",
		"0"=>"No",
	];
	return $data;
}
function GET_SETTING_INFO($field)
{	
	$setting = \App\Models\Setting::find(1)->$field;
	return $setting;
}
    /**
     * This funciton is used to conver any title to slug
     * @param  $str
     * @param  $delimeter
     * @return string
     */
    function CREATE_SLUG($str, $delimiter = '-'){

    	$slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    	return $slug;
    } 

    /**
     * [GET_CATEGORY_BLOG_COUNT This function is used to get category blog count]
     */
    function GET_CATEGORY_BLOG_COUNT(){

    	$data = \App\Models\Category::select('id','slug','name','display_on_header','image')
    	->where('status',\App\Models\Category::STATUS_ACTIVE)
    	->has("multipleCategoryStatus")
    	->withCount('multipleCategoryStatus')
    	->with(["multipleCategoryStatus"=>function($rd){
    		$rd->where('status',1);
    	}])
    	->get();
    	return $data;
    }

    /**
     * [SET_HOVER_COLOR This function is used to set hover color]
     */
    function SET_HOVER_COLOR($color){

    	$data = 'dd';
    	return $data;
    }

    function thousandsCurrencyFormat($num) {

    	if($num>1000) {

    		$x = round($num);
    		$x_number_format = number_format($x);
    		$x_array = explode(',', $x_number_format);
    		$x_parts = array('K', 'M', 'B', 'T');
    		$x_count_parts = count($x_array) - 1;
    		$x_display = $x;
    		$x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
    		$x_display .= $x_parts[$x_count_parts - 1];

    		return $x_display;

    	}
    	return $num;
    }

    function GENERATE_TOKEN()
    {
    	$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    	$token = '';
    	for ($i = 0; $i < 6; $i++)
    	{
    		$token .= $characters[rand(0, strlen($characters) - 1)];
    	}
    	$token = time().$token.time();
    	return $token;
    }

    function ALL_CATEGORY_LISTING($getAll){

    	$categoryData =\App\Models\Category::select('id','slug','name','bg_color','image')
    	->where('status',\App\Models\Category::STATUS_ACTIVE)
    	->has("multipleCategoryStatus")
    	->withCount('multipleCategoryStatus')
    	->with(["multipleCategoryStatus"=>function($rd){
    		$rd->where('status',1);
    	}]);
    	if ($getAll == false) {

    		$categoryData = $categoryData->get();

    	}else{

    		$categoryData = $categoryData->paginate(6);
    	}
    	return $categoryData;
    }

    function WORD_LIMIT($name,$charLimit){

    	return str_limit($name,$limit=$charLimit,$end='...');
    }	

    function GET_SEGMENT($segment){

    	return \Request::segment($segment);
    }

    function CONSTANT_FOR_API(){

    	return "api";
    }
    function CHECK_REQUEST_TIME_WEB_OR_API(){

    	if (GET_SEGMENT(1) == CONSTANT_FOR_API()) {

    		return true;	

    	}else{

    		return false;
    	}
    }

    function GET_CMS_PAGE(){

    	$data = \App\Models\Cms::select('id','slug','name','status')
    	->where('status',1)
    	->orderBy('name','ASC')
    	->get();
    	return $data;                            
    }	

    function GET_FOOTER_CATEGORY(){

    	$data = \App\Models\Category::select('id','slug','name','display_on_footer')
    	->where('status',\App\Models\Category::STATUS_ACTIVE)
    	->where('display_on_footer',1)
    	->has("multipleCategoryStatus")
    	->withCount('multipleCategoryStatus')
    	->with(["multipleCategoryStatus"=>function($rd){
    		$rd->where('status',1);
    	}])
    	->get();
    	return $data;                            
    }	

    function GET_SETTINNG_DATA(){

    	$data = \App\Models\Setting::first();
    	return $data;                            
    }

    function GET_SOCIAL_MEDIA_DATA(){

    	$data = \App\Models\SocialMedia::select('id','font_awesome','url','status','image','title')->where('status',1)->get();
    	return $data;                            
    }

    function ADMIN_PREFIX_KEYWORD(){

    	return "x13";
    }

    function CHECK_RIGHTS_TO_ACCESS($module_id)
    {
    	$authId = \Auth::user();

    	if (!empty($authId->right_id) && $authId->right_id == \App\Models\Right::COSNT_ADMIN_RIGHT) {

    		return true;

    	}
    	if (!empty($authId->right_id)) {

    		$module_data = $authId->right->right_modules->pluck('module_id')->toArray();
    		if (!empty($module_data)) {
    			if (in_array($module_id, $module_data)) {
    				return true;
    			} else {
    				return false;
    			}
    		} else {
    			return false;
    		}

    	} else {

    		return false;
    	}
    }

    function CHECK_RIGHTS_TO_ACCESS_DENIED($module_id,$authuserId)
    {
    	$authId=$authuserId;
    	$right=\App\Models\Right::find($authId->right_id);
    	$module_data=\App\Models\RightModule::where('status',\App\Models\RightModule::STATUS_ACTIVE)->where('right_id',$right->id)->pluck('module_id')->toArray();
    	if (!empty($module_data)){
    		if (in_array($module_id,$module_data)){
    			return true;
    		}else{
    			return false;
    		}
    	}else{
    		return false;
    	}
    }

    function PORTFOLIO_IMAGE_UPLOAD_PATH(){

    	return UPLOAD_AND_DOWNLOAD_PATH().'/upload/portfolio/';
    }
    function PORTFOLIO_IMAGE_UPLOAD_URL(){

    	return UPLOAD_AND_DOWNLOAD_URL().'public/upload/portfolio/';
    }

    function getCmsFooterAndTopSection($moduleId){

    	$data = \App\Models\Cms::with(['multipleCmsModule','parent'=>function($query){

    		$query->where('status',1);
    	}])
    	->where('status',\App\Models\Cms::STATUS_ACTIVE)
    	->whereHas('multipleCmsModule',function($query) use($moduleId){
    		$query->where('module_id',$moduleId);
    	})
    	->get();                        
    	return $data;                

    }
    function getChildSectionLink($child,$moduleId)
    {
    	$data = \App\Models\Cms::with(['multipleCmsModule','parent'=>function($query){
            
    		$query->where('status',1);
    	}])
    	->where('status',\App\Models\Cms::STATUS_ACTIVE)
    	->whereHas('multipleCmsModule',function($query) use($moduleId){
    		$query->where('module_id',$moduleId);
    	})
    	->get();                        
    	return $data;
    	
    }	

    function getSingleCmsAppChildPages($cmsId){

    	$data = \App\Models\Cms::with(['multipleCmsPage'])
    	->where('id',$cmsId)
    	->where('status',\App\Models\Cms::STATUS_ACTIVE)
    	->whereHas('multipleCmsPage',function($query){
    		$query->where('status',\App\Models\Cms::STATUS_ACTIVE);
    	})
    	->first();                        
    	return $data;                

    }

	/**
     * [getCmsPageData This function is used to get rendom cms page all data]
     * @param  [type] $cmsId [description]
     * @return [type]        [description]
     */
	function getCmsMultipleData($cmsId){

		$data =\App\Models\Cms::with(['multipleCmsPage' => function($rc){
			$rc->where('status',\App\Models\Cms::STATUS_ACTIVE);
		}])
		->where('status',\App\Models\Cms::STATUS_ACTIVE)
		->where('id',$cmsId)
		->first();
		return $data;
	}
    function getMailCredential()
    {
        $data=\App\Models\MailCredential::where('status','1')->find('1');
        return $data;
    }

	/**
     * [getCmsPageData This function is used to get rendom cms page all data]
     * @param  [type] $cmsId [description]
     * @return [type]        [description]
     */
	function getSingleCmsPageData($cmsId){

		$data =\App\Models\Cms::where('status',\App\Models\Cms::STATUS_ACTIVE)
		->where('id',$cmsId)
		->first();
		return $data;
	}

	function enableDisablePageSpeed(){

		$segment = request()->segment(1);

		if ($segment == ADMIN_PREFIX_KEYWORD()) {

			return false;

		}else{

			return false;
		}
	} 

	?>
