<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Crypt;
use App\Models\Portfolio;

class PortfolioCategory extends Model
{
    protected $table="portfolio_category";
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    public function portfolio(){

      return $this->hasMany("App\Models\Portfolio","category_id","id");
    }

    public static function getDropDown(){

      $categories = self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray(); 

      return $categories;
    }
}
