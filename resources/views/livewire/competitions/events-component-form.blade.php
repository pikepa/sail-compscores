<x-modal>
    <x-slot name="title">
        @if($showEdit)
            <div class="text-center text-2xl font-bold text-indigo-700">
                Edit Event
            </div>
        @else
            <div class="text-center text-2xl font-bold text-indigo-700">
                Add New Event
            </div>
        @endif
    </x-slot>

    <x-slot name="content">
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Event Name</x-input-label>
            <x-text-input wire:model='event_name' class="mt-2 w-full px-4 py-2" placeholder="Enter the event name.">
            </x-text-input>
            <x-input-error :messages="$errors->get('event_name')"></x-input-error>
        </div>
        
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Event Description</x-input-label>
            <textarea rows="4" wire:model='event_description' class="mt-2 w-full px-4 py-2" placeholder="Enter the event description.">
            </textarea>
            <x-input-error :messages="$errors->get('event_description')"></x-input-error>
        </div>
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Event Type</x-input-label>
                <select wire:model="event_type" class="mt-2 w-full px-4 py-2 rounded-lg border-gray-100">
                    <option value="">Select the event type.</option>
                    <option value="Max Reps">Max Reps</option>
                    <option value="For Time">For Time</option>
                    <option value="Max Wgt">Max Wgt</option>
                    <option value="Combined Wgt">Combined Wgt</option>
                </select>
            <x-input-error :messages="$errors->get('event_type')"></x-input-error>
        </div>

        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Date</x-input-label>
            <x-text-input  wire:model='event_date'  class="mt-2 w-full px-4 py-2" placeholder="Enter the event date.">
            </x-text-input>
            <x-input-error :messages="$errors->get('event_date')"></x-input-error>
        </div>
        <div>
            <x-input-label class="text-indigo-700 mt-2 font-bold">Time</x-input-label>
            <x-text-input wire:model='event_time' class="mt-2 w-full px-4 py-2" placeholder="Enter the scheduled event time.">
            </x-text-input>
            <x-input-error :messages="$errors->get('event_time')"></x-input-error>
        </div>

    </x-slot>

    <x-slot name="buttons">
        <div class="w-full pt-5 ">
            <div class="flex justify-end">
              <button wire:click="$emit('closeModal')" type="button" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</button>
              @if($showEdit)
              <button wire:click="updateEvent('{{ $event_id }}')" type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Update</button>
              @else
                <button wire:click="saveEvent" type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
              @endif   
            </div>
          </div>
    </x-slot>
</x-modal>
