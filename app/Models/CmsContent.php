<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class CmsContent extends Model
{
    //
    protected $table="cms_contents";
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    public function getCmsContentListData($request){

    	$sql=self::select("*");


    	return Datatables::of($sql)
    						->addColumn('action',function($data){
    							return '<a href="'.route('admin.cms_contents.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>   
									<a href="javascript:void(0)" data-route="'.route('admin.cms_contents.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
    						})
                            ->editColumn('id',function($data){
                                return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
                            })
                            ->editColumn('status',function($data){
                                return getStatusIcon($data->status);
                            })
                            ->filter(function ($query) use ($request) {
                                
                                if (isset($request['status']) && $request['status'] != "") {
                                    $query->where('status', $request['status']);
                                }
                                
                            })
							->rawColumns(['id','action','status'])
    						->make(true);
    }

    public function saveCmsContent($r,$id=NULL){

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
        if ($r->has('image')) 
        {
            $name=UPLOAD_FILE($r,'image',CMS_CONTENT_IMAGE_UPLOAD_PATH());
            $obj->image = $name;
        }
        $obj->cms_id =$input['cms_id'];
        $obj->name=$input['name'];
        $obj->short_description=htmlspecialchars($input['short_description']);
        $obj->long_description=htmlspecialchars($input['long_description']);
        $obj->status = $input['status'];
        $obj->save();

        $msg = "Cms Content save Successfully Done.";
        flashMessage('success',$msg);
        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);


    }
    public function getCmsContent($id)
    {
        $cmsContent=self::findOrfail($id);
        return $cmsContent;
    }

    public function deleteAll($r){

        $input=$r->all();
        foreach ($input['checkbox'] as $key => $c) {
            
            $obj = $this->findOrFail(Crypt::decrypt($c));
            $obj->delete();
            $msg = "Cms Content Record Deleted Successfully.";
        }
        return response()->json(['success' => 1, 'msg' => "Cms Content deleted successfully"]);   
    }
}
