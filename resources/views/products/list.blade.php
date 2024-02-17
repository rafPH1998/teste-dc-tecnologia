<x-app>
  <h1 class="sm:text-xl font-bold text-gray-600 text-xs">Lista de produtos cadastrados no sistema</h1>
  <div class="flex flex-row-reverse">
    <a href="{{route('products.create')}}" class="rounded bg-gray-500 hover:bg-gray-600 px-2 py-1 text-white text-sm font-bold flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
      </svg>
      Cadastrar um produto
    </a>
  </div>
  @if ($products->count() > 0)
    <table class="min-w-full border rounded mt-4 shadow-md"">
      <thead class="bg-blue-500 text-white text-xs">
        <tr>
          <th scope="col" class="p-2 font-medium sm:px-6 sm:py-4 text-left">#</th>
          <th scope="col" class="p-2 font-medium sm:px-6 sm:py-4 text-left">Produto</th>
          <th scope="col" class="p-2 font-medium sm:px-6 sm:py-4 text-left">Preço do produto</th>
          <th scope="col" class="p-2 font-medium sm:px-6 sm:py-4 text-left">Quantidade</th>
          <th scope="col" class="p-2 font-medium sm:px-6 sm:py-4 text-left">Cliente</th>
        </tr>
      </thead>
        @foreach ($products as $product)
          <tbody>
            <tr class="p-2 bg-blue-50 border-b text-xs hover:bg-blue-100">
              <td class="p-2 font-light sm:px-6 sm:py-4 whitespace-nowrap">
                {{ $product->id }}
              </td>
              <td class="p-2 font-light sm:px-6 sm:py-4 whitespace-nowrap">
                {{ $product->name }}
              </td>
              <td class="p-2 font-light sm:px-6 sm:py-4 whitespace-nowrap">
                R$ {{ number_format($product->price , 2, ',', '.') }}
              </td>
              <td class="p-2 font-light sm:px-6 sm:py-4 whitespace-nowrap">
                {{ $product->quantity }}
              </td>
              <td class="p-2 font-light sm:px-6 sm:py-4 whitespace-nowrap">
                {{ $product->user->name }}
              </td>
            </tr>
          </tbody>
        @endforeach
    </table>
  @else
    <p class="bg-white shadow rounded mt-2 p-4 text-xs">Nenhum produto cadastrado no momento!</p>
  @endif
</x-app>