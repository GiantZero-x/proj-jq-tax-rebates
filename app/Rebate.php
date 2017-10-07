<?php

namespace App;


use App\Http\Traits\Status;

class Rebate extends Model
{
    use Status;

    protected $guarded = [];

    const STATUS = [
        0=>'待退税',
        1=>'已退税',
    ];
}
