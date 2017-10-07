<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/25
 * Time: 13:08
 */

namespace App;


use App\Http\Traits\Status;

class Filing extends Model
{
    use Status;

    protected $appends = ['status_str'];

    protected $fillable = ['applied_at','number','status'];

    const STATUS = [
        0=>'所有',
        1=>'待申报',
        2=>'已申报',
    ];

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }
}