<x-modal>
    <x-slot name="title">
        @if($showEdit)
            <div class="text-center text-2xl font-bold text-indigo-700">
                Edit Competitor
            </div>
        @else
            <div class="text-center text-2xl font-bold text-indigo-700">
                Add Competitor
            </div>
        @endif
    </x-slot>

    <x-slot name="content">
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">First Name</x-input-label>
            <x-text-input wire:model='first_name' class="mt-2 w-full px-4 py-2" placeholder="Enter the competitors first name.">
            </x-text-input>
            <x-input-error :messages="$errors->get('first_name')"></x-input-error>
        </div>

        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Surname</x-input-label>
            <x-text-input wire:model='surname' class="mt-2 w-full px-4 py-2" placeholder="Enter the competitor surname .">
            </x-text-input>
            <x-input-error :messages="$errors->get('surname')"></x-input-error>
        </div>
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Gender</x-input-label>
                <select wire:model="gender" class="mt-2 w-full px-4 py-2 rounded-lg border-gray-100">
                    <option value="">Enter the competitors Gender.</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            <x-input-error :messages="$errors->get('gender')"></x-input-error>
        </div>     
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">DOB</x-input-label>
            <x-text-input  wire:model='competitor_dob'  class="mt-2 w-full px-4 py-2" placeholder="Enter the DOB date.">
            </x-text-input>
            <x-input-error :messages="$errors->get('competitor_dob')"></x-input-error>
        </div>

        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Email</x-input-label>
            <x-text-input  wire:model='email'  class="mt-2 w-full px-4 py-2" placeholder="Enter the DOB date.">
            </x-text-input>
            <x-input-error :messages="$errors->get('email')"></x-input-error>
        </div>


    </x-slot>

    <x-slot name="buttons">
        <div class="w-full pt-5 ">
            <div class="flex justify-end">
              <button wire:click="$emit('closeModal')" type="button" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</button>
              @if($showEdit)
              <button wire:click="updateCompetitor('{{ $competitor_id }}')" type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Update</button>
              @else
                <button wire:click="saveCompetitor" type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
              @endif   
            </div>
          </div>
    </x-slot>
</x-modal>
