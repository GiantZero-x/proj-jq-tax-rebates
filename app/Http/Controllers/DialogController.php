<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/21
 * Time: 14:09
 */

namespace App\Http\Controllers;


class DialogController extends Controller
{
    public function customer():string
    {
        return view('dialogs.customer');
    }

    public function product():string
    {
        return view('dialogs.product');
    }

    public function drawer_user():string
    {
        return view('dialogs.drawer_user');
    }

    public function drawer():string
    {
        return view('dialogs.drawer');
    }

    public function drawerOrder(int $id):string
    {
        return view('dialogs.drawer_order');
    }

    public function order(int $id):string
    {
        return view('dialogs.order');
    }

    public function company():string
    {
        return view('dialogs.company');
    }

    public function invoice():string
    {
        return view('dialogs.invoice');
    }

    public function permission():string
    {
        return view('dialogs.permission');
    }

    public function role():string
    {
        return view('dialogs.role');
    }

    public function firm():String
    {
        return view('dialogs.firm');
    }

    public function business():String
    {
        return view('dialogs.business');
    }
}