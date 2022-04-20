<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class User extends Model
{
    protected $table="users"; 
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';


    protected $fillable = ['forgot_password_token'];

    /**
     * [right This function is useed to get right of single user]
     * @return [type] [description]
     */
    public function right(){

      return $this->belongsTo('\App\Models\Right', "right_id", "id");
    }
    /**
     * [getAdminUserListData This function is used to get all resource of admin user]
     * @param  [type] $request [description]
     * @return [type]          [description]
     * @author Chirag G.
     */
    public function getAdminUserListData($request){

        $sql = self::select("*")->with(['right'])->where('right_id','!=',\App\Models\Right::COSNT_ADMIN_RIGHT);

        return Datatables::of($sql)
              ->addColumn('action',function($data){

                  $string = '<a title="'.trans('lang_data.edit_admin_user').'" href="'.route('admin.admin_user.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

                  if (env('ACCESS_TO_DELETE') == true) {

                      $string .='<a href="javascript:void(0)" title="'.trans('lang_data.delete_admin_user_label').'" data-route="'.route('admin.admin_user.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                  } 
                  
                  return $string;
              })
              ->editColumn('image',function($data){
                  return '<a class="demo" href="'.$data->getAdminUserImageUrl().'" data-lightbox="example-1" data-title="'.$data->name.'" ><img class="p-img-red" style="height:50px;width:100px" src="'.$data->getAdminUserImageUrl().'"/></a>';
              })
              ->editColumn('id',function($data){
                  return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
              })
              ->editColumn('status',function($data){
                  return getStatusIcon($data);
              })
              ->editColumn('right_name',function($data){

                  if ($data->right !=NULL) {
                    
                    return $data->right->name;

                  }else{

                    return '-';                    
                  }   

              })
              ->filter(function ($query) use ($request) {
                
                  if (isset($request['status']) && $request['status'] != "") {
                      $query->where('status', $request['status']);
                  }
                  if (isset($request['name']) && $request['name'] != "") {
                      $query->where('name', 'like', '%' . $request->name . '%');
                  }
              })
              ->rawColumns(['id','action','status','right_name','image'])
              ->make(true);
    }

    /**
     * [saveAdminUser This fucntion is used to save and update resource of admin user]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function saveAdminUser($r,$id=NULL){
        
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

                if(file_exists(ADMIN_USER_IMAGE_UPLOAD_PATH().$obj->image))
                {
                    \File::delete(ADMIN_USER_IMAGE_UPLOAD_PATH().$obj->image);
                    $obj->image = NULL;
                }
            }
        }

        if (isset($input['image']) && !empty($input['image'])) {

            $imageName = UPLOAD_FILE($r,'image',ADMIN_USER_IMAGE_UPLOAD_PATH());
            if ($imageName !="") {
              $obj->image = $imageName;
            }
        }

    		$obj->right_id=$input['right_id'];
    		$obj->name=$input['name'];
    		$obj->email=$input['email'];

        if (isset($input['password'])) {
          
    		  $obj->password=\Hash::make($input['password']);
        }
        $obj->status = $input['status'];
        $obj->save();

        $msg = trans('lang_data.admin_user_saved_successfully');
        flashMessage('success',$msg);

        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
    }

    /**
     * [getAdminUser This function is used to get single resource of admin user]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function getAdminUser($id)
    {
        $adminUser=self::findOrfail($id);
        return $adminUser;
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
          $msg = trans('lang_data.admin_user_record_successfully_deleted');

      }

      return response()->json(['success' => 1, 'msg' => 
      	trans('lang_data.admin_user_record_successfully_deleted')]);
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
      return response()->json(['success' => 1, 'msg' => trans('lang_data.status_change_successfully_label')]);
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
     * [getAdminUserImageUrl This function will return image url of user for profile]
     * @return [type] [description]
     */
    public function getAdminUserImageUrl(){

        $imageUrl_u=NO_IMAGE_URL().'/'.'profille-image-not-foune.png';
        $imagePath=ADMIN_USER_IMAGE_UPLOAD_PATH().$this->image;
        $imageUrl=ADMIN_USER_IMAGE_UPLOAD_URL().$this->image;
        if (isset($this->image) && !empty($this->image) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }      
}
