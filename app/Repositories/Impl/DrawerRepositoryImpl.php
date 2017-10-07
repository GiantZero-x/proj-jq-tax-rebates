<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/29
 * Time: 14:35
 */

namespace app\Repositories\Impl;

use App\Drawer;
use App\Model;
use app\Repositories\DrawerRepositoryInterface;

class DrawerRepositoryImpl implements DrawerRepositoryInterface
{
    public function save(array $data, ...$args):int
    {
        $drawer = new Drawer($data);

        if ($drawer->save()) {
            $drawer->products()->attach(head($args));
            return 1;
        }

        return 0;
    }

    public function update(array $params, int $id):int
    {

    }

    public function delete(int $id):int
    {
        return Drawer::destroy($id);
    }

    public function select(int $id):?Model
    {

    }
}