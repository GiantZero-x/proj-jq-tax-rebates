<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->middleware('rbac');
    }

    protected $disables = ['read', 'approve'];

    public function disable(View $view)
    {
        return $view->with('disabled', in_array(request()->route('type'), $this->disables) ? 'disabled' : '');
    }
}

