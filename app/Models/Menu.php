<?php

namespace App\Models;

use App\Models\Cms;
use App\Models\MenuContent;
use Crypt;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class Menu extends Model
{
  protected $table="menuitems";
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

    public function cms_data()
    {
      return $this->belongsTo(Cms::class,'cms_id','id');
    }

    public function parent_data()
    {
      return $this->belongsTo(Menu::class,'parent_id','id');
    }

    public function menucontent()
    {
      return $this->hasOne(MenuContent::class,'menu_id','id');
    }

    /**
     * [savemenu This resource are use to save and update data]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function saveMenu($r,$id=NULL){

      $input = $r->all();
      
      
      if ($id !== NULL) {

        $id=Crypt::decrypt($id);
        $obj = self::find($id);
        

      }else{

        $obj = new self;
        $cms=Cms::select('id','name','slug')->where('id',Crypt::decrypt($r->cms_id))->first();
        $res=new MenuContent;
        
      }
      $obj->cms_id=Crypt::decrypt($r->cms_id);
      $obj->name=$cms->name;
      $obj->slug=$cms->slug;

      $obj->save();
      $res->menu_id=$obj->id;
      $res->save();
      $msg = 'Menu Created Successfully.';
      $errors="";
      flashMessage('success',$msg);
      return response()->json(['success' => true,'msg'=>$msg ,'status'=>1,'errors' => $errors]);
    }

    public function saveMenuItem($request)
    {

      if (isset($request->id) && $request->id != null) {
        $cms=Cms::find(Crypt::decrypt($request->id));
        $obj=self::where('cms_id',Crypt::decrypt($request->id))->first();
        $obj->name=$request->name;
        $cms->name=$request->name;
        $obj->target=$request->target;
        $obj->save();
        $cms->save();

        $msg = 'Menu Updated Successfully.';
        $errors="";
      }else{
        $obj = new self;
        $cms=new Cms;
        $res=new MenuContent;
        $cms->name=$request->name;
        $cms->slug=$request->slug;
        $cms->save();

        $obj->cms_id=$cms->id;
        $obj->name=$request->name;
        $obj->slug=$request->slug;
        $obj->target=$request->target;

        $obj->save();
        $res->menu_id=$obj->id;
        $res->save();
         $msg = 'Menu Created Successfully.';
         $errors="";
      }
       
      if (isset($request->menu_id) && $request->menu_id != null) {
         $child=MenuContent::where('menu_id',Crypt::decrypt($request->menu_id))->first();
         
         foreach (json_decode($child->children_id) as $key => $value) {
          if($value->cms_id == Crypt::decrypt($request->id)){
           $y[$key]['children_id']=$value->children_id;
           $y[$key]['name']=$request->name;
           $y[$key]['slug']=$value->slug;
           $y[$key]['target']=$request->target;
           $y[$key]['cms_id']=$value->cms_id;
          }else{
           $y[$key]['children_id']=$value->children_id;
           $y[$key]['name']=$value->name;
           $y[$key]['slug']=$value->slug;
           $y[$key]['target']=$value->target;
           $y[$key]['cms_id']=$value->cms_id;
          }
         }
         if(isset($y)){
                  $child->children_id=json_encode($y);
          }
          $child->save();
      }
      

     
      flashMessage('success',$msg);
      return response()->json(['success' => true,'msg'=>$msg ,'status'=>1,'errors' => $errors]);
    }

    /**
     * [getModule This resource are used to get module data]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chirag G.
     */


    public function sortedData($request)
    {
     $sorted_data=json_decode($request->sorted_data);

     if($sorted_data != null){
      // dd($sorted_data);
       MenuContent::truncate();
       foreach ($sorted_data as $key => $value) {
        foreach ($value as $k => $v) {

          $res= new MenuContent;
          $res->menu_id=$v->id;
          if (isset($v->children)  && !empty($v->children)) {
            foreach ($v->children as $ke => $va) {
              if($va != null){
                foreach ($va as $keys => $val) {
                  $data=Menu::where('id',$val->id)->first();
                  $y[$keys]['children_id']=$val->id;
                  $y[$keys]['name']=$data->name;
                  $y[$keys]['slug']=$data->slug;
                  $y[$keys]['target']=Null;
                  $y[$keys]['cms_id']=$data->cms_id;
                }
                if(isset($y)){
                  $res->children_id=json_encode($y);
                }
              }
            }
          }
          $res->save();     
        }

      }
    }
    $msg="Menu Saved Successfully.";

    return response()->json(['status' => 1,'msg'=>$msg]);
  }

  public function removeMenu($request)
  {
    $id=$request->remove_id;
    if($request->remove_id != null && $request->remove_child_id == ''){
      self::destroy(Crypt::decrypt($id));
    MenuContent::where('menu_id',Crypt::decrypt($id))->delete();

    }
    if ($request->remove_child_id != null) {
      self::destroy(Crypt::decrypt($request->remove_child_id));
    
   
    $res=MenuContent::where('menu_id',Crypt::decrypt($id))->first();

    foreach (json_decode($res->children_id) as $key => $value) {
      
      if ($value->children_id != Crypt::decrypt($request->remove_child_id) ) {
           $y[$key]['children_id']=$value->children_id;
           $y[$key]['name']=$value->name;
           $y[$key]['slug']=$value->slug;
           $y[$key]['target']=$value->target;
           $y[$key]['cms_id']=$value->cms_id;
      }
      
    }
    if(isset($y)){
        $res->children_id=json_encode($y);
        
    }else{
        $res->children_id=null;
    }
    $res->save();
    
    }
    
    $msg ="Menu Item Remove Successfully.";
    return response()->json(['msg'=>$msg,'status'=>1]);
  }

  public function menuitemUpdate($request)
  {
   $id=Crypt::decrypt($request->id);
   $res=Cms::find($id);
   $res->name=$request->name;
   $res->save();
   $msg="Menu Item Update Successfully.";
   flashMessage('success',$msg);
   return response()->json(['msg'=>$msg,'status'=>1,'success'=>true]);
  }

  public function menuitemEdit($request)
  {
     $id=Crypt::decrypt($request->id);
     $menu_id=$request->menu_id;
     $edit=Cms::with(['menulink'])->find($id);
     return view('admin::menu.menu_edit_structure',compact('edit','menu_id'));

  }

}
