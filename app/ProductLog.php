<?php

namespace App;

class ProductLog extends Model
{
    public function product(){
        return $this->belongsTo('App\Product');
    }
    
    public function user(){
        return $this->belongsTo('App\User', 'sold_by', 'id');
    }

    public function buyer() {
        return $this->belongsTo('App\Buyer', 'sold_to', 'id');
    }
}
