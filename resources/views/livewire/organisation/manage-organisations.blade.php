<div>
    @section('title', 'My Organisations')

    <x-slot name="header">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                @role('SuperAdmin')
                <h1 class="text-2xl font-semibold text-indigo-700">All Organisations</h1>
                @else
                <h1 class="text-2xl font-semibold text-indigo-700">My Organisations</h1>
                @endrole
                <p class="mt-2 text-sm text-gray-700">A list of all the organisations in your account including their
                    name and contact details.</p>
            </div>
            @role('SuperAdmin')
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button type="button"
                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add
                    Organisation</button>
            </div>
            @endrole

    </x-slot>

    <div class="max-w-4xl mx-auto px-4   sm:px-6 lg:px-8">
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-slate-300">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">
                                        Organisation Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Primary Contact</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Email</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Phone</th>
                                        @can('edit-org')
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-slate-50">
                                @foreach($orgs as $org)
                                <tr>
                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                        {{ $org->name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $org->contact_name }} </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $org->contact_email }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $org->contact_phone }}</td>
                                    @can('edit-org')
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 lg:pr-8">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span
                                                class="sr-only">, Lindsay Walton</span></a>
                                    </td>
                                    @endcan
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>