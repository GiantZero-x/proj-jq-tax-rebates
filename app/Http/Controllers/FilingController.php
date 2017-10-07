<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Repositories\InvoiceRepositoryInterface;
use App\Http\Traits\Status;
use Illuminate\Http\Request;
use App\Http\Traits\Pagination;
use App\Filing;
use Illuminate\Support\Facades\DB;

class FilingController extends Controller
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

            $builder = Filing::status($status)->searchDate('applied_at', $request->apply_start_date, $request->apply_end_date);

            return $this->paginateRender($builder, $request->input('pageSize'));
        }

        return view('filing.index', Filing::renderStatus());
    }

    public function save(InvoiceRepositoryInterface $repository, Request $request):int
    {
        return $repository->save($request->input(), explode(',', $request->invoices_id));
    }

    public function delete(InvoiceRepositoryInterface $repository, int $id):int
    {
        return $repository->delete($id);
    }

    public function update(Request $request, int $id):int
    {
        $filing = Filing::find($id);

        return (int) $filing->update($request->input());
    }

    protected $disables = ['read', 'approve'];

    public function read($type = 'read', int $id = 0):?string
    {
        $view =  view($type === 'read' ? 'invoice.invdetail' :'filing.fildetail' );
        if ($id) {
            $filing = Filing::findOrFail($id);
            $view->with('filing', $filing);
        }
        $view->with('disabled',  in_array($type, $this->disables)? 'disabled' : '');

        return $view;
    }
}
