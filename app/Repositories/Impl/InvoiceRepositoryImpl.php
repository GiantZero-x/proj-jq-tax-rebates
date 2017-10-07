<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/29
 * Time: 14:37
 */

namespace App\Repositories\Impl;


use App\Filing;
use App\Invoice;
use App\Model;
use App\Repositories\InvoiceRepositoryInterface;

class InvoiceRepositoryImpl implements InvoiceRepositoryInterface
{
    public function save(array $data, ...$args):int
    {
        $filing = new Filing($data);

        if ($filing->save()) {
            $filing->invoices()->attach(head($args));
            return 1;
        }
        return 0;
    }

    public function update(array $params, int $id):int
    {
        return 1;
    }

    public function delete(int $id):int
    {
       return Filing::destroy($id);
    }

    public function select(int $id):?Model
    {
        // TODO: Implement select() method.
    }
}