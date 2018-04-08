<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    public function enrolled() {
        return $this->hasMany('App\Enrolled');
    }
}
