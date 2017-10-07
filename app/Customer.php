<?php

namespace App;

class Customer extends Model
{
    protected $searchable = [
        'columns' => [
            'customers.name' => 10,
        ],
    ];

    protected $fillable = [
        'name',
        'linkman',
        'password',
        'address',
        'telephone',
        'number',
        'service_rate',
        'receiver',
        'deposit_bank',
        'bank_account',
        'user_id',
    ];

    public function remittees()
    {
        return $this->morphMany(Remittee::class, 'remit');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
