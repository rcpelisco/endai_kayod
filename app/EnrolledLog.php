<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrolledLog extends Model
{
    public $primaryKey = 'id';

    public function enrolled() {
        return $this->belongsToMany('App\Enrolled');
    }
}
