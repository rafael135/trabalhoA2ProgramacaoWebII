<div class="lanche flex gap-2" data-id="{{ $id }}">
    <img src="{{ Vite::asset("storage/app/public/$imageUrl") }}" alt="logo Burguer"
        class="lanche-img w-28 h-28 rounded-md cursor-pointer hover:scale-110 hover:-rotate-2 duration-300" />

        

    <div class="flex-1">
        <p class="lanche-name font-bold">{{ $name }}</p>
        <p class="lanche-description text-sm">{{ $description }}</p>

        <div class="flex items-center gap-2 justify-between">
            <p class="lanche-price font-bold text-lg">R$ {{ number_format($price, 2, ',', '.') }}</p>
            <div class="justify-end">
                <button data-modal-target="editLancheModal" data-modal-toggle="editLancheModal" class="bg-yellow-500 px-5 rounded hover:bg-yellow-600"
                    data-id="{{ $id }}" onclick="selectLancheUpdate(this)">
                    <i class="fa fa-pencil text-lg text-white "></i>
                </button>

                
                <button class="bg-red-700 px-5 rounded hover:bg-red-800" data-modal-target="deleteLancheModal" data-modal-toggle="deleteLancheModal"
                    data-id="{{ $id }}" onclick="selectLancheDelete(this)">
                    <i class="fa fa-trash text-lg text-white "></i>
                </button>
                
            </div>
        </div>
        <div class="flex justify-center items-center gap-2">
            <button class="bg-slate-800 px-5 text-white rounded hover:bg-slate-900" data-modal-target="simulateVendaModal" data-modal-toggle="simulateVendaModal"
                data-id="{{ $id }}" onclick="selectLancheSimulateVenda(this)">
                Simular venda
                <i class="fa-solid fa-cart-shopping"></i>
            </button>
        </div>

    </div>

</div>
