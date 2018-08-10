<?php

namespace App;

class AirlineCompany extends Model
{
    public function flight_ticket() {
        return $this->hasMany('App\FlightTicket');
    }
}
