<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/29
 * Time: 14:44
 */

namespace App\Repositories;


use App\Model;

interface RepositoryInterface
{
    public function save(array $data, ...$args):int;

    public function update(array $params, int $id):int;

    public function delete(int $id):int;

    public function select(int $id):?Model;
}