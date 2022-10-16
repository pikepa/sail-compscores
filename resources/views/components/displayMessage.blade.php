<div>
    @if (session()->has('message') && $this->displayMessage ==true)
        <button wire:click="toggleMessage()" type="submit">
            <div class="-mr-8 bg-green-100 font-extrabold rounded-lg py-5 px-6 mb-4 text-xl text-green-700 mb-3">
                {{session('message')}}
                <p class="text-xs ">Click to dismiss</p>
            </div>
        </button>
    @endif
</div>