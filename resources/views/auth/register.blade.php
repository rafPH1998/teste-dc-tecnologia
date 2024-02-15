<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-200 text-black font-light">
        <div class="w-screen h-screen flex justify-center items-center bg-gray-100 text-black font-light">
          <form method="POST" action="{{ route('register.store') }}" class="p-10 bg-white rounded flex justify-center items-center flex-col shadow-md">
            @csrf
            
            @if(session('success'))
              <div class="text-xs p-2 text-green-800 rounded-lg bg-green-50 w-25" role="alert">
                <span class="font-medium">Successo!</span> 
                {{ session('success') }}
              </div>
            @endif
            <div class="text-center w-full font-bold text-3xl text-gray-600 p-4">
              REGISTRE-SE
            </div>
      
            <div class="flex flex-col gap-4 px-0 py-4">
              <div>
                  <label for="email" class="text-gray-700">Nome</label>
                  <svg xmlns="http://www.w3.org/2000/svg" class="mt-1 font-medium text-2xl text-gray-600 absolute p-2.5 px-3 w-11" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                  </svg>
                  <input placeholder="Digite seu nome" type="text" id="name" name="name" value="{{ old('name') }}"  class="py-2 pl-10 w-full border focus:outline-none">
                  @if ($errors->has('name'))
                      <p class="text-red-600 text-xs">{{ $errors->first('name') }}</p>
                  @endif
              </div>

              <div>
                  <label for="email" class="text-gray-700">E-mail</label>
                  <svg xmlns="http://www.w3.org/2000/svg" class="mt-1 font-medium text-2xl text-gray-600 absolute p-2.5 px-3 w-11" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                  </svg>
                  <input placeholder="Digite seu e-mail" type="email" id="email" name="email" value="{{ old('email') }}"  class="py-2 pl-10 w-full border focus:outline-none">
                  @if ($errors->has('email'))
                      <p class="text-red-600 text-xs">{{ $errors->first('email') }}</p>
                  @endif
              </div>

              <div>
                  <label for="password" class="text-gray-700">Senha:</label>
                  <svg xmlns="http://www.w3.org/2000/svg" class="mt-1 font-medium text-2xl text-gray-600 absolute p-2.5 px-3 w-11" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                  </svg>
                  <input placeholder="Digite sua senha" type="password" id="password" name="password" class="py-2 pl-10 w-full border focus:outline-none">
                  @if ($errors->has('password'))
                      <p class="text-red-600 text-xs">{{ $errors->first('password') }}</p>
                  @endif
              </div>

              <button 
                class="border bg-blue-500 hover:bg-blue-600 duration-100 font-bold ease-in-out w-full text-white p-2 flex flex-row justify-center items-center gap-1"
                type="submit">
                Registrar
              </button>

              <div class="w-full flex flex-row justify-end text-xs text-indigo-500 mt-2">
                <a href="{{route('login')}}">Já possui uma conta ? Faça o login</a>
              </div>
            </div>
          </form>
        </div>
    </body>
</html>
