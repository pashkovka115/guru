<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchasesController extends Controller
{
    public function index()
    {
        return view('pages.cabinet.purchases.index');
    }
}
