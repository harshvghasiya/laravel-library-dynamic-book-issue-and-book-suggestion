<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class Author extends Model
{
    protected $table="users"; // To define dabase table
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    /**
     * [getBannerListData This function is used to get all resource of banner]
     * @param  [type] $request [description]
     * @return [type]          [description]
     * @author Chirag G.
     */
    // public function getAuthorListData($request){

    //   $sql=self::select("*");
    //   return Datatables::of($sql)
    //   ->addColumn('action',function($data){

    //     $string ='<a title="'.trans('lang_data.edit_tag').'" href="'.route('admin.tag.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

    //     if (env('ACCESS_TO_DELETE') == true) {

    //       $string .='<a href="javascript:void(0)" title="'.trans('lang_data.delete_tag_label').'" data-route="'.route('admin.tag.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
    //     }

    //     return $string;
    //   })
    //   ->editColumn('id',function($data){
    //     return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
    //   })
    //   ->editColumn('status',function($data){
    //     return getStatusIcon($data);
    //   })
    //   ->filter(function ($query) use ($request) {

    //     if (isset($request['status']) && $request['status'] != "") {
    //       $query->where('status', $request['status']);
    //     }
    //     if (isset($request['title']) && $request['title'] != "") {
    //       $query->where('title', 'like', '%' . $request->title . '%');
    //     }
    //   })
    //   ->rawColumns(['id','action','status','image'])
    //   ->make(true);
    // }

    /**
     * [saveBanner This fucntion is used to save and update resource of banner]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    // public function saveAuthor($r,$id=NULL){

    //   $errors="";
    //   $input = $r->all();

    //   if ($id !== NULL) {
    //     $id=Crypt::decrypt($id);
    //     $obj = self::find($id);
    //   }else{
    //     $obj = new self;
    //   }

    //   $obj->title=$input['title'];
    //   $obj->slug = CREATE_SLUG($input['title']);
    //   $obj->status = $input['status'];
    //   $obj->save();

    //   $msg = trans('lang_data.record_save_message_label');
    //   flashMessage('success',$msg);

    //   return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
    // }

    /**
     * [getBanner This function is used to get single resource of banner]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    // public function getTag($id)
    // {
    //   $tag=self::findOrfail($id);
    //   return $tag;
    // }

    /**
     * [deleteAll This funtion is used to delete specific resources]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author Chirag G.
     */
    // public function deleteAll($r){

    //   $input=$r->all();
    //   $msg ="";
    //   foreach ($input['checkbox'] as $key => $c) {

    //     $checkInCms = \App\Models\MultipleTag::where('tag_id',Crypt::decrypt($c))->get();

    //     if (!$checkInCms->isEmpty()) {

    //       $msg .= trans('lang_data.resource_can_not_be_deleted_since_in_used');
    //       $status = 2;

    //     }else{

    //       $obj = $this->findOrFail(Crypt::decrypt($c));
    //       $obj->delete();
    //       $msg .= trans('lang_data.record_delete_message_label');
    //       $status = 1;
    //     }
    //   }

    //   return response()->json(['success' => $status, 'msg' =>$msg]);
    // }

    /**
     * [statusAll This function is used to active or inactive sepcifuc resources]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author Chirag G.
     */
    // public function statusAll($r){

    //   $input=$r->all();
    //   foreach ($input['checkbox'] as $key => $c) {
    //     $l = self::where('id',\Crypt::decrypt($c))->first();
    //     if ($l !=NULL) {

    //       if ($l->status == 1) {
    //         $l->status = self::STATUS_INACTIVE;
    //       }else{
    //         $l->status = self::STATUS_ACTIVE;
    //       }
    //       $l->save();
    //     }
    //   }
    //   return response()->json(['success' => 1, 'msg' => trans('lang_data.record_delete_message_label')]);
    // }
    
    /**
     * [SingleStatusChange This function is used to active in active single status]
     * @param [type] $r [description]
     * @author Chirag G.
     */
    // public function SingleStatusChange($r){

    //   $l = self::where('id',\Crypt::decrypt($r->id))->first();
    //   if ($l !=NULL) {

    //     if ($l->status == 1) {
    //       $l->status = self::STATUS_INACTIVE;
    //     }else{
    //       $l->status = self::STATUS_ACTIVE;
    //     }
    //     $l->save();
    //     return response()->json(['status' => $l->status]);
    //   }
    // }

    /**
     * [getCatDropDown To get category list]
     * @return [type] [description]
     */
    // public static function getCatDropDown(){
    //   return self::where('status',self::STATUS_ACTIVE)->pluck('title','id')->toArray();
    // }

    public function authorAjax($request){

     if($request->ajax()){

      $authorDetail = \App\Models\Author::where('slug',$request->authorSlug)->where('status',\App\Models\Author::STATUS_ACTIVE)->first();
      $blogList  = \App\Models\Blog::select('id','slug','name','image',
        'short_description','total_visitor','status','created_at','created_by')
      ->has('multipleBlogCategory')
      ->with(['multipleBlogCategory','multipleBlogCategory.category','multipleTag','multipleTag.tag','createdBy'])
      ->whereHas('multipleBlogCategory',function($rc){

        $rc->whereHas('category',function($rcd){

          $rcd->select('id','slug','name','status')
          ->where('status',\App\Models\Category::STATUS_ACTIVE);
        });
      })
      ->whereHas('createdBy',function($rc) use($request){
          $rc->where('slug',$request->authorSlug);
      })
      ->where('status',\App\Models\Blog::STATUS_ACTIVE)
      ->orderBy('total_visitor','DESC')
      ->paginate(6);


      return view('front.author.pagination_all_blog',compact("blogList","authorDetail"));
    }   

  }
}
