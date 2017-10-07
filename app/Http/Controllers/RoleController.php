<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\Pagination;
use App\Role;

class RoleController extends Controller
{
    use Pagination;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->paginateRender(Role::search( $request->keyword), $request->pageSize);
        }
        return view('role.index');
    }

    public function save(Request $request):int
    {
        $role = new Role();
        $role->name = $request->name ?? $request->display_name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        $role->attachPermission(explode(',', $request->permission_id));
        return 1;
    }

    public function delete(int $id):int
    {
        return Role::destroy($id);
    }

    public function update(Request $request, int $id)
    {
        $role = Role::find($id);

        return (int) $role->update($request->input());
    }

    public function read($type = 'read',int $id = 0):String
    {
        $view = view('role.roldetail');

        if ($id) {
            $role = Role::findOrFail($id);
            $view->with('role', $role);
        }

        $view->with('disabled', 'read' === $type ? 'disabled' : '');

        return $view;
    }

    public function choose():String
    {
        return view('dialogs.customer');
    }
}
