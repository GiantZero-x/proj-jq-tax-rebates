<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\Pagination;
use App\Busine;

class BusineController extends Controller
{
    use Pagination;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $builder = Busine::where('id', 1);
            return $this->paginateRender($builder, $request->input('pageSize'));
        }
        return view('busine.index');
    }

    public function save(Request $request):int
    {
        $busine = new Busine($request->input());

        return $busine->save();
    }

    public function delete(int $id):int
    {
        return Busine::destroy($id);
    }

    public function update(Request $request, int $id)
    {
        $busine = Busine::find($id);

        return (int) $busine->update($request->input());
    }

    public function read($type = 'read',int $id = 0):String
    {
        $view = view('busine.busdetail');

        if ($id) {
            $permission = Busine::findOrFail($id);
            $view->with('busine', $permission);
        }

        $view->with('disabled', 'read' === $type ? 'disabled' : '');

        return $view;
    }
}
