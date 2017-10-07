<?php

namespace App\Http\Controllers;

use App\Http\Traits\Status;
use App\Repositories\ClearanceRepositoryInterface;
use App\Repositories\DataRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Traits\Pagination;
use App\Clearance;

class ClearanceController extends Controller
{
    
    use Pagination,Status;

    public function index(Request $request, int $status = 0)
    {
        if ($request->ajax()) {
            $builder = Clearance::search($request->contract_number)->status($status)->with(['order'=> function ($query) {
                $query->with(['drawerProducts' => function ($query) {
                    $query->with('drawer');
                }]);
            }]);
            return $this->paginateRender($builder, $request->input('pageSize'));
        }

        return view('clearance.index', Clearance::renderStatus());
    }

    public function file(int $id):?string
    {
        $clearance = Clearance::findOrFail($id);
        return view('clearance.file', compact('clearance'));
    }

    public function read(DataRepositoryInterface $dataRepository, $type = 'read', int $id = 0):string
    {
        //TODO 此处要优化
        $shipment_port = $dataRepository->getTypesByFatherId(1);
        $sales_unit = $dataRepository->getTypesByFatherId(2);
        $clearance_port = $dataRepository->getTypesByFatherId(7);
        $declare_mode  = $dataRepository->getTypesByFatherId(3);
        $currency  = $dataRepository->getTypesByFatherId(6);
        $price_clause  = $dataRepository->getTypesByFatherId(5);
        $loading_mode  = $dataRepository->getTypesByFatherId(4);
        $package  = $dataRepository->getTypesByFatherId(8);
        $order_package  = $dataRepository->getTypesByFatherId(9);
        $clearance_mode  = $dataRepository->getTypesByFatherId(10);

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
            $clearance = Clearance::findOrFail($id);
            $view->with('order', $clearance->order);
        }

        return $this->disable($view);
    }

    public function get(int $id):Clearance
    {
        return Clearance::whereId($id)->with(['order'=>function ($query) {
            $query->with(['drawerProducts' => function ($query) {
                $query->with(['drawer','product']);
            }]);
        }])->first()->append(['product_count']);
    }

    public function save(ClearanceRepositoryInterface $repository, Request $request):?int
    {
        return $repository->save($request->input());
    }

    public function update(ClearanceRepositoryInterface $repository, Request $request, int $id):?int
    {
        return $repository->update($request->input(), $id);
    }

}
