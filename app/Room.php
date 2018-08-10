<?php

namespace App;

class Room extends Model
{
    public function boarders() {
        return $this->hasMany(Boarder::class);
    }

    public function createBoarder($query) {
        $this->boarders()->create($query);
    }
}
