<div class="pt-20 min-h-screen flex flex-col  items-center  sm:pt-20 bg-gray-100">
    @isset($logo)
        <div>
            {{ $logo }}
        </div>
    @endisset

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>