<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class Right extends Model
{
    protected $table="rights"; 
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';
    const COSNT_ADMIN_RIGHT = 1;

    /**
     * [right_modules To get right module this funnction is used]
     * @return [type] [description]
     */
    public function right_modules()
    {
        return $this->hasMany('\App\Models\RightModule', "right_id", "id");
    }
    /**
     * [user To get user data based on right]
     * @return [type] [description]
     */
    public function user(){

        return $this->hasMany('\App\Models\User','right_id','id');
    }

    /**
     * [getRightListData This function is used to get all resource of right]
     * @param  [type] $request [description]
     * @return [type]          [description]
     * @author Chirag G.
     */
    public function getRightListData($request){

        $sql=self::select("*")->where('id','!=',self::COSNT_ADMIN_RIGHT);
        return Datatables::of($sql)
              ->addColumn('action',function($data){
                  
                  $string = '<a title="'.trans('lang_data.edit_right').'" href="'.route('admin.right.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

                  if (env('ACCESS_TO_DELETE') == true) {

                      $string .='<a href="javascript:void(0)" title="'.trans('lang_data.delete_right').'" data-route="'.route('admin.right.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                  } 
                  
                  return $string;
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
                  if (isset($request['name']) && $request['name'] != "") {
                      $query->where('name', 'like', '%' . $request->name . '%');
                  }
              })
              ->rawColumns(['id','action','status'])
              ->make(true);
    }

    /**
     * [saveRight This fucntion is used to save and update resource of right]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function saveRight($r,$id=NULL){
        
        $errors="";
        $input = $r->all();

        if ($id !== NULL) {
            $id=Crypt::decrypt($id);
            $obj = self::find($id);
        }else{
            $obj = new self;
        }
        
        $obj->name=$input['name'];
        $obj->status = $input['status'];
        $obj->save();
        
        $objNewData = \App\Models\RightModule::where("right_id", $obj->id)->delete();
        if(!empty($input['acl_id']) && isset($input['acl_id'])){
            foreach ($input['acl_id'] as $key =>$module) {

                $objRight = new \App\Models\RightModule;
                $objRight->right_id    = $obj->id;
                $objRight->module_id   = $module;
                $objRight->save();
            }
        }

        $msg = trans('lang_data.right_saved_successfully');
        flashMessage('success',$msg);


        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
    }

    /**
     * [getRight This function is used to get single resource of right]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function getRight($id)
    {
        $right=self::findOrfail($id);
        return $right;
    }

    /**
     * [deleteAll This funtion is used to delete specific resources]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author Chirag G.
     */
    public function deleteAll($r){

      $input=$r->all();
      $msg="";
      foreach ($input['checkbox'] as $key => $c) {

          $checkRightOfUser = \App\Models\User::where('right_id',Crypt::decrypt($c))->get();

          if (!$checkRightOfUser->isEmpty()) {
            
            $msg .= trans('lang_data.resource_can_not_be_deleted_since_in_used');
            $status = 2;

          }else{

            $obj = $this->findOrFail(Crypt::decrypt($c));
            $obj->delete();
            $msg .= trans('lang_data.right_record_successfully_deleted');
            $status = 1;
          }
      }
      return response()->json(['success' => $status, 'msg' =>$msg]);
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
      return response()->json(['success' => 1, 'msg' => trans('lang_data.right_record_successfully_deleted')]);
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
     * [getRightDown This function is used to get right list for dropdown]
     * @return [type] [description]
     */
    public function getRightDown(){

      $data = self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
      return $data;

    }
}
