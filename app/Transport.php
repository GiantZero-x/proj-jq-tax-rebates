<?php

namespace App;

use App\Http\Traits\Status;

class Transport extends Model
{
    use Status;

    protected $fillable = [
        'applied_at','order_id','type','name','billed_at','number','money','status','picture'
    ];

    protected $appends = ['type_str'];

    protected $searchable = [
        'columns' => [
            'transports.order' => 10,
        ],
    ];

    const STATUS = [
        2=>'审批中',
        3=>'审批通过',
        4=>'审批拒绝',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    const TYPE = ['运费','定金','货款','税款','其他'];

    public function getTypeStrAttribute()
    {
        return array_get(static::TYPE, $this->getAttribute('type'), '未知');
    }
}
