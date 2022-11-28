<x-modal>
    <x-slot name="title">
        Add New User
    </x-slot>

    <x-slot name="content">
        Hi! 👋
        The form goes Here
    </x-slot>

    <x-slot name="buttons">
        <div class="w-full pt-5 ">
            <div class="flex justify-end">
              <button wire:click="$emit('closeModal')" type="button" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</button>
              <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
            </div>
          </div>
    </x-slot>
</x-modal>