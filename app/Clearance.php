<?php

namespace App;

use App\Http\Traits\Status;

class Clearance extends Model
{
    use Status;

    protected $searchable = [
        'columns' => [
            'clearances.order_id' => 10,
        ],
    ];

    protected $fillable = [
        'order_id',
        'generator',
        'prerecord',
        'declare',
        'release',
        'lading',
        'status',
    ];

    protected $appends = ['status_str'];

    const STATUS = [
        0=>'待申报',
        1=>'已申报',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getProductCountAttribute()
    {
        $drawerproductinvoices =  DrawerProductInvoice::where('clearance_id', $this->id)
            ->groupBy('drawer_product_id')
            ->selectRaw('SUM(price * amount) AS sum, SUM(amount) as amount, drawer_product_id')
            ->get()->toArray();

        return array_reduce($drawerproductinvoices, function($ret, $value) {
            $ret[array_get($value, 'drawer_product_id')] = $value;
            return $ret;
        },[]);
    }

}
