<div class="flex gap-2">
    <img src="{{ Vite::asset('public/') }}" alt="logo Burguer"
        class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300 " />

    <div>
        <p class="font-bold">{{ $name }}</p>
        <p class="text-sm">{{ $description }}</p>

        <div class="flex items-center gap-2 justify-between">
            <p class="font-bold text-lg">R$ {{ round($price, 2) }}</p>
            <button class="bg-red-700 px-5 rounded add-to-cart-btn" data-name="{{ $name }}" data-price="{{ round($price, 2) }}">
                <i class="fa fa-trash text-lg text-white "></i>
            </button>
        </div>

    </div>

</div>
