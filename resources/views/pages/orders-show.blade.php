@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }} - Заявка №{{ $order->id }}
@endsection

@section('content')

    <div class="mx-auto p-6 bg-teal-200 rounded-lg shadow-md mt-10 font-sans">
        <h1 class="text-2xl font-bold mb-6 border-b pb-2">Заявка №{{ $order->id }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            <div>
                <h2 class="font-semibold text-gray-700">ФИО заказчика</h2>
                <p class="text-gray-900">{{ $order->user->full_name }}</p>
            </div>
            <div>
                <h2 class="font-semibold text-gray-700">Телефон</h2>
                <p class="text-gray-900">{{ $order->phone }}</p>
            </div>
            <div class="md:col-span-2">
                <h2 class="font-semibold text-gray-700">Адрес</h2>
                <p class="text-gray-900">{{ $order->address }}</p>
            </div>
            <div>
                <h2 class="font-semibold text-gray-700">Сервис</h2>
                <p class="text-gray-900">@if(isset($order->service)) {{ $order->service->name }} @else {{ $order->other_service }} @endif</p>
            </div>
            <div>
                <h2 class="font-semibold text-gray-700">Дата и время</h2>
                <p class="text-gray-900">{{ $order->date->format('d.m.Y H:i') }}</p>
            </div>
            <div>
                <h2 class="font-semibold text-gray-700">Способ оплаты</h2>
                <p class="text-gray-900">{{ __($order->payment_method) }}</p>
            </div>
            <div>
                <h2 class="font-semibold text-gray-700">Статус</h2>
                <p class="@if($order->status === 'new') text-yellow-600 @elseif($order->status === 'in work') text-blue-600 @elseif($order->status === 'completed') text-green-600 @elseif($order->status === 'cancelled') text-red-600 @endif font-semibold">{{ __($order->status) }}</p>
            </div>
            @isset($order->cancel_reason)
                <div class="md:col-span-2">
                    <h2 class="font-semibold text-gray-700">Причина отмены</h2>
                    <p class="text-red-600 italic font-semibold">{{ $order->cancel_reason }}</p>
                </div>
            @endisset
        </div>
    </div>

    @if(auth()->user()->is_admin && $order->status !== 'cancelled' && $order->status !== 'completed')

        <h2 class="text-xl font-semibold mt-5">Изменить статус заявки</h2>

        <div class="flex flex-col mt-3 max-w-md">
            @if($order->status === 'new')
            <form class="w-full" method="post" action="{{ route('orders.change-status', $order->id) }}">
                @csrf
                <input name="status" type="text" value="in work" hidden="">
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    В работе
                </button>
            </form>
            @elseif($order->status === 'in work')
                <form class="w-full" method="post" action="{{ route('orders.change-status', $order->id) }}">
                    @csrf
                    <input name="status" type="text" value="completed" hidden="">
                    <button type="submit" class="w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Завершено
                    </button>
                </form>
            @endif

            <form class="flex items-start gap-5" method="post" action="{{ route('orders.change-status', $order->id) }}">
                @csrf
                <input name="status" type="text" value="cancelled" hidden="">
                <x-input
                    name="cancel_reason"
                    placeholder="Причина отмены"
                />
                <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    Отменено
                </button>
            </form>
        </div>

    @endif

@endsection
