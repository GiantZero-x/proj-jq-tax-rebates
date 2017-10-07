<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/29
 * Time: 14:34
 */

namespace app\Repositories\Impl;


use App\Model;
use App\Product;
use App\Repositories\ProductRepositoryInterface;

class ProductRepositoryImpl implements ProductRepositoryInterface
{
    public function save(array $data, ...$args):int
    {
        $product = new Product($data);

        return $product->save();
    }

    public function update(array $params, int $id):int
    {
        $product = Product::find($id);

        return (int) $product->update($params);
    }

    public function delete(int $id):int
    {
        return Product::destroy($id);
    }

    public function select(int $id):?Model
    {
        return Product::findOrFail($id);
    }
}