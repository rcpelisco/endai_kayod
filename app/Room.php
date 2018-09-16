<?php

namespace App;

use PhpParser\Node\Expr\Instanceof_;


class Room extends Model
{
    public function boarders() {
        return $this->hasMany(Boarder::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function reserve($query) {
        $this->reservations()->create($query);
    }

    public function createBoarder($query) {
        $this->boarders()->create($query);
    }

    public function scopeProperNoun($query) {
        return $query->get()->map(function($item) {
            $item->location = $item->location == 'nTown' ? 'North Town Subd.' : $item->location;
            $item->location = $item->location == 'jHomes' ? 'Josephine Homes' : $item->location;
            $item->location = $item->location == 'magallanes' ? 'Magallanes' : $item->location;
            return $item;
        });
    }

    public static function roomsForSelectOption() {
        return static::properNoun()->where('type', 'trancient')->mapWithKeys(function($item) {
            return [
                $item->id => $item->name 
                    . ' - ' . $item->location   
                    . ' (' . $item->boarders->count()  
                    . '/'. $item->max_cap . ')'
            ];
        });
    }
}
