<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @routes
    <title>Lanches</title>
</head>

<body>
    <!-- Inicio Header -->
    <header class="relative w-full h-[420px] bg-zinc-900 bg-home bg-cover bg-center">
        <div class="absolute top-0 right-0 botao mx-auto max-w-screen-lg py-1 flex items-center justify-end">
            @if($loggedUser != null)
                <button class="bg-black-200 h-21 w-24 rounded text-white">
                    {{ $loggedUser->name }}
                </button>
                <a href="{{ route("logoutAction") }}" class="flex justify-center items-center gap-2 bg-red-800 h-21 w-28 p-2 rounded text-white hover:bg-red-900">
                    Sair
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                    </svg>
                </a>
            @else

            @endif
        </div>

        <div class="w-full h-full flex flex-col justify-center items-center">
            <a href="{{ route("homeView") }}">
                <img src="{{ Vite::asset("resources/img/hamb-1.png") }}" alt="logo Burguer"
                    class="w-32 h-32 rounded-full shadow-lg hover:scale-110 duration-200" />
            </a>
            <a href="{{ route("homeView") }}"><h1 class="text-4xl mt-4 mb-2 font-bold text-white">Burguer Dev</h1></a>
        </div>
    </header>
    <!-- Fim Header -->
