<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Model;

class ModelObserver
{
    public function creating(Model $model)
    {
        $model->created_user_id = $model->updated_user_id = request()->user()->id;
        $model->created_user_name = $model->updated_user_name = request()->user()->name;
    }

    public function updating(Model $model)
    {
        $model->updated_user_id = request()->user()->id;
        $model->updated_user_name = request()->user()->name;
    }
}