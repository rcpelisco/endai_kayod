<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirlineCompany extends Model
{
    public function flight_ticket() {
        return $this->hasMany('App\FlightTicket');
    }
}
