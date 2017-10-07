<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\Pagination;
use App\Rebate;

class RebateController extends Controller
{
    
    use Pagination;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, int $status = 0)
    {
        
        if ($request->ajax()) {
            $buider = Rebate::where('name', 'LIKE', '%' . $request->input('customerName') . '%');
            if ($status) {
                $buider->whereStatus($status);
            }
            return $this->paginateRender($buider, $request->input('pageSize'));
        }

        return view('rebate.index', Rebate::renderStatus());
    }
    
    public function save(Request $request,int $id = 0)
    {
        $Rebate = new Rebate($request->input());

        return $Rebate->save();
    }

    public function read($type = 'read', int $id = 0):String
    {
        $view = view('rebate.rebdetail');

        if ($id) {
            $Rebate = Rebate::findOrFail($id);
            $view->with('rebate', $Rebate);
        }

        return $view;
    }
}
