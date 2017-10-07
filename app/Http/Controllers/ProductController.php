<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Traits\Pagination;
use App\Product;

class ProductController extends Controller
{
    use Pagination;

    public function index(Request $request, int $status = 0)
    {
        if ($request->ajax()) {
            return $this->paginateRender(Product::search($request->input('name'))->status($status), $request->input('pageSize'));
        }
        return view('product.index', Product::renderStatus());
    }

    public function save(ProductRepositoryInterface $repository, Request $request):int
    {
        return $repository->save($request->input());
    }

    public function delete(ProductRepositoryInterface $repository, int $id):int
    {
        return $repository->delete($id);
    }

    public function update(ProductRepositoryInterface $repository, Request $request, int $id):int
    {
        return $repository->update($request->input(), $id);
    }

    public function read(ProductRepositoryInterface $repository, $type, int $id = 0):String
    {
        $view = view('product.prodetail');

        if ($id) {
            $view->with('product', $repository->select($id));
        }
        
        return $this->disable($view);
    }

}
