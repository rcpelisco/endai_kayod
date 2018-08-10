<?php

namespace App;

class Product extends Model
{
    public function product_log(){
        return $this->hasMany('App\ProductLog');
    }
}
