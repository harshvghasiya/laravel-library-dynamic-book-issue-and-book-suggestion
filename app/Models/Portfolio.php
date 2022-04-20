<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;
use App\Models\PortfolioCategory;

class Portfolio extends Model
{
    protected $table="portfolio"; // To define dabase table
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';


    public function category(){

      return $this->belongsTo('App\Models\PortfolioCategory','category_id','id');
    }
    /**
     * [getPortfolioListData This function is used to get all resource of portfolio]
     * @param  [type] $request [description]
     * @return [type]          [description]
     * @author Chirag G.
     */
    public function getPortfolioListData($request){

        $sql=self::select("*")->with('category');
        return Datatables::of($sql)
              ->addColumn('action',function($data){

                  $string ='<a title="'.trans('lang_data.edit_portfolio').'" href="'.route('admin.portfolio.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

                  if (env('ACCESS_TO_DELETE') == true) {
                    
                    $string .='<a href="javascript:void(0)" title="'.trans('lang_data.delete_portfolio').'" data-route="'.route('admin.portfolio.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                  }
                  
                  return $string;
              })
              ->editColumn('image',function($data){
                  return '<a class="demo" href="'.$data->getPortfolioImageUrl().'" data-lightbox="example-1" data-title="'.$data->name.'" ><img style="height:50px;width:100px" src="'.$data->getPortfolioImageUrl().'"/></a>';
              })
              ->editColumn('category_id',function($data){
                  
                    return ($data->category !=null) ? $data->category->name : 'None';
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
              })
              ->rawColumns(['id','action','status','image','category_id'])
              ->make(true);
    }

    /**
     * [savePortfolio This fucntion is used to save and update resource of portfolio]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function savePortfolio($r,$id=NULL){
        
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

                if(file_exists(PORTFOLIO_IMAGE_UPLOAD_PATH().$obj->image))
                {
                    \File::delete(PORTFOLIO_IMAGE_UPLOAD_PATH().$obj->image);
                    $obj->image = NULL;
                }
            }
        }

        /*if (isset($input['image']) && !empty($input['image'])) {

            $imageName = UPLOAD_FILE($r,'image',PORTFOLIO_IMAGE_UPLOAD_PATH());
            if ($imageName !="") {
              $obj->image = $imageName;
            }
        } */

        if ($r->file('image')) {

          foreach($r->file('image') as $file)
          { 
              $uploadPath = PORTFOLIO_IMAGE_UPLOAD_PATH();
              $filenamewithextension = $file->getClientOriginalName();
              
              $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
       
              $extension = $file->getClientOriginalExtension();
       
              //filename to store
              $filenametostore = $filename.'_'.time().'.'.$extension;
              $mediumFilenametostore = 'medium_'.$filenametostore;

              $file->move($uploadPath, $filenametostore);
              
              copy($uploadPath.'/'.$filenametostore, $uploadPath.'/'.$mediumFilenametostore);
              
              //Resize image here
              $thumbnailpath = PORTFOLIO_IMAGE_UPLOAD_PATH().$mediumFilenametostore;
              $img = \Image::make($thumbnailpath)->resize(350,233, function($constraint) {
                  $constraint->aspectRatio();
              });
              $img->save($thumbnailpath);

              $obj->image = $filenametostore;
          }

        }


        $obj->category_id = $input['category_id'];
        $obj->title=$input['title'];
        $obj->slug= CREATE_SLUG($input['title']);
        $obj->url= isset($input['url']) ? $input['url'] : NULL;
        $obj->description= isset($input['description']) ? $input['description'] : NULL;
        $obj->long_description= isset($input['long_description']) ? $input['long_description'] : NULL;
        $obj->status = $input['status'];
        $obj->save();

        $msg = trans('lang_data.record_successfully_saved_label');
        flashMessage('success',$msg);

        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
    }

    /**
     * [getPortfolio This function is used to get single resource of portfolio]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function getPortfolio($id)
    {
        $portfolio=self::findOrfail($id);
        return $portfolio;
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
          $msg = trans('lang_data.record_delete_message_label');

      }

      return response()->json(['success' => 1, 'msg' => trans('lang_data.record_delete_message_label')]);
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
      return response()->json(['success' => 1, 'msg' => trans('lang_data.record_delete_message_label')]);
    }

    /**
     * [getPortfolioImageUrl This function is used to get portfolio image url]
     * @return [type] [description]
     * @author Chirag G.
     */
    public function getPortfolioImageUrl($type = null){

        $imageUrl_u=NO_IMAGE_URL().'/'.'no_image.png';

        if ($type == 'medium_') {
          
          $imagePath=PORTFOLIO_IMAGE_UPLOAD_PATH().'medium_'.$this->image;
          $imageUrl=PORTFOLIO_IMAGE_UPLOAD_URL().'medium_'.$this->image;

        }else{

          $imagePath=PORTFOLIO_IMAGE_UPLOAD_PATH().$this->image;
          $imageUrl=PORTFOLIO_IMAGE_UPLOAD_URL().$this->image;

        }
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
