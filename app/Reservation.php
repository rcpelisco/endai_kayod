<?php

namespace App;

class Reservation extends Model
{
    protected $dates = [
        'date_start',
        'date_end',
    ];

    public function room() {
        return $this->belongsTo(Room::class);
    }

    public static function events() {
        return static::all()->map(function($item) {
            $color = '';
            $location = '';

            if($item->room->location == 'magallanes') {
                $color = '#4286f4';
                $location = 'Magallanes';
            } else if ($item->room->location == 'nTown') {
                $color = '#ff4287';
                $location = 'North Town Subd.';
            } else {
                $color = '#ffb25b';
                $location = 'Josephine Homes';
            }
            return [
                'id' => $item->id,
                'name' => $item->first_name . ' ' . $item->last_name,
                'title' => $item->room->name . ' - ' . $item->first_name 
                    . ' ' . $item->last_name . ' - ' . $item->pax . ' PAX',
                'contact_no' => $item->contact_no,
                'start' => $item->date_start->toDateString(),
                'end' => $item->date_end->addDay()->toDateString(),
                'room' => $item->room->name,
                'location' => $location,
                'color' => $color,
                'allDay' => true,
            ];
        });
    }
}
