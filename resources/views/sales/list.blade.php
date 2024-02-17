<x-app>
  <h1 class="sm:text-xl font-bold text-gray-600 text-xs">Lista de vendas cadastradas no sistema</h1>

  <div class="flex justify-between mt-8">
    <form action="{{ route('sales.index') }}" method="GET">
      <ul class="flex items-center cursor-pointer text-xs">
          <li class="px-2 text-white font-bold py-1 bg-blue-400 {{ Route::currentRouteName() == 'sales.index' && !request('filter') ? 'bg-blue-600' : '' }}">
              <button type="submit" name="filter" value="">Todos</button>
          </li>
          <li class="px-2 text-white font-bold py-1 bg-blue-400 {{ request('filter') == 'my_sales' ? 'bg-blue-600' : '' }}">
              <button type="submit" name="filter" value="my_sales">Minhas vendas</button>
          </li>
      </ul>
    </form>
  
    <a href="{{route('sales.create')}}" class="rounded bg-gray-500 hover:bg-gray-600 px-2 py-1 text-white text-sm font-bold flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
      </svg>
      Cadastrar uma venda
    </a>
  </div>

  <table class="min-w-full border rounded mt-4 shadow-md"">
    <thead class="bg-blue-500 text-white text-xs">
      <tr>
        <th scope="col" class="p-2 font-medium sm:px-6 sm:py-4 text-left">#</th>
        <th scope="col" class="p-2 font-medium sm:px-6 sm:py-4 text-left">Produto</th>
        <th scope="col" class="p-2 font-medium sm:px-6 sm:py-4 text-left">Quantidade de parcelas</th>
        <th scope="col" class="p-2 font-medium sm:px-6 sm:py-4 text-left">Data das parcelas</th>
        <th scope="col" class="p-2 font-medium sm:px-6 sm:py-4 text-left">Valor produto</th>
        <th scope="col" class="p-2 font-medium sm:px-6 sm:py-4 text-left">Cliente</th>
        <th scope="col" class="p-2 font-medium sm:px-6 sm:py-4 text-left">Quantidade vendida</th>
      </tr>
    </thead>
    @foreach ($sales as $s)
      <tbody>
        <tr class="p-2 bg-blue-50 border-b text-xs hover:bg-blue-100">
          <td class="p-2 font-light sm:px-6 sm:py-4 whitespace-nowrap">
            {{ $s->id }}
          </td>
          <td class="p-2 font-light sm:px-6 sm:py-4 whitespace-nowrap">
            {{ $s->product->name }}
          </td>
          <td class="p-2 font-light sm:px-6 sm:py-4 whitespace-nowrap">
              @php
                  $count = $parcelas->where('product_id', $s->product_id)->count();
              @endphp
              {{ $count }}
          </td>
          <td class="p-2 font-light sm:px-6 sm:py-4 whitespace-nowrap">
              @foreach ($parcelas as $parcela)
                  @if ($s->product_id === $parcela->product_id)
                      <ul>
                          <li>{{ date('d/m/Y', strtotime($parcela->payment_date)) }}</li>
                      </ul>
                  @endif
              @endforeach
          </td>
          <td class="p-2 font-light sm:px-6 sm:py-4 whitespace-nowrap">
            {{ $s->product->price }}
          </td>
          <td class="p-2 font-light sm:px-6 sm:py-4 whitespace-nowrap">
            {{ $s->client->name ?? "Sem cliente cadastrado" }}
          </td>
          <td class="p-2 font-light sm:px-6 sm:py-4 whitespace-nowrap">
            {{ $s->quantity_product }}
          </td>
        </tr>
      </tbody>
    @endforeach
  </table>
</x-app>