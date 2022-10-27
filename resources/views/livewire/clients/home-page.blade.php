@section('title', 'Client Homepage')

<x-slot name="header">
    <h2 class="font-semibold text-3xl text-indigo-800 leading-tight">
        {{ session('APP_PAGE_TITLE') }}
    </h2>
</x-slot>

<div class="">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 space-y-6 bg-white border-b border-gray-200">
                <div class="flex flex-col space-y-12">
                    <div>
                        @can('read-comp')
                        <h1 class="text-2xl font-semibold text-indigo-700">Our Competitions</h1>
                        <livewire:clients.home.competitions-component :client="$client->id" />
                        @endcan
                    </div>
                    <div class="mt-6 border-t-gray-300">
                        @can('read-user')
                        <h1 class="text-2xl font-semibold text-indigo-700">Our Users</h1>
                        <livewire:clients.home.users-component :client="$client->id" />
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>