@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }} - Заявки
@endsection

@section('content')

    <h1 class="text-xl mb-5">Заявки</h1>

    <a href="{{ route('orders.index') }}" class="cursor-pointer text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Создать заявку
    </a>

    <h2 class="text-xl my-5">История заявок</h2>

    <x-orders :orders="$orders" />

@endsection
