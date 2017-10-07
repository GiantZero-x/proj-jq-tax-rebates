<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/29
 * Time: 14:36
 */

namespace app\Repositories\Impl;


use App\Model;
use App\Order;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OrderRepositoryImpl implements OrderRepositoryInterface
{
    public function save(array $data, ...$args):int
    {

    }

    public function update(array $params, int $id):int
    {

    }

    public function delete(int $id):int
    {

    }

    public function select(int $id):?Model
    {

    }

    public function getOrdersByStatus($status):Collection
    {
        return Order::status($status)->get();
    }

}