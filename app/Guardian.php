<?php

namespace App;

class Guardian extends Model
{
    public $primaryKey = 'id';
    
    public function student() {
        return $this->hasMany('App\Student');
    }
}
