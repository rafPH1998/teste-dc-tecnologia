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
      <div class="flex justify-between container px-5 py-10 mx-auto">
        <ul class=" cursor-pointer text-sm">
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
        <div class="flex flex-row-reverse p-10 items-center">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="px-2 bg-gray-400 border rounded text-white ml-2">Sair</button>
          </form>
          <a type="text-xs">Bem vindo (a), {{auth()->user()->name}}</a>
        </div>
      </div>
      <div class="container px-5 py-10 mx-auto">
          {{ $slot }}
      </div>
    </body>
</html>