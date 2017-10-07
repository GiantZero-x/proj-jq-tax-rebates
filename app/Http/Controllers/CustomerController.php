<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Traits\Pagination;
use App\Customer;

class CustomerController extends Controller
{
    use Pagination;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->paginateRender(Customer::search($request->input('keyword'))->with('user'), $request->input('pageSize'));
        }
        return view('customer.index');
    }

    public function save(CustomerRepositoryInterface $customerRepository, Request $request):int
    {
        return $customerRepository->save(array_filter($request->all()));
    }

    public function delete(CustomerRepositoryInterface $customerRepository, int $id):int
    {
        return $customerRepository->destroy($id);
    }

    public function update(CustomerRepositoryInterface $customerRepository, Request $request, int $id):int
    {
        return $customerRepository->update($request->input(), $id);
    }

    public function read(CustomerRepositoryInterface $customerRepository, $type = 'read', int $id = 0):string
    {
        $view = view('customer.cusdetail');

        if ($id) {
            $view->with('customer', $customerRepository->select($id));
        }

        return $this->disable($view);
    }

    public function chosalesman(CustomerRepositoryInterface $customerRepository, UserRepositoryInterface $repository, string $ids):string
    {
        $view = view('customer.chosalesman', ['salesman' =>  $repository->getUsersByRole('salesman')]);

        if ($ids) {
            $view->with('customers', $customerRepository->customers(explode(',', $ids)));
        }

        return $view;
    }

    public function salesman(CustomerRepositoryInterface $customerRepository, string $ids):int
    {
        return $customerRepository->salesman(explode(',', $ids), request()->user_id);
    }
}
