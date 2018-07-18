<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrolled extends Model
{
    public $table = "enrolled";
    public $primaryKey = 'id';

    public function students() {
        
    }

    public function tutorial() {
        return $this->belongsTo('App\Tutorial');
    }

    public function enrolled_logs() {
        return $this->hasMany('App\EnrolledLog', 'enrolled_id', 'id');
    }
}
