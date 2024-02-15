<x-app>
  <h1 class="sm:text-xl font-bold text-gray-600 text-xs">Cadastre um novo cliente</h1>

  <form method="POST" class="w-full bg-white p-10 mt-2 shadow rounded" action="{{route('clients.store')}}">
      @if(session('success'))
        <span class="font-medium text-green-500">{{ session('success') }}</span> 
      @endif
          
      @csrf
      <div class="flex mt-2">
          <div class=" flex flex-col w-full">
              <label for="complemento" class="text-gray-600 text-sm">Nome</label>
              <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Digite o nome do cliente" class="p-1 w-full border rounded outline-none">
              @if ($errors->has('name'))
                  <p class="text-red-600 text-xs">{{ $errors->first('name') }}</p>
              @endif
          </div>
          <div class="flex flex-col w-full ml-2">
              <label for="bairro" class="text-gray-600 text-sm">E-mail</label>
              <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Digite o e-mail do cliente"
                  class="p-1 w-full border rounded outline-none">
              @if ($errors->has('email'))
                  <p class="text-red-600 text-xs">{{ $errors->first('email') }}</p>
              @endif
          </div>
          <div class="flex flex-col w-full ml-2">
            <label for="bairro" class="text-gray-600 text-sm">Senha</label>
            <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Digite a senha do cliente"
                class="p-1 w-full border rounded outline-none">
            @if ($errors->has('password'))
                <p class="text-red-600 text-xs">{{ $errors->first('password') }}</p>
            @endif
        </div>
      </div>
      <div class="flex flex-row-reverse mt-4">
        <a href="{{route('clients.index')}}" type="submit" class="ml-1 rounded bg-red-500 hover:bg-red-600 px-2 py-1 text-white text-sm font-bold flex items-center">Voltar</a>
        <button type="submit" class="rounded bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white text-sm font-bold flex items-center">Salvar</button>
      </div>
    </div>
  </form>
</x-app>
