<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\Order;
use Modules\Admin\Models\Tour;

class PurchasesController extends Controller
{
    public function index()
    {
        $my_purchases = Order::where('customer_email', auth()->user()->email)->get();

        $my_tours_ids = Tour::where('user_id', auth()->id())->get('id');
        $my_tours_ids = array_keys($my_tours_ids->keyBy('id')->toArray()) ?? [];

        $purchases_from_me = Order::whereIn('tour_id', $my_tours_ids)->get();

        return view('pages.cabinet.purchases.index', [
            'my_purchases' => $my_purchases ?? [],
            'purchases_from_me' => $purchases_from_me ?? []
        ]);
    }
}
