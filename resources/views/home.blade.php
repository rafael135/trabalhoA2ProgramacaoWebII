@extends('layouts.layout')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <h2 class="text-2x1 md:text-3x1 font-bold text-center mt-9 mb-6"> Adicionar lanches</h2>



    <!-- INPUTS PARA ADD -->

    <div class="">
        <form class="mx-auto max-w-screen-lg px-4 mb-16 ">
            <input type="text" class="rounded-lg " placeholder="Nome">
            <input type="text" class="rounded-lg" placeholder="Descrição">
            <input type="text" class="rounded-lg" placeholder="Quantidade">
            <input type="text" class="rounded-lg h-21 w-28" placeholder="Valor">
            <button class="bg-blue-700 px-5 h-21 w-28 p-2 rounded add-to-upload-btn" data-name="upload">
                <i class="fa fa-upload text-lg text-white"></i>
            </button>
            <button class="bg-green-900 px-5 h-21 w-28 p-2 rounded add-to-upload-btn text-white">
                Adicionar
            </button>
        </form>
    </div>
    <!-- FIM DOS INPUTS PARA ADD -->

    <!--Menu-->

    <div id="menu">

        <main class="grid grid-cols-1 md:grid-cols-2 gap-7 mx-auto max-w-screen-2xl px-2 mb-16">

            @foreach ($lanches as $lanche)
                <x-lanche :name="$lanche->name" :description="$lanche->description" :price="$lanche->price" :image_url="$lanche->image_url" />
            @endforeach

        </main>
    </div>

    <footer class="w-full bg-neutral-900 py-2 bottom-0 z-40 flex items-center justify-center">
        <span class="items-center justify-center text-white">@ 2024 Todos os direitos reservados By BurguerDev</span>
    </footer>
@endsection
