@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }} - Вход
@endsection

@section('content')

    <div class="grow w-full flex flex-col items-center justify-center px-6 py-8">
        <div class="w-full bg-teal-200 rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Войти в Ваш аккаунт
                </h1>

                <x-errors only="log-in" icon="shield-exclamation" />

                <form class="space-y-4 md:space-y-6" method="post" action="{{ route('user.authenticate') }}">
                    @csrf
                    <x-input
                        name="login"
                        label="Логин"
                        placeholder="ivan.ivanov"
                    />
                    <x-input
                        name="password"
                        type="password"
                        label="Пароль"
                        placeholder="••••••••"
                    />
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <x-checkbox
                                name="remember"
                                label="Запомнить меня"
                            />
                        </div>
                    </div>
                    <button type="submit" class="w-full text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Войти</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Ещё нет аккаунта? <a href="{{ route('user.registration') }}" class="font-medium text-sky-600 hover:underline dark:text-primary-500">Зарегистрируйтесь</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
