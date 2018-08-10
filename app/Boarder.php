<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Boarder extends Model
{
    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function roommates() {
        return $this->room->boarders->filter(function($item, $key) {
            return $item->id != $this->id;
        });
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function nextDue() {
        return $this->lastPaidMonth()->addMonth();
    }

    public function getAgreementImg() {
        return Storage::url($this->agreement);
    }

    public function pay($amount) {
        $this->payments()->create($amount);
    }

    public function expectedPayment() {
        if($this->room->type == 'monthly') {
            return $this->room->price * $this->monthsPassed();
        }
        return null;
    }

    public function monthlyPayment() {
        return $this->room->price;
    }

    public function monthsDelayed() {
        return ceil(($this->expectedPayment() - $this->totalPayment()) / $this->monthlyPayment());
    }

    public function totalPayment() {
        return $this->payments->sum('amount') - $this->monthlyPayment();
    }

    public function monthsPassed() {
        return $this->created_at->diffInMonths(Carbon::now());
    }

    public function lastPaidMonth() {
        return $this->created_at->addMonths(floor($this->totalPayment() / $this->monthlyPayment()));
    }

    public function balance() {
        return $this->expectedPayment() - $this->totalPayment();
    }

    public function setInactive() {
        $this->active = 0;
        $this->save();
    }
}
