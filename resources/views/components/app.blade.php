<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>

    </head>
    <body class="bg-gray-200 text-black font-light">
      <div class="flex justify-between container px-5 py-10 mx-auto border border-gray-300 mt-4 rounded bg-gray-100">
        <div>
          <ul class="flex cursor-pointer text-sm">
            <li class="p-2 border border-gray-300 {{ request()->is('products*') ? 'bg-gray-300' : '' }}">
              <a href="{{ route('products.index') }}">Produtos</a>
            </li>
            <li class="p-2 border border-gray-300 {{ request()->is('sales*') ? 'bg-gray-300' : '' }}">
              <a href="{{ route('sales.index') }}">Vendas</a>
            </li>
            <li class="p-2 border border-gray-300 {{ request()->is('clients*') ? 'bg-gray-300' : '' }}">
              <a href="{{ route('clients.index') }}">Clientes</a>
            </li>
          </ul>
        </div>
        <div class="flex flex-row-reverse items-center">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="px-2 bg-gray-400 border rounded text-white ml-4">Sair</button>
          </form>
          <a type="text-xs">Bem vindo (a), {{auth()->user()->name}}</a>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
          </svg>
        </div>
      </div>
      <div class="container px-5 py-10 mx-auto">
          {{ $slot }}
      </div>
    </body>
</html>