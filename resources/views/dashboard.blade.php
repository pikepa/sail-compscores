<x-app-layout>
    @section('title', 'Dashboard')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6 bg-white border-b border-gray-200">
                    <div>
                        @role('SuperAdmin')
                        <livewire:users.manage-users />
                        @endrole
                    </div>
                    <div>
                        @can('read-role')
                        <h1>All Roles Listings</h1>
                        @endcan
                    </div>
                    <div>
                        @can('read-permissions')
                        <h1>All Permission Listing</h1>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>