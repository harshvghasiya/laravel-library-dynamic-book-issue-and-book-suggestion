<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class MultipleCmsModule extends Model
{
    protected $table="multiple_cms_module"; // To define dabase table
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';
    
}
