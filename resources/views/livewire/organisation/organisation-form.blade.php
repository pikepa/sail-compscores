@if(!$edit)<form wire:submit.prevent="saveOrg" class="mt-8 mx-auto w-full sm:max-w-md ">
    <div class="text-center text-indigo-700 text-3xl font-semibold ">
        <h1>Add Organisation</h1>
    </div>
@endif
@if($edit)
<form wire:submit.prevent="updateOrg('{{ $org_id }}')" class="mt-8 mx-auto w-full sm:max-w-md ">
    <div class="text-center text-indigo-700 text-3xl font-semibold ">
        <h1>Edit Organisation</h1>
    </div>
@endif
    <div class=" mt-4 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Organisation Name</x-input-label>
            <x-text-input wire:model='name' class="mt-2 w-full px-4 py-2" placeholder="Enter the organisation name.">
            </x-text-input>
            <x-input-error :messages="$errors->get('name')"></x-input-error>
        </div>
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Primary Contact</x-input-label>
            <x-text-input wire:model='contact_name' class="mt-2 w-full px-4 py-2"
                placeholder="Enter the primary contact's name."></x-text-input>
            <x-input-error :messages="$errors->get('contact_name')"></x-input-error>
        </div>
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Contact Email</x-input-label>
            <x-text-input wire:model='contact_email' class="mt-2 w-full px-4 py-2"
                placeholder="Enter the primary contact's Email"></x-text-input>
            <x-input-error :messages="$errors->get('contact_email')"></x-input-error>
        </div>
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Contact Phone</x-input-label>
            <x-text-input wire:model='contact_phone' class="mt-2 w-full px-4 py-2"
                placeholder="Enter the primary contact's Phone"></x-text-input>
            <x-input-error :messages="$errors->get('contact_phone')"></x-input-error>
        </div>
        <div class="flex justify-center space-x-8">
            <button wire:click="$emitUp('toggleForm')"
            class="mt-6  items-center rounded-md border border-transparent bg-yellow-500 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Cancel
            </button>
            <button type="submit"
                class="mt-6  items-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Submit
            </button>

        </div>
    </div>
</form>