<?php

namespace App\Http\Controllers;

use App\Http\Traits\Status;
use App\Repositories\DataRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\TransportRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Traits\Pagination;
use App\Transport;

class TransportController extends Controller
{
    use Pagination,Status;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->paginateRender(Transport::search($request->keyword)->with(['order']), $request->input('pageSize'));
        }
        return view('transport.index', Transport::renderStatus());
    }

    public function save(TransportRepositoryInterface $repository, Request $request):int
    {
        return $repository->save($request->input());
    }

    public function delete(int $id):int
    {
        return Transport::destroy($id);
    }

    public function update(Request $request, int $id)
    {
        $transport = Transport::find($id);

        return (int) $transport->update($request->input());
    }

    public function read(OrderRepositoryInterface $orderRepository, TransportRepositoryInterface $repository, $type = 'read',int $id = 0):string
    {
        $order_id = $orderRepository->getOrdersByStatus(3)->pluck('number', 'id');

        $view = view('transport.tradetail', compact('order_id') + ['type' => Transport::TYPE]);

        if ($id) {
            $view->with('transport', $repository->select($id));
        }

        $view->with('disabled', 'read' === $type ? 'disabled' : '');

        return $view;
    }
}
