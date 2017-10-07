<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/29
 * Time: 14:41
 */

namespace App\Repositories\Impl;


use App\Clearance;
use App\Model;
use App\Repositories\ClearanceRepositoryInterface;

class ClearanceRepositoryImpl implements ClearanceRepositoryInterface
{
    public function save(array $data, ...$args):int
    {
        $clearance = new Clearance($data);

        return $clearance->save();
    }

    public function update(array $params, int $id):int
    {
        $clearance = Clearance::findOrFail($id);

        return (int) $clearance->update($params);
    }

    public function delete(int $id):int
    {

    }

    public function select(int $id):?Model
    {
        return Transport::find($id);
    }
}