@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }} - Вход
@endsection

@section('content')

    <div class="grow w-full flex flex-col items-center justify-center px-6 py-8">
        <div class="w-full bg-teal-200 rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Создание заявки
                </h1>

                <x-errors only="log-in" icon="shield-exclamation" />

                <form class="space-y-4 md:space-y-6" method="post" action="{{ route('orders.create') }}">
                    @csrf
                    <x-input
                        name="address"
                        label="Адрес"
                        placeholder="г. Москва, ул. Арбат, д. 12, кв. 34"
                    />
                    <x-phone
                        name="phone"
                        label="Телефон"
                        placeholder="+7(XXX)-XXX-XX-XX"
                        :mask="['+7(###)-###-##-##']"
                    />
                    <div class="flex gap-5">
                        <x-datetime-picker
                            name="date"
                            label="Дата"
                            placeholder="01.01.2026"
                            start-of-week="1"
                            without-time
                            disable-past-dates
                            requires-confirmation
                        />
                        <x-time-picker
                            name="time"
                            label="Время"
                            placeholder="12:00"
                            without-seconds
                            military-time
                        />
                    </div>
                    <x-select
                        name="service_id"
                        label="Услуга"
                        placeholder="Выберите услугу"
                        :options="$services"
                        option-label="name"
                        option-value="id"
                    />
                    <x-checkbox
                        name="other_service-on"
                        label="Иная услуга"
                    />
                    <x-input
                        name="other_service"
                        label="Иная услуга"
                        placeholder="Другая услуга"
                    />
                    <x-select
                        name="payment_method"
                        label="Тип оплаты"
                        placeholder="Выберите тип оплаты"
                        :options="\App\Models\Order::getPaymentMethodOptions()"
                        option-label="name" option-value="value"
                    />
                    <button type="submit" class="w-full text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Создать заявку
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
