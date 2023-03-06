<div>
    @section('title', 'Competitors')
    <div>
        @if(! $displayForm)

        <div class="max-w-4xl mx-auto">
            <div class="mt-4 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle">
                        <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-slate-300">
                                    <tr class="">
                                        <div>
                                            <x-table.header>Competitor Name</x-table.header>
                                            <x-table.header>Entry Status</x-table.header>
                                            <x-table.header>Created</x-table.header>
                                        </div>
                                        <div>
                                            @can('update-competitor')
                                            <x-table.header>
                                                @can('create-competitor')
                                                <button wire:click="$emit('openModal', 'competitions.competitors-component-form')"
                                                    class="relative inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                                                    Add Competitor
                                                </button>
                                                @endcan
                                            </x-table.header>
                                            @endcan
                                        </div>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-slate-200 bg-slate-50">
                                    @foreach($competitors as $competitor)
                                    <tr wire:key="competitor-{{ $competitor->id }}">
                                        <div>
                                            <x-table.detail>{{ $competitor->display_name }}</x-table.detail>
                                            <x-table.detail>{{ $competitor->pivot->entry_status }}</x-table.detail>
                                            <x-table.detail>{{ $competitor->pivot->created_at->format('D, jS M Y') }}</x-table.detail>
                                        </div>
                                        <div>
                                            @can('update-competitor')
                                            <x-table.detail>
                                                <div class="flex flex-row justify-around">
                                                    <button wire:click='$emit("openModal", "competitions.competitors-component-form",@json(["id" => " $competitor->id "]))' type="button"
                                                        class="text-indigo-600 text-center hover:text-indigo-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                    </button>

                                                    @can('delete-competitor')
                                                    <button wire:click="deleteCompetitor('{{ $competitor->id }}')" type="button"
                                                        class="text-indigo-600 text-center hover:text-indigo-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </button>
                                                    @endcan

                                            </x-table.detail>
                                            @endcan
                                        </div>
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
    @else
    <!-- Add Organisation Form  -->
    <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
        Im Here
    </div>
    @endif
</div>
