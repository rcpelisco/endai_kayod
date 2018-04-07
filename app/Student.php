<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function guardian() {
        return $this->belongsTo('App\Guardian');
    }
}
