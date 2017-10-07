<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/22
 * Time: 13:24
 */

namespace App;

use Illuminate\{
    Notifications\Notifiable,
    Foundation\Auth\User as Authenticatable,
    Database\Eloquent\SoftDeletes
};

class Container  extends Authenticatable
{
    use Notifiable,SoftDeletes;

    protected $guarded = [];
}