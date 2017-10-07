<?php

namespace App\Http\Controllers;

use App\DrawerProduct;
use App\Http\Traits\Status;
use App\Repositories\DrawerRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Traits\Pagination;
use App\Drawer;

class DrawerController extends Controller
{
    use Pagination,Status;

    public function index(Request $request, int $status = 0)
    {
        if ($request->ajax()) {
            return $this->paginateRender(Drawer::search($request->input('name'))->status($status)->with(['customer','products']), $request->input('pageSize'));
        }

        return view('drawer.index', Drawer::renderStatus());
    }
    
    public function save(DrawerRepositoryInterface $repository, Request $request):int
    {
        return $repository->save($request->input(), explode(',', $request->input('pid')));
    }

    public function delete(DrawerRepositoryInterface $repository, int $id):int
    {
        return $repository->delete($id);
    }

    public function update(DrawerRepositoryInterface $repository, Request $request, int $id):int
    {

        $drawer = Drawer::find($id);

        $products = explode(',', $request->input('pid'));

        $now = $drawer->products()->pluck('products.id')->toArray();

        $drawer->products()->attach(array_diff($products, $now));

        $drawer->products()->detach(array_diff($now, $products));

        return (int) $drawer->update($request->input());
    }

    protected $disables = ['read', 'approve'];

    public function read($type = 'read', int $id = 0):String
    {
        $view = view('drawer.dradetail');

        if ($id) {
            $drawer = Drawer::findOrFail($id);
            $view->with('drawer', $drawer);
        }

        $view->with('disabled',  in_array($type, $this->disables) ? 'disabled' : '');

        return $view;
    }

    public function choose(Request $request):String
    {
        return view('dialogs.drawer');
    }

    public function products(Request $request)
    {
        $drawer = new Drawer();

        $builder = DrawerProduct::whereIn('drawer_id', function ($query) use ($drawer) {
            return $query->from($drawer->getTable())->whereStatus(3)->select('id');
        })->with(['drawer', 'product'])->orderBy('id', 'DESC');

        return $this->paginateRender($builder, $request->input('pageSize'));
    }
}
