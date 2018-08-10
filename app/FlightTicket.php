<?php

namespace App;

class FlightTicket extends Model
{
    public function airline_company() {
        return $this->belongsTo('App\AirlineCompany');
    }
}
