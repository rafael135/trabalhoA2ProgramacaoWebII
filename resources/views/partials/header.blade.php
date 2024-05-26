<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>lanches</title>
</head>
<body>
<!-- Inicio Header -->
<header class="w-full h-[420px] bg-zinc-900 bg-home bg-cover bg-center">
        <div class="w-full h-full flex flex-col justify-center items-center">
           <img src="{{Vite::asset("resources/img/hamb-1.png")}}" 
           alt="logo Burguer"
           class="w-32 h-32 rounded-full shadow-lg hover:scale-110 duration-200"/>
           <h1 class="text-4xl mt-4 mb-2 font-bold text-white">Burguer Dev</h1>
        </div>
</header>
<!-- Fim Header -->