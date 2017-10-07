<?php

namespace App;

use App\Http\Traits\Status;

class Product extends Model
{
    use Status;

    protected $searchable = [
        'columns' => [
            'products.name' => 10,
            'products.created_user_name'=>10,
        ],
    ];

    protected $fillable = [
        'name',
        'customer_id',
        'en_name',
        'hscode',
        'brand',
        'standard',
        'package',
        'material',
        'component',
        'number',
        'picture',
        'status'
    ];

    const STATUS = [
        0=>'所有',
        1=>'草稿',
        2=>'审批中',
        3=>'审批通过',
        4=>'审批拒绝',
    ];

    public function drawers()
    {
        return $this->belongsToMany(Drawer::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
