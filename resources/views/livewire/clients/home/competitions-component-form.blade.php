<x-modal>
    <x-slot name="title">
        <div class="text-center text-2xl font-bold text-indigo-700">
            Add New Competition
        </div>
    </x-slot>

    <x-slot name="content">
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Competition Name</x-input-label>
            <x-text-input wire:model='comp_name' class="mt-2 w-full px-4 py-2" placeholder="Enter the competition name.">
            </x-text-input>
            <x-input-error :messages="$errors->get('comp_name')"></x-input-error>
        </div>
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Venue</x-input-label>
            <x-text-input wire:model='comp_venue' class="mt-2 w-full px-4 py-2" placeholder="Enter the venue name.">
            </x-text-input>
            <x-input-error :messages="$errors->get('comp_venue')"></x-input-error>
        </div>
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Type</x-input-label>
            <!-- <x-text-input wire:model='comp_type' class="mt-2 w-full px-4 py-2" placeholder="Enter the competition date.">
            </x-text-input> -->
                <select wire:model="comp_type" class="mt-2 w-full px-4 py-2 rounded-lg border-gray-100">
                    <option value="Individual">Individual</option>
                    <option value="Teams">Teams</option>
                </select>

            <x-input-error :messages="$errors->get('comp_type')"></x-input-error>
        </div>
        
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Date</x-input-label>
            <x-text-input wire:model='start_date' class="mt-2 w-full px-4 py-2" placeholder="Enter the competition date.">
            </x-text-input>
            <x-input-error :messages="$errors->get('start_date')"></x-input-error>
        </div>

    </x-slot>

    <x-slot name="buttons">
        <div class="w-full pt-5 ">
            <div class="flex justify-end">
              <button wire:click="$emit('closeModal')" type="button" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</button>
              <button wire:click="saveComp" type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
            </div>
          </div>
    </x-slot>
</x-modal>