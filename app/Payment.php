<?php

namespace App;

class Payment extends Model
{
    public function member() {
        return $this->belongsTo(Boarder::class);
    }
}
