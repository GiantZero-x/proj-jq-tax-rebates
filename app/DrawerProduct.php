<?php

namespace App;

use Illuminate\{
    Notifications\Notifiable,
    Foundation\Auth\User as Authenticatable
};

class DrawerProduct extends Authenticatable
{
    use Notifiable;

    protected $table = 'drawer_product';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function drawer()
    {
        return $this->belongsTo(Drawer::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withTimestamps();
    }
}
