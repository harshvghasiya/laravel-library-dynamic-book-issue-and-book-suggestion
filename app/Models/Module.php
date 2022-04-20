<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class Module extends Model
{
    protected $table="modules";
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';


    const CONST_DISPLAY_ON_HEADER = 1;
    const CONST_QUICK_LINK = 2;
    /**
     * [getModuleListData This resource are used to get data]
     * @param  [type] $request [description]
     * @return [type]          [description]
     * @author Chirag G.
     */
    public function getModuleListData($request){

    	$sql=self::select("*");
    	return Datatables::of($sql)
                    		->addColumn('action',function($data){
                                $string ='<a href="'.route('admin.modules.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

                                  if (env('ACCESS_TO_DELETE') == true) {
                                    
                                    $string .='<a href="javascript:void(0)" data-route="'.route('admin.modules.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
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
     * [saveModule This resource are use to save and update data]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function saveModule($r,$id=NULL){

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
      $obj->name=$input['name'];
      $obj->status = $input['status'];

      $obj->save();

      $msg = trans('lang_data.module_save_message_label');
      flashMessage('success',$msg);

      return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
    }

    /**
     * [getModule This resource are used to get module data]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function getModule($id)
    {
        $module=self::findOrfail($id);
        return $module;
    }

    /**
     * [statusAll This resource are used to active or inactive data]
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
     * [deleteAll This resource are used to delete specific data]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author Chirag G.
     */
    public function deleteAll($r){

        $input=$r->all();
        $msg ="";
        foreach ($input['checkbox'] as $key => $c) {

          $checkInCms = \App\Models\Cms::where('module_id',Crypt::decrypt($c))->get();

          if (!$checkInCms->isEmpty()) {
            
            $msg .= trans('lang_data.resource_can_not_be_deleted_since_in_used');
            $status = 2;

          }else{

            $obj = $this->findOrFail(Crypt::decrypt($c));
            $obj->delete();
            $msg .= trans('lang_data.module_delete_message_label');
            $status = 1;
          }
        }
        return response()->json(['success' => $status, 'msg' =>$msg]);
    }

    /**
     * [getModuleDropDown This resource are use to get module data]
     * @return [type] [description]
     * @author Chirag G.
     */
    public static function getModuleDropDown(){

        return self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
    }

    /**
     * [SingleStatusChange This resource are used to change status]
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
}
