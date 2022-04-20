<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class Category extends Model
{
    protected $table="category";
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    /**
     * [blog This function is used to get blog data]
     * @return [type] [description]
     */
    public function blog(){

      return $this->hasMany("\App\Models\Blog","category_id","id");
    }

    /**
     * [multipleCategory To return multiple category]
     * @return [type] [description]
     */
    public function multipleCategory(){

      return $this->hasMany("\App\Models\MultipleCategory","category_id","id");
    }
 
    /**
     * [multipleCategoryStatus To return multiple category with status active]
     * @return [type] [description]
     */
    public function multipleCategoryStatus(){

      return $this->hasMany("\App\Models\MultipleCategory","category_id","id")->where('status',1);
    }

    /**
     * [getCategoryListData To get cateogry list]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getCategoryListData($request){


        $sql=self::select("*");
        return Datatables::of($sql)
              ->addColumn('action',function($data){
                $string = '<a href="'.route('admin.category.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

                  if (env('ACCESS_TO_DELETE') == true) {

                      $string .='<a href="javascript:void(0)" data-route="'.route('admin.category.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                  } 
                  
                  return $string;
              })
              ->editColumn('image',function($data){

                  return '<img style="height:50px;width:100px" src="'.$data->getCategoryImageUrl().'"/>';
              })
              ->editColumn('id',function($data){
                  return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
              })
              ->editColumn('status',function($data){
                  return getStatusIcon($data);
              })
              ->filter(function ($query) use ($request) {

                  if (isset($request['status']) && $request['status'] != "") {
                      $query->where('status', $request['status']);
                  }                  
                  if (isset($request['show_on_header']) && $request['show_on_header'] != "") {
                      $query->where('display_on_header', $request['show_on_header']);
                  } 
                  if (isset($request['show_on_footer']) && $request['show_on_footer'] != "") {
                      $query->where('display_on_footer', $request['show_on_footer']);
                  }
                  if (isset($request['name']) && $request['name'] != "") {
                      $query->where('name', 'like', '%' . $request->name . '%');
                  }
              })
              ->rawColumns(['id','action','status','image'])
              ->make(true);
    }

    /**
     * [saveCategory To save and update category]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function saveCategory($r,$id=NULL){

        $errors="";
        $input = $r->all();
        if ($id !== NULL) {
            $id=Crypt::decrypt($id);
            $obj = self::find($id);
        }else{

            $obj = new self;
        }

        if (isset($input['delete_image']) && $input['delete_image'] == 1) {
            
            if ($obj->image !=null) {

                if(file_exists(CATEGORY_IMAGE_UPLOAD_PATH().$obj->image))
                {
                    \File::delete(CATEGORY_IMAGE_UPLOAD_PATH().$obj->image);
                    $obj->image = NULL;
                }
            }
        }

        if (isset($input['image']) && !empty($input['image'])) {

          $imageName = UPLOAD_FILE($r,'image',CATEGORY_IMAGE_UPLOAD_PATH());
          if ($imageName !="") {
            $obj->image = $imageName;
          }
        }
        
        $obj->name= $input['name'];
        $obj->slug= CREATE_SLUG($input['name']);
        $obj->display_on_header= isset($input['display_on_header']) ? $input['display_on_header'] : 0;
        $obj->display_on_footer= isset($input['display_on_footer']) ? $input['display_on_footer'] : 0;
        $obj->bg_color= isset($input['bg_color']) ? $input['bg_color'] : NULL;
        $obj->description=  $input['description'];
        $obj->status = $input['status'];
        $obj->save();
       

        $msg = "Category save Successfully Done.";
        flashMessage('success',$msg);
        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
    }

    /**
     * [getCategory To get category detail]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getCategory($id)
    {
        $category=self::findOrfail($id);
        return $category;
    }

    public function deleteAll($r){

        $input=$r->all();
        $msg="";
        foreach ($input['checkbox'] as $key => $c) {

            $checkCategory = \App\Models\MultipleCategory::where('category_id',Crypt::decrypt($c))->get();

            if (!$checkCategory->isEmpty()) {
              
              $msg .= trans('lang_data.resource_can_not_be_deleted_since_in_used');
              $status = 2;

            }else{

              $obj = $this->findOrFail(Crypt::decrypt($c));
              $obj->delete();
              $msg .= "Category Record Deleted Successfully.";
              $status = 1;
            }
        }

        return response()->json(['success' => $status, 'msg' => $msg]);
    }

    /**
     * [statusAll This functio us used to active in active specific resources]
     * @param  [type] $r [description]
     * @return [type]    [description]
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
     * [getCatDropDown To get category list]
     * @return [type] [description]
     */
    public static function getCatDropDown(){
        return self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
    }

    /**
     * [SingleStatusChange To change single category status]
     * @param [type] $r [description]
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
     * [getSubcatDropDownCount To get subcategory list]
     * @param  [type] $category_id [description]
     * @return [type]              [description]
     */
    public static function getSubcatDropDownCount($category_id){
      $subcategory=0;
        if ($category_id !=NULL) {
           $subcategory= self::where('status',self::STATUS_ACTIVE)->where('parent_id',$category_id)->pluck('name','id')->toArray();
          }
          return $subcategory;
    }

    /**
     * [getSubcatDropDown To get subcategory list]
     * @param  [type] $category_id [description]
     * @return [type]              [description]
     */
    public static function getSubcatDropDown($category_id){
             
        if ($category_id !=NULL) {
            $subcategory= self::where('status',self::STATUS_ACTIVE)->where('parent_id',$category_id)->pluck('name','id')->toArray();
            if(empty($subcategory)) {
               return array();
            }else{
               return $subcategory;
            }
            
        }else{
            return '';
        }
    }

    /**
     * [getCategoryImageUrl This function is used to get category image url]
     * @return [type] [description]
     */
   public function getCategoryImageUrl(){

      $imageUrl_u=NO_IMAGE_URL().'no_image.png';
      $imagePath=CATEGORY_IMAGE_UPLOAD_PATH().$this->image;
      $imageUrl=CATEGORY_IMAGE_UPLOAD_URL().$this->image;
      if (isset($this->image) && !empty($this->image) && file_exists($imagePath) ) {
          return $imageUrl;
      }else{
          $imageUrl=$imageUrl_u;
      }
      return $imageUrl;
  }

  /**
   * [ApiFooterCategory This function is used to get footer categort data]
   */
  public static function ApiFooterCategory(){

      $data = GET_FOOTER_CATEGORY();
      if (!$data->isEmpty()) {
          
          return response()->json(['status' => 200,'msg'=>trans('lang_data.data_successfully_retrived_label'),'data' => $data ]);exit;
      }else{

         return response()->json(['status' => 204,'msg'=>trans('lang_data.there_is_no_data_found_label'),'data' => (object)[] ]);exit;
      }
  }
}
