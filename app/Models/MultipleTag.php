<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class MultipleTag extends Model
{

    protected $table="multiple_tag";
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    /**
     * [category This funnction is used to get category]
     * @return [type] [description]
     */
	public function tag(){

      return $this->belongsTo('\App\Models\Tag','tag_id','id')->where('status',1);

    }

    /**
     * [blog This function is used to get blog]
     * @return [type] [description]
     */
    public function blog(){

      return $this->belongsTo('\App\Models\Blog','blog_id','id');

    }



}
