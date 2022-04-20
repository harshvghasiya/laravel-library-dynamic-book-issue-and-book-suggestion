<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class Acl extends Model
{
    protected $table="acl"; 
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    const CONST_ACL_MODULE = 59;
    const CONST_BANNER_MODULE = 60;
    const CONST_EMAIL_TEMPLATE_MODULE = 61;
    const CONST_SOCIAL_MEDIA_MODULE = 62;
    const CONST_CONTACT_US_MODULE = 63;
    const CONST_NEWSLETTER_MODULE = 64;
    const CONST_CATEGORY_MODULE = 65;
    const CONST_BLOG_MODULE = 66;
    const CONST_CMS_MODULE = 67;
    const CONST_CMS_MODULE_MODULE = 68;
    const CONST_SETTINNG_MODULE = 69;
    const CONST_RIGHT_MODULE = 70;
    const CONST_ADMIN_USER_MODULE = 71;
    const CONST_PORTFOLIO = 72;
    const CONST_TAG_MODULE = 73;
    const CONST_TECHNOLOGY_MODULE = 74;

    /**
     * [getAclListData This function is used to get all resource of acl module]
     * @param  [type] $request [description]
     * @return [type]          [description]
     * @author Chirag G.
     */
    public function getAclListData($request){

        $sql=self::select("*");
        return Datatables::of($sql)
              ->addColumn('action',function($data){
                  $string = '<a title="'.trans('lang_data.edit_acl').'" href="'.route('admin.acl.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                      ';
                  if (env('ACCESS_TO_DELETE') == true) {
                    
                    $string .='<a href="javascript:void(0)" title="'.trans('lang_data.delete_acl_label').'" data-route="'.route('admin.acl.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';      
                  }    
                  return $string;    
              })
              ->editColumn('id',function($data){
                  return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
              })
              ->editColumn('id_num',function($data){
                  return $data->id;
              })
              ->editColumn('status',function($data){
                  return getStatusIcon($data);
              })
              ->filter(function ($query) use ($request) {
                
                  if (isset($request['status']) && $request['status'] != "") {
                      $query->where('status', $request['status']);
                  }
                  if (isset($request['title']) && $request['name'] != "") {
                      $query->where('title', 'like', '%' . $request->title . '%');
                  }
              })
              ->rawColumns(['id','action','status','id_num'])
              ->make(true);
    }

    /**
     * [saveAcl This fucntion is used to save and update resource of acl]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function saveAcl($r,$id=NULL){
        
        $errors="";
        $input = $r->all();

        if ($id !== NULL) {

            $id=Crypt::decrypt($id);
            $obj = self::find($id);

        }else{

            $obj = new self;
        }

        $obj->title=$input['title'];
        $obj->status = $input['status'];
        $obj->save();

        $msg = trans('lang_data.successfully_save_label');
        flashMessage('success',$msg);

        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
    }

    /**
     * [getAcl This function is used to get single resource of acl]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function getAcl($id)
    {
        $banner=self::findOrfail($id);
        return $banner;
    }

    /**
     * [deleteAll This funtion is used to delete specific resources]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author Chirag G.
     */
    public function deleteAll($r){

      $input=$r->all();
      $msg ="";
      foreach ($input['checkbox'] as $key => $c) {

          $checkModule = \App\Models\RightModule::where('module_id',Crypt::decrypt($c))->get();

          if (!$checkModule->isEmpty()) {
            
            $msg .= trans('lang_data.resource_can_not_be_deleted_since_in_used');
            $status = 2;

          }else{

            $obj = $this->findOrFail(Crypt::decrypt($c));
            $obj->delete();
            $msg .= trans('lang_data.acl_delete_message_label');
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
      return response()->json(['success' => 1, 'msg' => trans('lang_data.status_has_been_successfully_changed_label')]);
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
     * [getAclModuleForRight This function will return acl module list]
     * @return [type] [description]
     */
    public function getAclModuleForRight(){

      $data = self::where('status',self::STATUS_ACTIVE)->get();
      return $data;
    }
}
