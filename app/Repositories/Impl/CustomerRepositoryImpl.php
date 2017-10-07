<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/25
 * Time: 11:24
 */

namespace App\Repositories\Impl;

use App\Customer;
use App\Model;
use App\Repositories\CustomerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepositoryImpl implements CustomerRepositoryInterface
{
    public function save(array $params, ...$args):int
{
    $customer = new Customer($params);

    return $customer->save();
}

    public function update(array $params, int $id):int
    {
        $customer = Customer::find($id);

        return (int) $customer->update($params);
    }

    public function delete(int $id):int
    {
        return Customer::destroy($id);
    }

    public function select(int $id):?Model
    {
        return Customer::findOrFail($id);
    }

    public function salesman(array $ids, int $userId):int
    {
        return Customer::whereIn('id', $ids)->update(['user_id'=>$userId]);
    }

    public function customers(array $ids):?Collection
    {
        return Customer::whereIn('id', $ids)->get();
    }
}