@extends('layouts.layout')

@section('content')
    @csrf
    <input type="hidden" id="rememberToken" value="{{ $loggedUser->remember_token }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <h2 class="text-2x1 md:text-3x1 font-bold text-center mt-9 mb-6"> Adicionar lanches</h2>


    <x-deleteLancheModal />
    <x-editLancheModal />

    <!-- INPUTS PARA ADD -->

    <div class="flex justify-center items-center ">
        <div class="max-w-screen-lg mb-16 flex gap-2">

            <button class="bg-blue-900 px-5 h-21 w-28 p-2 rounded text-white hover:bg-blue-950"
                data-modal-target="addLancheModal" data-modal-toggle="addLancheModal" onclick="resetAddForm()">
                Adicionar
            </button>

            <a class="bg-green-900 px-5 h-25 w-30 p-2 rounded text-white hover:bg-green-950" href="{{ route("graficoView") }}">
                Grafico de vendas
            </a>
        </div>
    </div>

    <div id="addLancheModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Adicionar
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="addLancheModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="formAddLanche" method="POST" action="{{ route('registerLancheAction') }}"
                    enctype="multipart/form-data" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor</label>
                            <input type="number" step="0.01" value="0.00" name="price" id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="quantity"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantidade</label>
                            <input type="number" name="quantity" id="quantity"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                        </div>
                        <div class="col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                            <textarea id="description" name="description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                        </div>
                        <div class="col-span-2 sm:col-span-1 w-[160%] min-w-[360px] flex flex-col gap-2">
                            <input id="image" name="image" type="file" accept=".png, .jpg, .jpeg"
                                multiple="false" />
                            <div
                                class="w-[80%] mx-auto p-2 flex justify-center items-center border border-solid border-gray-600/40 rounded-lg">
                                <img class="" id="imageView" />
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Adicionar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- FIM DOS INPUTS PARA ADD -->

    <!--Menu-->

    <div id="menu">

        <main class="grid grid-cols-1 md:grid-cols-2 gap-7 mx-auto max-w-screen-2xl px-2 mb-16">

            @foreach ($lanches as $lanche)
                <x-lanche :id="$lanche->id" :name="$lanche->name" :description="$lanche->description" :price="$lanche->price" :imageUrl="$lanche->image_url" />
            @endforeach

        </main>
    </div>

    <script src="{{ Vite::asset('resources/js/home.js') }}"></script>
@endsection
