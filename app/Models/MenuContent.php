<?php

namespace App\Models;

use App\Models\Menu;
use Crypt;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class MenuContent extends Model
{
    protected $table="menu_content"; // To define dabase table
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    public function menuitem()
    {
      return $this->belongsTo(Menu::class,'menu_id','id');
    }

    public static function getChildrenId($id,$type)
    {
      $data=Menu::with(['cms_data'])->where('id',$id)->first();
      if($type == 'id'){
        return $data->id;
      }else if($type == 'name'){
        return $data->cms_data->name;
      }else{
        return $data->cms_data->slug;
      }
    }
}
