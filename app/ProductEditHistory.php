<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductEditHistory extends Model
{
    public function user(){
        return $this->belongsTo('App\User', 'edited_by', 'id');
    }
}
