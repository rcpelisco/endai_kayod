<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrolled extends Model
{
    public $table = "enrolled";
    public $primaryKey = 'id';

    public function student() {
        return $this->belongsTo('App\Student');
    }

    public function tutorial() {
        return $this->belongsTo('App\Tutorial');
    }
}
