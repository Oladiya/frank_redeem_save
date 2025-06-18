@props(['orders'])


<ul class="max-w-sm md:max-w-md divide-y divide-teal-200 dark:divide-gray-700">

    @foreach($orders as $order)

        <li class="pb-3 sm:pb-4">
            <a href="{{ route('orders.show', $order->id) }}">
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            @if(isset($order->service)) {{ $order->service->name }} @else {{ $order->other_service }} @endif
                        </p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                            {{ $order->date->format('d.m.Y H:i') }}
                        </p>
                    </div>
                    <div class="@if($order->status === 'new') text-yellow-600 @elseif($order->status === 'in work') text-blue-600 @elseif($order->status === 'completed') text-green-600 @elseif($order->status === 'cancelled') text-red-600 @endif inline-flex items-center text-base font-semibold dark:text-white">
                        {{ __($order->status) }}
                    </div>
                </div>
            </a>
        </li>

    @endforeach

</ul>

