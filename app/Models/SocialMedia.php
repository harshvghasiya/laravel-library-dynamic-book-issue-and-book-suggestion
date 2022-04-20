<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class SocialMedia extends Model
{
    protected $table="social_medias";
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    /**
     * [getSocialMediaListData To get social media list]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getSocialMediaListData($request){

    	$sql=self::select("*");
      return Datatables::of($sql)
    			->addColumn('action',function($data){
        			$string = '<a href="'.route('admin.social_medias.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

                    if (env('ACCESS_TO_DELETE') == true) {

                        $string .='<a href="javascript:void(0)" data-route="'.route('admin.social_medias.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                    } 

                    return $string;
        		})
            ->editColumn('id',function($data){
                return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
            })
           ->editColumn('image',function($data){

                  return '<img style="height:50px;width:100px" src="'.$data->getSocialMediaImageUrl().'"/>';
              })
            ->editColumn('status',function($data){
                return getStatusIcon($data);
            })
            ->filter(function ($query) use ($request) {
                
                if (isset($request['status']) && $request['status'] != "") {
                    $query->where('status', $request['status']);
                }
                if (isset($request['title']) && $request['title'] != "") {
                    $query->where('title', 'like', '%' . $request->title . '%');
                }
                
            })
    		->rawColumns(['id','action','status','image'])
    		->make(true);
    }

    /**
     * [saveSocialMedia save and update socila media data]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function saveSocialMedia($r,$id=NULL){

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

                if(file_exists(SOCIAL_MEDIA_IMAGE_UPLOAD_PATH().$obj->image))
                {
                    \File::delete(SOCIAL_MEDIA_IMAGE_UPLOAD_PATH().$obj->image);
                    $obj->image = NULL;
                }
            }
        }

        if (isset($input['image']) && !empty($input['image'])) {

            $imageName = UPLOAD_FILE($r,'image',SOCIAL_MEDIA_IMAGE_UPLOAD_PATH());
            if ($imageName !="") {
              $obj->image = $imageName;
            }
        }

        $obj->title=$input['title'];
        $obj->url=$input['url'];
        $obj->status = $input['status'];
        $obj->font_awesome = isset($input['font_awesome']) ? $input['font_awesome'] : NULL;
        $obj->save();

        $msg = trans('lang_data.social_media_save_message_label');
        flashMessage('success',$msg);
        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
    }

    /**
     * [getSocialMedia To get soicial media data]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getSocialMedia($id)
    {
        $socialMedia=self::findOrfail($id);
        return $socialMedia;
    }
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
            
            $emailTemplate = $this->findOrFail(Crypt::decrypt($c));
            $emailTemplate->delete();
            $msg = trans('lang_data.social_media_delete_message_label');
        }
        return response()->json(['success' => 1, 'msg' =>trans('lang_data.social_media_delete_message_label')]);   
    }

    /**
     * [getSocialMediaImageUrl This function will return social media image url]
     * @return [type] [description]
     */
    public function getSocialMediaImageUrl(){

        $imageUrl_u=NO_IMAGE_URL().'/'.'no_image.png';
        $imagePath=SOCIAL_MEDIA_IMAGE_UPLOAD_PATH().'/'.$this->image;
        $imageUrl=SOCIAL_MEDIA_IMAGE_UPLOAD_URL().'/'.$this->image;
        if (isset($this->image) && !empty($this->image) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
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
     * [ApiGetSocialMedia This function is used to get social media data]
     * @author Chirag Ghevariya
     */
    public static function ApiGetSocialMedia(){

      $data = GET_SOCIAL_MEDIA_DATA();
      if (!$data->isEmpty()) {
          
          return response()->json(['status' => 200,'msg'=>trans('lang_data.data_successfully_retrived_label'),'data' => $data ]);exit;
      }else{

         return response()->json(['status' => 204,'msg'=>trans('lang_data.there_is_no_data_found_label'),'data' => (object)[] ]);exit;
      }
    }
}
