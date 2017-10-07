<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/14
 * Time: 14:02
 */

namespace App\Repositories\Impl;

use App\Model;
use App\Remittee;
use App\Repositories\RemitteeRepositoryInterface;

class RemitteeRepositoryImpl implements RemitteeRepositoryInterface
{
    public function save(array $data, ...$args):int
    {
        $transport = new Remittee($data);

        $transport->status = 2;

        return $transport->save();
    }

    public function update(array $params, int $id):int
    {
        $remittee = Remittee::find($id);
        return  (int) $remittee->update($params);
    }

    public function delete(int $id):int
    {
        return Remittee::destroy($id);
    }

    public function select(int $id):?Model
    {
        return Remittee::find($id);
    }
}