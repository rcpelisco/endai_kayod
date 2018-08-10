<?php

namespace App;

class EnrolledLog extends Model
{
    public $primaryKey = 'id';

    public function enrolled() {
        return $this->belongsToMany('App\Enrolled');
    }
}
