<?php

namespace App;

use App\Http\Traits\Status;

class Order extends Model
{
    use Status;

    protected $fillable = [
        'customer_id',
        'number',
        'sales_unit',
        'clearance_port',
        'shipment_port',
        'declare_mode',
        'currency',
        'package',
        'price_clause',
        'loading_mode',
        'package_number',
        'order_package',
        'status',
        'shipping_at',
        'clearance_mode',
        'is_pay_special',
        'is_special',
        'unloading_port',
        'customs_number',
        'aim_country',
        'trade_country',
        'broker_number',
        'broker_name',
        'status',
    ];

    protected $appends = ['status_str'];

    const STATUS = [
        0=>'所有',
        1=>'草稿',
        2=>'审批中',
        3=>'审批通过',
        4=>'审批拒绝',
        5=>'已结案',
    ];

    protected $searchable = [
        'columns' => [
            'orders.number' => 10,
        ],
    ];

    public function drawerProducts()
    {
        return $this->belongsToMany(DrawerProduct::class)
                ->withPivot(['order_id',
                    'drawer_product_id',
                    'origin_country',
                    'number',
                    'unit',
                    'single_price',
                    'default_num',
                    'value',
                    'volume',
                    'net_weight',
                    'total_weight',
                    'legal_unit',
                ])->withTimestamps();
    }

    public function containers()
    {
        return $this->hasMany(Container::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getSalesUnitAttribute()
    {
        return  Data::find(array_get($this->attributes, 'sales_unit'))->name;
        //return Data::find($this->getAttribute('sales_unit'));
    }
}
