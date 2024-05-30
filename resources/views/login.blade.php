@extends('layouts.layout')

@section('content')
    <div class="authForm-container">
        <form method="POST" action="{{ route('loginAction') }}"
            class="flex flex-col gap-1 max-w-sm mx-auto w-80 my-auto p-0 rounded-lg shadow-md border border-solid border-gray-600/40">

            @csrf
            <div class="bg-blue-600 flex justify-center items-center rounded-t-lg p-2">
                <p class="text-xl font-bold text-white">Login</p>
            </div>

            <div class="mx-3">
                <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Email:</label>
                <input type="email" name="email" id="email" aria-describedby="helper-text-explanation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="exemplo@email.com">

                <!--<p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">We’ll never share your details.
                        Read our <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Privacy
                            Policy</a>.</p>-->
            </div>
            <div class="mx-3">
                <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Senha:</label>
                <input type="password" name="password" id="password" aria-describedby="helper-text-explanation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Senha">

                <!--<p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">We’ll never share your details.
                        Read our <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Privacy
                            Policy</a>.</p>-->
            </div>

            <div class="mx-3">
                <p class="text-slate-800">Não possui conta? <a class="text-blue-500 hover:underline hover:text-blue-600" href="{{ route("registerView") }}">Registre-se!</a></p>
            </div>

            <div class="mt-1">
                <button class="rounded-b-lg rounded-t-none" type="submit">
                    Entrar
                </button>
            </div>
        </form>
    </div>
@endsection
