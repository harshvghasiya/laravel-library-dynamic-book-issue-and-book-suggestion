<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class BlogCategory extends Model
{
    //
    protected $table="blog_categories";
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    public function getBlogCategoryListData($request){

    	$sql=self::select("*");


    	return Datatables::of($sql)
    						->addColumn('action',function($data){
    							return '<a href="'.route('admin.blog_categories.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									<a href="javascript:void(0)" data-route="'.route('admin.blog_categories.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
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

    public function saveBlogCategory($r,$id=NULL){

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

	       $msg = "Blog Category save Successfully";
            flashMessage('success',$msg);
	        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);


    }
    public function getBlogCategory($id)
    {
        $blogCategory=self::findOrfail($id);
        return $blogCategory;
    }

    public function deleteAll($r){

        $input=$r->all();
        foreach ($input['checkbox'] as $key => $c) {

            $obj = $this->findOrFail(Crypt::decrypt($c));
            $obj->delete();
            $msg = "Blog Category Record Deleted Successfully";
        }
        return response()->json(['success' => 1, 'msg' => "Blog Category deleted successfully"]);
    }

    public static function getCategoryDropDown(){

        return self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
    }
    public static function getCategoryFrontDropDown(){

        return self::where('status',self::STATUS_ACTIVE)->get();
    }
}
