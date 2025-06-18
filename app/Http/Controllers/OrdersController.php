<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OrdersController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('pages.orders-create')->with(compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'digits:10'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'service_id' => [Rule::requiredIf(! $request->has('other_service-on')), 'nullable', 'exists:services,id'],
            'other_service-on' => ['nullable'],
            'other_service' => [Rule::requiredIf($request->has('other_service-on')), 'nullable', 'string', 'max:255'],
            'payment_method' => ['required', Rule::in(array_column(Order::getPaymentMethodOptions(), 'value'))],
        ]);

        $date = $data['date'] . ' ' . $data['time'];
        unset($data['date'], $data['time']);

        $data['date'] = strtotime($date);
        $data['user_id'] = auth()->id();
        if($request->has('other_service-on'))
            unset($data['service_id']);
        else
            unset($data['other_service']);

        $order = Order::create($data);

        return redirect()->route('home');
    }

    public function show(Order $order)
    {
        $order->load('user', 'service');

        return view('pages.orders-show')->with(compact('order'));
    }

    public function changeStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_column(Order::getStatusOptions(), 'value'))],
            'cancel_reason' => ['required_if:status,cancelled', 'nullable', 'string'],
        ]);

        $order->update($data);

        return redirect()->back();
    }
}
