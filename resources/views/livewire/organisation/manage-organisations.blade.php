    @section('title', 'My Organisations')
    <div>


    @if(! $displayForm)

    <div class="max-w-4xl mx-auto">
        <!-- page Header -->
        <div class="-ml-8 mt-4 sm:flex sm:items-center">
            <div class="sm:flex-row">
                @role('SuperAdmin')
                <h1 class="text-3xl font-semibold text-indigo-700">All Organisations</h1>
                @else
                <h1 class="text-3xl font-semibold text-indigo-700">My Organisations</h1>
                @endrole
                <p class="mt-2 text-sm text-gray-700">A list of all the organisations in your account including their
                    name and contact details.</p>
            </div>
        </div>

        @if($orgs->count())
        <div class="mt-4 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-slate-300">
                                <tr>
                                    <x-table.header>Organisation Name</x-table.header>
                                    <x-table.header>Primary Contact</x-table.header>
                                    <x-table.header>Email</x-table.header>
                                    <x-table.header>Phone</x-table.header>
                                    @can('update-org')
                                    <x-table.header>
                                        @role('SuperAdmin')
                                        <button wire:click="displayForm" type="button"
                                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                                            Add New
                                        </button> @endrole
                                    </x-table.header>
                                    @endcan
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-200 bg-slate-50">
                                @foreach($orgs as $org)
                                <tr>
                                    <x-table.detail>
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">{{ $org->name }}<span
                                                class="sr-only">, {{ $org->name }} </span></a>
                                    </x-table.detail>
                                    <x-table.detail>{{ $org->contact_name }}</x-table.detail>
                                    <x-table.detail>{{ $org->contact_email }}</x-table.detail>
                                    <x-table.detail>{{ $org->contact_phone }}</x-table.detail>
                                    @can('update-org')
                                    <x-table.detail>
                                        <a href="#" class="text-indigo-600 text-center hover:text-indigo-900">Edit<span
                                                class="sr-only">, {{ $org->name }} </span></a>
                                    </x-table.detail>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>



</div>
@else
<!-- Add Organisation Form  -->
<div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
    @livewire('organisation.organisation-form')
</div>
@endif