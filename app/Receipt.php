<?php

namespace App;

class Receipt extends Model
{
    //

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
