<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class MultipleCategory extends Model
{

    protected $table="multiple_category";
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    /**
     * [category This funnction is used to get category]
     * @return [type] [description]
     */
	public function category(){

      return $this->belongsTo('\App\Models\Category','category_id','id')->where('status',1);

    }

    /**
     * [blog This function is used to get blog]
     * @return [type] [description]
     */
    public function blog(){

      return $this->belongsTo('\App\Models\Blog','blog_id','id');

    }



}
