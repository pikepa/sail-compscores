<x-guest-layout>
    <div class="  relative flex items-top justify-center min-h-screen dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/client') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-blue-800">
            <div class="flex justify-center">
                <h1 class=" text-5xl  font-extrabold">CompScores</h1>
            </div>
            <div class="flex text-center justify-center text-xl ">
                The complete management system for all your Crossfit Competitions
            </div>
            @env('local')
            <div class="flex justify-center">
                <x-login-link email="pikepeter@gmail.com" />
            </div>
            <div class="flex justify-center">
                <x-login-link email="clientadmin@gmail.com" label='Client Admin' />
            </div>
            <div class="flex justify-center">
                <x-login-link email="compmanager@gmail.com" label='Comp Manager' />
            </div>
            @endenv
        </div>
    </div>
</x-guest-layout>