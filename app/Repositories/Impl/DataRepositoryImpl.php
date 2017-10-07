<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/26
 * Time: 9:18
 */

namespace App\Repositories\Impl;

use App\Data;
use App\Model;
use App\Repositories\DataRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DataRepositoryImpl implements DataRepositoryInterface
{
    public function getTypes()
    {
        return Data::whereFatherId(0)->get();
    }

    public function getTypesByFatherId(int $id):?array
    {
        return array_column(Data::whereFatherId($id)->orderBy('sort')->get()->toArray(), 'name', 'id');
    }

    public function getTypesByFatherIdAndPaginate(int $id, int $per_page = 12):LengthAwarePaginator
    {
        return Data::whereFatherId($id)->orderBy('sort')->paginate($per_page);
    }

    public function update(array $params, int $id):int
    {
        $data = Data::findOrFail($id);
        return $data->update($params);
    }

    public function save(array $params, ...$args):int
    {
        $data = new Data($params);

        return $data->save();
    }

    public function delete(int $id):int
    {
        return Data::destroy($id);
    }

    public function select(int $id):?Model
    {
        // TODO: Implement select() method.
    }
}