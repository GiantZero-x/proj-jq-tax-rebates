<?php

namespace App;

use App\Http\Traits\Status;
use Illuminate\{
    Notifications\Notifiable,
    Foundation\Auth\User as Authenticatable,
    Database\Eloquent\SoftDeletes
};

class Pay extends Authenticatable
{
    use Notifiable,SoftDeletes,Status;

    protected $guarded;

    const STATUS = [
        2=>'审批中',
        3=>'审批通过',
        4=>'审批拒绝',
        5=>'已付款',
    ];

}
