<?php

namespace App;

use App\Http\Traits\Status;


class Invoice extends Model
{
    use Status;

    protected $fillable = [
        'status',
        'clearance_id',
        'number',
        'billed_at',
        'received_at',
        'sum'
    ];

    protected $searchable = [
        'columns' => [
            'invoices.number' => 10,
        ],
        'joins' => [
            'clearances' => ['invoices.clearance_id', 'clearances.id'],
            'orders' => ['clearances.order_id', 'orders.id'],
        ],
    ];

    protected $appends = ['status_str'];

    const STATUS = [
        0=>'所有',
        1=>'草稿',
        2=>'审批中',
        3=>'审批通过',
        4=>'审批拒绝',
    ];

    public function clearance()
    {
        return $this->belongsTo(Clearance::class);
    }

    public function drawerProducts()
    {
        return $this->belongsToMany(DrawerProduct::class)
                    ->withPivot(['price','amount']);
    }

}
