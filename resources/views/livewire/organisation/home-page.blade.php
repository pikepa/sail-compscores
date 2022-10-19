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
                    <div>
                        @can('read-comps')
                        <h1>Our Competitions</h1>
                        @endcan
                    </div>
                    <div>
                        @can('read-users')
                        <h1>Our Users</h1>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
