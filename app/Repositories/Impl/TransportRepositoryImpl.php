<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/9
 * Time: 9:00
 */

namespace App\Repositories\Impl;


use App\Model;
use App\Repositories\TransportRepositoryInterface;
use App\Transport;

class TransportRepositoryImpl implements TransportRepositoryInterface
{
    public function save(array $data, ...$args):int
    {
        $transport = new Transport($data);

        $transport->status = 2;

        return $transport->save();
    }

    public function update(array $params, int $id):int
    {

    }

    public function delete(int $id):int
    {

    }

    public function select(int $id):?Model
    {
        return Transport::find($id);
    }
}