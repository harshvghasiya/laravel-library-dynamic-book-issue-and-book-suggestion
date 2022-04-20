<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class EmailTemplate extends Model
{
    protected $table="email_templates"; // Database table name
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    /**
     * [getEmailTemplateListData This resource is used to get listing of all data]
     * @param  [type] $request [description]
     * @return [type]          [description]
     * @author Chirag G.
     */
    public function getEmailTemplateListData($request){

    	$sql=self::select("*");
      return Datatables::of($sql)
    						->addColumn('action',function($data){
    							$string ='<a title="'.trans('lang_data.edit_email_template_label').'" href="'.route('admin.email-template.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <a target="_blank" title="'.trans('lang_data.preview_e_emplate_label').'" href="'.route('admin.email-template.preview',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>';

                  if (env('ACCESS_TO_DELETE') == true) {
                    
                    $string .='<a title="'.trans('lang_data.delete_e_template_label').'" href="javascript:void(0)" data-route="'.route('admin.email-template.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
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
                    if (isset($request['title']) && $request['title'] != "") {
                        $query->where('title', 'like', '%' . $request->title . '%');
                    } 
                    if (isset($request['subject']) && $request['subject'] != "") {
                        $query->where('subject', 'like', '%' . $request->subject . '%');
                    }
                    
                })
							->rawColumns(['id','action','status'])
    					->make(true);
    }

    /**
     * [saveEmailTemplate This resource is used to save and update data]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function saveEmailTemplate($r,$id=NULL){

    	$errors="";
    	$input = $r->all();
    	if ($id !== NULL) {

          $id=Crypt::decrypt($id);
		    	$obj = self::find($id);	  		

      }else{
            
        	$obj = new self;
      }

      $obj->title=$input['title'];
      $obj->from=$input['from'];
      $obj->subject=$input['subject'];
      $obj->description =htmlspecialchars($input['description']);
      $obj->status = $input['status'];

      $obj->save();
        
      $msg = trans('lang_data.email_template_save_message_label');
      flashMessage('success',$msg);

      return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);

    }

    /**
     * [getEmailTemplat This function is used to get single resource data]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function getEmailTemplat($id)
    {
        $emailTemplate=self::findOrfail($id);
        return $emailTemplate;
    }

    /**
     * [statusAll description]
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
     * [deleteAll This resource is used to delete specific data]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author Chirag G.
     */
    public function deleteAll($r){

        $input=$r->all();
        foreach ($input['checkbox'] as $key => $c) {
            
            $emailTemplate = $this->findOrFail(Crypt::decrypt($c));
            $emailTemplate->delete();
            $msg = trans('lang_data.email_template_delete_message_label');

        }
        return response()->json(['success' => 1, 'msg' => trans('lang_data.email_template_delete_message_label')]);   
    }

    /**
     * [SingleStatusChange This resource is used to change status of record]
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
