@extends("layouts.layout")

@section("content")

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />



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

<!--PRODUTOS-->
        <div class="flex gap-2">
             <img src="{{Vite::asset("resources/img/hamb-1.png")}}" 
           alt="logo Burguer"
           class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300 "/>
           
           <div>
            <p class="font-bold">Hamburguer Smash</p>
            <p class="text-sm">Pão levinho de fermentação natural da trigou, burger 160g, queijo prato e maionese da casa.</p>

            <div class="flex items-center gap-2 justify-between">
                <p class="font-bold text-lg">R$ 18.90</p>
                <button class="bg-red-700 px-5 rounded add-to-cart-btn" data-name="Hamburguer Smash" data-price="18.90">
                    <i class="fa fa-trash text-lg text-white "></i>
                </button>
            </div>

           </div>

        </div>
<!--FIM PRODUTOS-->

<!--PRODUTOS 2-->
        <div class="flex gap-2">
             <img src="{{Vite::asset("resources/img/hamb-2.png")}}" 
           alt="Hamburguer Duplo"
           class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300"/>
           
           <div>
            <p class="font-bold">Hamburguer Duplo</p>
            <p class="text-sm">Pão levinho de fermentação natural da trigou, burger 160g, queijo prato e maionese da casa.</p>

            <div class="flex items-center gap-2 justify-between">
                <p class="font-bold text-lg">R$ 32.90</p>
                <button class="bg-red-700 px-5 rounded add-to-cart-btn" data-name="Hamburguer Smash" data-price="18.90">
                    <i class="fa fa-trash text-lg text-white "></i>
                </button>
            </div>

           </div>

        </div>
<!--FIM PRODUTOS-->

<!--PRODUTOS 3-->
        <div class="flex gap-2">
             <img src="{{Vite::asset("resources/img/hamb-3.png")}}" 
           alt="Hamburguer Duplo"
           class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300"/>
           
           <div>
            <p class="font-bold">Hamburguer Duplo</p>
            <p class="text-sm">Pão levinho de fermentação natural da trigou, burger 160g, queijo prato e maionese da casa.</p>

            <div class="flex items-center gap-2 justify-between">
                <p class="font-bold text-lg">R$ 32.90</p>
                <button class="bg-red-700 px-5 rounded add-to-cart-btn" data-name="Hamburguer Smash" data-price="18.90">
                    <i class="fa fa-trash text-lg text-white "></i>
                </button>
            </div>

           </div>

        </div>
<!--FIM PRODUTOS-->

<!--PRODUTOS 4-->
        <div class="flex gap-2">
             <img src="{{Vite::asset("resources/img/hamb-4.png")}}" 
           alt="Hamburguer Duplo"
           class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300"/>
           
           <div>
            <p class="font-bold">Hamburguer Duplo</p>
            <p class="text-sm">Pão levinho de fermentação natural da trigou, burger 160g, queijo prato e maionese da casa.</p>

            <div class="flex items-center gap-2 justify-between">
                <p class="font-bold text-lg">R$ 32.90</p>
                <button class="bg-red-700 px-5 rounded add-to-cart-btn" data-name="Hamburguer Smash" data-price="18.90">
                    <i class="fa fa-trash text-lg text-white "></i>
                </button>
            </div>

           </div>

        </div>
<!--FIM PRODUTOS-->

<!--PRODUTOS 5-->
        <div class="flex gap-2">
             <img src="{{Vite::asset("resources/img/hamb-5.png")}}" 
           alt="Hamburguer Duplo"
           class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300"/>
           
           <div>
            <p class="font-bold">Hamburguer Duplo</p>
            <p class="text-sm">Pão levinho de fermentação natural da trigou, burger 160g, queijo prato e maionese da casa.</p>

            <div class="flex items-center gap-2 justify-between">
                <p class="font-bold text-lg">R$ 32.90</p>
                <button class="bg-red-700 px-5 rounded add-to-cart-btn" data-name="Hamburguer Smash" data-price="18.90">
                    <i class="fa fa-trash text-lg text-white "></i>
                </button>
            </div>

           </div>

        </div>
<!--FIM PRODUTOS-->

<!--PRODUTOS 6-->
        <div class="flex gap-2">
             <img src="{{Vite::asset("resources/img/hamb-6.png")}}" 
           alt="Hamburguer Duplo"
           class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300"/>
           
           <div>
            <p class="font-bold">Hamburguer Duplo</p>
            <p class="text-sm">Pão levinho de fermentação natural da trigou, burger 160g, queijo prato e maionese da casa.</p>

            <div class="flex items-center gap-2 justify-between">
                <p class="font-bold text-lg">R$ 32.90</p>
                <button class="bg-red-700 px-5 rounded add-to-cart-btn" data-name="Hamburguer Smash" data-price="18.90">
                    <i class="fa fa-trash text-lg text-white "></i>
                </button>
            </div>

           </div>

        </div>
<!--FIM PRODUTOS-->

<!--PRODUTOS 7-->
        <div class="flex gap-2">
             <img src="{{Vite::asset("resources/img/hamb-7.png")}}" 
           alt="Hamburguer Duplo"
           class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300"/>
           
           <div>
            <p class="font-bold">Hamburguer Duplo</p>
            <p class="text-sm">Pão levinho de fermentação natural da trigou, burger 160g, queijo prato e maionese da casa.</p>

            <div class="flex items-center gap-2 justify-between">
                <p class="font-bold text-lg">R$ 32.90</p>
                <button class="bg-red-700 px-5 rounded add-to-cart-btn" data-name="Hamburguer Smash" data-price="18.90">
                    <i class="fa fa-trash text-lg text-white "></i>
                </button>
            </div>

           </div>

        </div>
<!--FIM PRODUTOS-->

<!--PRODUTOS 8-->
        <div class="flex gap-2">
             <img src="{{Vite::asset("resources/img/hamb-8.png")}}" 
           alt="Hamburguer Duplo"
           class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300"/>
           
           <div>
            <p class="font-bold">Hamburguer Duplo</p>
            <p class="text-sm">Pão levinho de fermentação natural da trigou, burger 160g, queijo prato e maionese da casa.</p>

            <div class="flex items-center gap-2 justify-between">
                <p class="font-bold text-lg">R$ 32.90</p>
                <button class="bg-red-700 px-5 rounded add-to-cart-btn" data-name="Hamburguer Smash" data-price="18.90">
                    <i class="fa fa-trash text-lg text-white "></i>
                </button>
            </div>

           </div>

        </div>
<!--FIM PRODUTOS-->

        </main>
    </div>

    <footer class="w-full bg-neutral-900 py-2 bottom-0 z-40 flex items-center justify-center">
        <span class="items-center justify-center text-white">@ 2024 Todos os direitos reservados By BurguerDev</span>
    </footer>
@endsection