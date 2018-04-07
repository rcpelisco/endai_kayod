<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    public $primaryKey = 'id';
    
    public function student() {
        return $this->hasMany('App\Student');
    }
}
