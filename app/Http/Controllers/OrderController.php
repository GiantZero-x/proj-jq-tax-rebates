<?php

namespace App\Http\Controllers;

use App\Http\Traits\Status;
use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\DataRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Traits\Pagination;
use App\Order;
use Illuminate\Support\Facades\DB;
use TomLingham\Searchy\Facades\Searchy;

class OrderController extends Controller
{
    
    use Pagination,Status;

    private $dataRepository;
    /**
     * OrderController constructor.
     */
    public function __construct(DataRepositoryInterface $dataRepository)
    {
        $this->dataRepository = $dataRepository;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, int $status = 0)
    {
        if ($request->ajax()) {

            $builder = Order::searchDateTime('created_at', $request->apply_start_date, $request->apply_end_date)
                        ->search($request->order_number)
                        ->status($status);

            return $this->paginateRender($builder, $request->input('pageSize'));
        }

        return view('order.index', Order::renderStatus());
    }
    
    public function save(Request $request):int
    {
        $order = new Order($request->input());

        $order->save();

        $pros = $request->input('pro');

        $pros = array_combine(array_column($pros, 'drawer_product_id'), array_values($pros));

        $order->drawerProducts()->attach($pros);

        $container = $request->input('box');

        $order->containers()->createMany($container);

        return 1;
    }

    public function read(Request $request, CustomerRepositoryInterface $customerRepository, $type = 'read', int $id = 0):string
    {
        $shipment_port = $this->dataRepository->getTypesByFatherId(3);
        $sales_unit = $this->dataRepository->getTypesByFatherId(1);
        $clearance_port = $this->dataRepository->getTypesByFatherId(2);
        $declare_mode = $this->dataRepository->getTypesByFatherId(4);
        $currency = $this->dataRepository->getTypesByFatherId(5);
        $price_clause = $this->dataRepository->getTypesByFatherId(6);
        $loading_mode = $this->dataRepository->getTypesByFatherId(8);
        $package = $this->dataRepository->getTypesByFatherId(7);
        $order_package = $this->dataRepository->getTypesByFatherId(9);
        $clearance_mode = $this->dataRepository->getTypesByFatherId(10);

        $view = view('order.orddetail',
            compact('sales_unit',
                'shipment_port',
                'clearance_port',
                'declare_mode',
                'currency',
                'price_clause',
                'loading_mode',
                'package',
                'order_package',
                'clearance_mode'
            ));

        if ($id) {
            $order = Order::findOrFail($id);
            $view->with('order', $order);
        }

        if ($request->customer_id) {
            $view->with('customer', $customerRepository->select($request->customer_id));
        }

        $view->with('disabled', 'read' === $type ? 'disabled' : '');

        return $view;
    }

    public function delete(int $id):?int
    {
        return Order::destroy($id);
    }

    public function update(Request $request, int $id):?int
    {
        $order = Order::find($id);

        return (int) $order->update($request->input());
    }



}
