@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }} - Регистрация
@endsection

@section('content')

    <div class="grow w-full flex flex-col items-center justify-center px-6 py-8">
        <div class="w-full bg-teal-200 rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Создание аккаунта
                </h1>
                <form class="space-y-4 md:space-y-6" method="post" action="{{ route('user.register') }}">
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
                    <x-input
                        name="full_name"
                        label="ФИО"
                        placeholder="Иванов Иван Иванович"
                    />
                    <x-phone
                        name="phone"
                        label="Телефон"
                        placeholder="+7(XXX)-XXX-XX-XX"
                        :mask="['+7(###)-###-##-##']"
                    />
                    <x-input
                        name="email"
                        label="Адрес электронной почты"
                        placeholder="name@company.com"
                    />
                    <button type="submit" class="w-full text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Зарегистрироваться
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Уже есть аккаунт? <a href="{{ route('user.login') }}" class="font-medium text-sky-600 hover:underline">Войдите здесь</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

@endsection
