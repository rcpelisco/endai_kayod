<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightTicket extends Model
{
    public function airline_company() {
        return $this->belongsTo('App\AirlineCompany');
    }
}
