<?php

namespace App\Http\Controllers;

use Curl\Curl;
use Illuminate\Http\Request;

class CurlController extends Controller
{

    public function curl(Curl $curl, Request $request)
    {
        return $curl->{$request->method()}($request->url, $request->except(['url', 's']))->response;
    }
}
