<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use App\Http\Traits\Pagination;

class AccountController extends Controller
{
    use Pagination;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->paginateRender(User::search($request->keyword), $request->input('pageSize'));
        }
        return view('account.index');
    }

    public function save(UserRepositoryInterface $repository, Request $request):int
    {
        return $repository->save($request->input());
    }

    public function delete(UserRepositoryInterface $repository, int $id):int
    {
        return $repository->delete($id);
    }

    public function update(UserRepositoryInterface $repository, Request $request, int $id):int
    {
        return $repository->update($request->input(), $id);
    }

    public function read(UserRepositoryInterface $repository, $type = 'read',int $id = 0):string
    {
        $view = view('account.accdetail');

        if ($id) {
            $view->with('user', $repository->select($id));
        }

        $view->with('disabled', 'read' === $type ? 'disabled' : '');

        return $view;
    }

    /*const CUSTOMER = 'salesman';

    public function role(UserRepositoryInterface $repository, string $role)
    {
        $ret = $repository->getUsersByRole($role);
        if ($role === static::CUSTOMER) {
            return $ret->load('customers')->map(function ($item) {
                return collect($item)->put('count_custmomrs', $item->customers->count());
                return  $item;
            });
        }
        return $ret;
    }*/

    public function chosalesman():string
    {
        return view('customer.chosalesman');
    }

    public function choose():string
    {
        return view('dialogs.customer');
    }
}
