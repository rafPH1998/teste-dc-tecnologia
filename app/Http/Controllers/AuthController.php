<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function login()
  {
    return view('auth.login');
  }

  public function authenticate(Request $req): RedirectResponse
  {
      $credentials = $req->validate([
          'email' => ['required', 'email'],
          'password' => ['required'],
      ]);

      if (!Auth::attempt($credentials)) {
        return redirect()->route('login')->with('error', 'E-mail e/ou senha inválidos');
      }

      return redirect()->route('products.index');

  }

  public function register()
  {
    return view('auth.register');
  }

  public function registerStore(Request $req)
  {
    $data = $req->validate([
        'name'     => 'required|min:2|max:100',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:2|max:50',
    ]);
    $data['password'] = bcrypt($req->password);
    
    try {
        User::query()->create($data);
        return back()->with('success', 'Usuário cadastrado com sucesso! Faça o login');
    } catch (\Throwable $th) {
        return back()->with('error', 'Ocorreu um erro ao cadastrar o usuário: ' . $th->getMessage());
    }
  }

  public function logout(Request $request)
  {
      Auth::guard('web')->logout(); 

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect()->route('login');
  }

  
}
