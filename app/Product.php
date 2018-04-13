<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function product_log(){
        return $this->hasMany('App\ProductLog');
    }
}
