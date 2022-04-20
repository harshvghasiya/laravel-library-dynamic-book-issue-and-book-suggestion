<?php

namespace App\Models;

use App\Models\Menu;
use Crypt;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class Cms extends Model
{
    protected $table="cms";
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';
    const CONTACT_PAGE_CONSTANT ='11';
    const SITE_MAP_CONSTANT ='17';
    const CONST_ABOUT_US_PAGE ='5';
    const CONST_SERVICE_PAGE ='8';
    const CONST_PORTFOLIO_PAGE ='9';
    const CONST_BLOG_PAGE = '1O';
    const CONST_LARAVEL_DEVELOPMENT = '12';
    const CONST_OUR_CLIENT_INDUSTRY = '18';
    const CONST_OUT_MOST_POPULAR_WEB_DEV_PLATFORM = '25';
    const CONST_WE_CREATED_MORE_THEN = '26';
    const CONST_OUR_TOP_WEB_DEVELOPMENT_SOLUTION = '27';
    const CONST_HOME_PAGE_BOX_SECTION = '32';
    const CONST_BEST_WEB_DEVELOPMENT_COMPANY = '36';

    /**
     * [parent This function is used to get paranet cms record]
     * @return [type] [description]
     */
    public function parent()
    {
      return $this->hasMany('\App\Models\Cms','parent_id','id');
    }

    /**
     * [parent This function is used to get paranet cms record]
     * @return [type] [description]
     */
    public function multipleCmsModule()
    {
      return $this->belongsTo('\App\Models\MultipleCmsModule','id','cms_id');
    }

    /**
     * [parentMany get our service data]
     * @return [type] [description]
     */
    public function multipleCmsPage()
    {
        return $this->hasMany('App\Models\Cms', "parent_id", "id");
    }

    public function menulink()
    {
        return $this->hasOne(Menu::class,'cms_id','id');
    }
    /**
     * [getCmsListData This function is used to get cms list]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getCmsListData($request){

    	$sql=self::with(["parent"])->select("*")->orderBy('id','DESC');
        return Datatables::of($sql)
		->addColumn('action',function($data){

            $string ='<a href="'.route('admin.cms.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

              if (env('ACCESS_TO_DELETE') == true) {
                
                $string .='<a href="javascript:void(0)" data-route="'.route('admin.cms.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
              }
              
              return $string;
		})
        ->editColumn('id',function($data){
            return ''.$data->id.'<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
        })
        ->editColumn('image',function($data){
            return '<a class="demo" href="'.$data->getCmsImageUrl().'" data-lightbox="example-1" data-title="" ><img style="height:50px;width:100px" src="'.$data->getCmsImageUrl().'"/></a>';
        })
        ->editColumn('parent_id',function($data){
            foreach ($data->parent as $key => $value) {
                $x[]= $value->parent !=NULL ? $value->parent->name :"None";
            }
            return $x;
           
        })
        ->editColumn('status',function($data){
            return getStatusIcon($data);
        })
        ->filter(function ($query) use ($request) {
            
            if (isset($request['status']) && $request['status'] != "") {
                                $query->where('status', $request['status']);
            }
            if (isset($request['name']) && $request['name'] != "") {
                  $query->where('name', 'like', '%' . $request->name . '%');
            }
            
        })
		->rawColumns(['id','action','status','parent_id','image'])
		->make(true);
    }

    /**
     * [saveCms This function is used to get save and update cms data]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function saveCms($r,$id=NULL){
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

                if(file_exists(CMS_IMAGE_UPLOAD_PATH().$obj->image))
                {
                    \File::delete(CMS_IMAGE_UPLOAD_PATH().$obj->image);
                    $obj->image = NULL;
                }
            }
        }

        if (isset($input['image']) && !empty($input['image'])) {

            $imageName = UPLOAD_FILE($r,'image',CMS_IMAGE_UPLOAD_PATH());
            if ($imageName !="") {
              $obj->image = $imageName;
            }
        }

        $obj->parent_id=$input['parent_id'];
        $obj->name=$input['name'];
        $obj->description = isset($input['description']) ? $input['description'] : NULL ;
        $obj->slug = CREATE_SLUG($input['name']);
        $obj->short_description=$input['short_description'];
        $obj->long_description=$input['long_description'];
        $obj->status = $input['status'];
        $obj->secondary_title=$input['secondary_title'];
        $obj->display_on_header=$input['display_on_header'];
        $obj->display_on_footer=$input['display_on_footer'];
        $obj->font_icon = isset($input['font_icon']) ? $input['font_icon'] : NULL;
        $obj->seo_title = isset($input['seo_title']) ? $input['seo_title'] : NULL;
        $obj->seo_keyword = isset($input['seo_keyword']) ? $input['seo_keyword'] : NULL;
        $obj->seo_description = isset($input['seo_description']) ? $input['seo_description'] : NULL;
        $obj->save();


        $deleteExisting = \App\Models\MultipleCmsModule::where('cms_id',$obj->id)->delete();

        if (isset($input['module_id']) && !empty($input['module_id'])) {
            
            foreach ($input['module_id'] as $key => $v) {
                
                $mObj = new \App\Models\MultipleCmsModule;            
                $mObj->cms_id = $obj->id;
                $mObj->module_id = $v;
                $mObj->save();
            }
        }

        $msg = trans('lang_data.page_save_message_label');
        flashMessage('success',$msg);
        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
    }

    /**
     * [getCms To get cmd detail data]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getCms($id)
    {
        $cms=self::findOrfail($id);
        return $cms;
    }

    /**
     * [statusAll This function is used to active or inactive sepcifuc resources]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author Chirag G.
     */
     public function statusAll($r){

       $input=$r->all();

        foreach ($input['checkbox'] as $key => $c) {

              $l = self::where('id',\Crypt::decrypt($c))->first();

              if ($l !=NULL) {
                  
                  if ($l->status == 1) {
                    $l->status = self::STATUS_INACTIVE;
                  }else{
                    $l->status = self::STATUS_ACTIVE;
                  }
                  $l->save();
              }

        }
        
       return response()->json(['success' => 1, 'msg' => trans('lang_data.banner_delete_message_label')]);
    }
    
    /**
     * [deleteAll This funtion is used to delete specific resources]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author Chirag G.
     */
    public function deleteAll($r){

        $input=$r->all();
        foreach ($input['checkbox'] as $key => $c) {
            
            $obj = $this->findOrFail(Crypt::decrypt($c));
            $obj->delete();
            $msg = trans('lang_data.page_delete_message_label');
        }
        flashMessage('success',$msg);
        return response()->json(['success' => 1, 'msg' => trans('lang_data.page_delete_message_label')]);
    }

    /**
     * [getCmsDropDown To get cms pages in dropdown]
     * @return [type] [description]
     */
    public static function getCmsDropDown(){

        return self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
    }

    /**
     * [getCmsParentDropDown To get parent cms pages in dropdown]
     * @return [type] [description]
     */
    public static function getCmsParentDropDown(){

        return self::where('status',self::STATUS_ACTIVE)
                    ->where('parent_id','!=','id')
                    ->pluck('name','id')->toArray();
    }
    
    /**
     * [SingleStatusChange This function is used to active in active single status]
     * @param [type] $r [description]
     * @author Chirag G.
     */
    public function SingleStatusChange($r){

      $l = self::where('id',\Crypt::decrypt($r->id))->first();

          if ($l !=NULL) {
              
              if ($l->status == 1) {
                $l->status = self::STATUS_INACTIVE;
              }else{
                $l->status = self::STATUS_ACTIVE;
              }
              $l->save();
              return response()->json(['status' => $l->status]);
          }

    }

    /**
     * [ApiFooterCmsPage This function is used to get footer cms page]
     */
    public static function ApiFooterCmsPage(){

        $data = GET_CMS_PAGE();
        if (!$data->isEmpty()) {
            
            return response()->json(['status' => 200,'msg'=>trans('lang_data.data_successfully_retrived_label'),'data' => $data ]);exit;
        }else{

           return response()->json(['status' => 204,'msg'=>trans('lang_data.there_is_no_data_found_label'),'data' => (object)[] ]);exit;
        }
    }

    /**
     * [getCmsPageDetail This function is used to get cms page detail]
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function getCmsPageDetail($slug){

        $checkRequest = CHECK_REQUEST_TIME_WEB_OR_API();
        $cmsPageDetail = \App\Models\Cms::where('slug',$slug)->first();
        
        if ($cmsPageDetail !=null) {

            $title = $cmsPageDetail->name;

            if ($cmsPageDetail->id == \App\Models\Cms::CONTACT_PAGE_CONSTANT) {
                
                return view('front.contact.contact',compact("cmsPageDetail","title"));

            }elseif ($cmsPageDetail->id == \App\Models\Cms::SITE_MAP_CONSTANT) {
                
                return view('front.pages.sitemap',compact("cmsPageDetail","title"));

            }elseif ($cmsPageDetail->id == \App\Models\Cms::CONST_ABOUT_US_PAGE) {
                
                return view('front.pages.about-us',compact("cmsPageDetail","title"));

            }elseif ($cmsPageDetail->id == \App\Models\Cms::CONST_PORTFOLIO_PAGE) {
                
                return view('front.portfolio.index',compact("cmsPageDetail","title"));

            }elseif ($cmsPageDetail->id == \App\Models\Cms::CONST_SERVICE_PAGE) {
                
                $getAllService = getSingleCmsAppChildPages(\App\Models\Cms::CONST_SERVICE_PAGE);

                return view('front.pages.services',compact("cmsPageDetail","title","getAllService"));
                
            }elseif($cmsPageDetail->id == 10) {
                
                return view('front.blog.index',compact("cmsPageDetail","title"));

            }
            else{
                
               return view('front.pages.detail_page',compact("cmsPageDetail","title"));
            }    

        }else{

            return abort(404);
        }
    }

    /**
     * [getCmsImageUrl This function is used to get cms image url]
     * @return [type] [description]
     * @author Chirag G.
     */
    public function getCmsImageUrl(){

        $imageUrl_u=NO_IMAGE_URL().'/'.'no_image.png';
        $imagePath=CMS_IMAGE_UPLOAD_PATH().$this->image;
        $imageUrl=CMS_IMAGE_UPLOAD_URL().$this->image;
        if (isset($this->image) && !empty($this->image) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }
}
