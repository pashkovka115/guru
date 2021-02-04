<?php

namespace App\Http\Controllers\Tests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class InfoController extends Controller
{
    public function index()
    {
        return view('phpinfo');
    }


    public function pay()
    {
        return view('tests.pay');
    }


    public function pay_handler(Request $request)
    {
        file_put_contents('pay_test.json', json_encode($request->all()) . "\n", FILE_APPEND);
        return \response(json_encode(['content' => 'OK', 'status' => 200]));
    }
}
