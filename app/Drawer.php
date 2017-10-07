<?php

namespace App;

use App\Http\Traits\Status;

class Drawer extends Model
{
    use Status;

    protected $fillable = [
        'customer_id',
        'company',
        'telephone',
        'phone',
        'tax_id',
        'licence',
        'address',
        'source',
        'pic_register',
        'pic_verification',
        'pic_other',
        'status',
        'tax_at',
    ];

    protected $appends = ['status_str', 'customer_name'];

    const STATUS = [
        0=>'所有',
        1=>'草稿',
        2=>'审批中',
        3=>'审批通过',
        4=>'审批拒绝',
    ];

    protected $searchable = [
        'columns' => [
            'drawers.created_user_name' => 10,
            'drawers.tax_id' => 10,
        ],
    ];

    protected function getCustomerNameAttribute()
    {
        return $this->customer->name;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function remittees()
    {
        return $this->morphMany(Remittee::class, 'remit');
    }
}
