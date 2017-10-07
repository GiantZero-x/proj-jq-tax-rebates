<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class DrawerProductInvoice extends Authenticatable
{
    protected $table = 'drawer_product_invoice';

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function drawerProduct()
    {
        return $this->belongsTo(DrawerProduct::class);
    }

    public function clearance()
    {
        return $this->belongsTo(Clearance::class);
    }
}