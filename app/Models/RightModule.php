<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class RightModule extends Model
{
    protected $table="right_modules"; 
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';
    public $timestamps =false;
}
