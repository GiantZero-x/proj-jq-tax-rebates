<?php

namespace App\Http\Controllers;

use App\Clearance;
use App\DrawerProductInvoice;
use App\Http\Traits\Status;
use Illuminate\Http\Request;
use App\Http\Traits\Pagination;
use App\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    use Pagination,Status;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, int $status = 0)
    {
        if ($request->ajax()) {
            $builder = Invoice::search($request->contractNumber)
                ->status($status)
                ->searchDate('received_at', $request->apply_start_date, $request->apply_end_date)
                ->with('clearance.order');
            return $this->paginateRender($builder, $request->input('pageSize'));
        }

        return view('invoice.index', Invoice::renderStatus());
    }
    
    public function save(Request $request,int $id = 0):int
    {
        $invoice = new Invoice($request->input());

        $invoice->save() && $invoice->drawerProducts()->attach($request->input('inv'));

        return 1;
    }

    public function delete(int $id):int
    {
        return Invoice::destroy($id);
    }

    public function update(Request $request, int $id):int
    {
        $invoice = Invoice::find($id);

        return (int) $invoice->update($request->input());
    }

    protected $disables = ['read', 'approve'];

    public function read($type = 'read', int $id = 0):String
    {
        $view = view('invoice.invdetail');

        if ($id) {
            $invoice = Invoice::findOrFail($id);
            $view->with('invoice', $invoice);
        }
        $view->with('disabled',  in_array($type, $this->disables) ? 'disabled' : '');

        return $view;
    }

    public function clearances(Request $request, int $drawer_id)
    {
        $clearances = Clearance::status(1)->whereIn('order_id', function ($query) use ($drawer_id) {
            return $query->from('drawer_product_order')->select('order_id')->whereIn('drawer_product_id', function ($query) use ($drawer_id) {
                return $query->from('drawer_product')->select('id')->whereDrawerId($drawer_id)->get();
            })->get();
        })->with(['order'=>function ($query) {
            $query->with(['drawerProducts' => function ($query) {
                $query->with(['drawer']);
            }]);
        }]);

        return $this->paginateRender($clearances, $request->input('pageSize'));
    }
}
