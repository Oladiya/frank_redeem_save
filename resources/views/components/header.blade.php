<header class="bg-orange-500 text-orange-50 w-full max-w-2xl p-2 sm:mt-5 mb-3 sm:rounded-xl">
    <nav>
        <ul class="flex w-full justify-between sm:px-4">
            <div>
                <a href="{{ route('home') }}">
                    <li>{{ env('APP_NAME') }}</li>
                </a>
            </div>
            <div>

            </div>
            <div class="flex gap-5">
                @guest
                    <li>
                        <a href="{{ route('user.login') }}">Вход</a>
                    </li>
                    <li>
                        <a href="{{ route('user.registration') }}">Регистрация</a>
                    </li>
                @endguest
                @auth
                    <li>
                        <a href="{{ route('user.logout') }}">Выйти</a>
                    </li>
                @endauth
            </div>
        </ul>
    </nav>
</header>
