<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class Team extends Model
{
    protected $table="teams"; // To define dabase table
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    /**
     * [getBannerListData This function is used to get all resource of banner]
     * @param  [type] $request [description]
     * @return [type]          [description]
     * @author Chirag G.
     */
    public function getTeamListData($request){

        $sql=self::select("*");
        return Datatables::of($sql)
              ->addColumn('action',function($data){

                  $string ='<a title="'.trans('lang_data.edit_team').'" href="'.route('admin.teams.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

                  if (env('ACCESS_TO_DELETE') == true) {
                    
                    $string .='<a href="javascript:void(0)" title="'.trans('lang_data.delete_team_label').'" data-route="'.route('admin.teams.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                  }
                  
                  return $string;
              })
              ->editColumn('image',function($data){
                  return '<a class="demo" href="'.$data->getTeamImageUrl().'" data-lightbox="example-1" data-title="'.$data->name.'" ><img style="height:50px;width:100px" src="'.$data->getTeamImageUrl().'"/></a>';
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
              ->rawColumns(['id','action','status','image'])
              ->make(true);
    }

    /**
     * [saveBanner This fucntion is used to save and update resource of banner]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function saveTeam($r,$id=NULL){
        
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

                if(file_exists(Team_IMAGE_UPLOAD_PATH().$obj->image))
                {
                    \File::delete(Team_IMAGE_UPLOAD_PATH().$obj->image);
                    $obj->image = NULL;
                }
            }
        }

         if ($r->file('image')) {

            foreach($r->file('image') as $file)
            { 
              $uploadPath = Team_IMAGE_UPLOAD_PATH();
              $filenamewithextension = $file->getClientOriginalName();
              
              $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
              
              $extension = $file->getClientOriginalExtension();
              
              //filename to store
              $filenametostore = $filename.'_'.time().'.'.$extension;
              $thumbFilenametostore = 'thumbnail_'.$filenametostore;
              $mediumFilenametostore = 'medium_'.$filenametostore;

              $file->move($uploadPath, $filenametostore);
              copy($uploadPath.'/'.$filenametostore, $uploadPath.'/'.$thumbFilenametostore);
              
              //Resize image here
              $thumbnailpath = Team_IMAGE_UPLOAD_PATH().$thumbFilenametostore;
              $img = \Image::make($thumbnailpath)->resize(100,200, function($constraint) {
                $constraint->aspectRatio();
              });
              $img->save($thumbnailpath);
              
              copy($uploadPath.'/'.$filenametostore, $uploadPath.'/'.$mediumFilenametostore);
              
              //Resize image here
              $thumbnailpath = Team_IMAGE_UPLOAD_PATH().$mediumFilenametostore;
              $img = \Image::make($thumbnailpath)->resize(800,1200, function($constraint) {
                $constraint->aspectRatio();
              });
              $img->save($thumbnailpath);

              $obj->image = $filenametostore;
            }

          }

        $obj->name=$input['name'];
        $obj->status = $input['status'];
        $obj->role=$input['role'];
        $obj->short_description = isset($input['short_description']) ? $input['short_description'] : NULL;
        $obj->save();

        $msg = trans('lang_data.team_save_message_label');
        flashMessage('success',$msg);

        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
    }

    /**
     * [getBanner This function is used to get single resource of banner]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function getTeam($id)
    {
        $team=self::findOrfail($id);
        return $team;
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
          $msg = trans('lang_data.team_delete_message_label');

      }

      return response()->json(['success' => 1, 'msg' => trans('lang_data.team_delete_message_label')]);
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
      return response()->json(['success' => 1, 'msg' => trans('lang_data.team_delete_message_label')]);
    }

    /**
     * [getBannerImageUrl This function is used to get banner image url]
     * @return [type] [description]
     * @author Chirag G.
     */
    public function getTeamImageUrl(){

        $imageUrl_u=NO_IMAGE_URL().'/'.'no_image.png';
        $imagePath=Team_IMAGE_UPLOAD_PATH().$this->image;
        $imageUrl=Team_IMAGE_UPLOAD_URL().$this->image;
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
}
