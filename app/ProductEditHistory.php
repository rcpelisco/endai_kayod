<?php

namespace App;

class ProductEditHistory extends Model
{
    public function user(){
        return $this->belongsTo('App\User', 'edited_by', 'id');
    }
}
