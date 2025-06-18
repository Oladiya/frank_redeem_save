<?php

namespace App\Http\Controllers;

use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->is_admin)
            $orders = Order::all();
        else
            $orders = $user->orders()->get();

        return view('pages.home')->with(compact('orders'));
    }
}
