<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/3
 * Time: 13:47
 */

namespace App;

use App\Http\Traits\Search;
use App\Observers\ModelObserver;
use Illuminate\{
    Notifications\Notifiable,
    Foundation\Auth\User as Authenticatable,
    Database\Eloquent\SoftDeletes
};
use Nicolaslopezj\Searchable\SearchableTrait;

class Model extends Authenticatable
{
    use Notifiable,SoftDeletes,SearchableTrait,Search;

    public static function boot()
    {
        parent::boot();

        static::observe(new ModelObserver());
    }
}