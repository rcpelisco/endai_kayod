<?php

namespace App;

class Buyer extends Model
{
    public function transaction_log() {
        return $this->hasMany('App\BuyersTransactionLog', 'buyer_id', 'id');
    }
}
