<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
  public function index()
  {
    return view('clients.list', ['clients' => User::all()]);
  }

  public function create()
  {
    return view('clients.create');
  }

  public function store(Request $req)
  {
    $data = $req->validate([
      'name'     => 'required|min:2|max:100',
      'email'    => 'required|email|unique:users,email',
      'password' => 'required|min:2|max:50',
    ]);
  
    $data['password'] = bcrypt($req->password);
    
    try {
        User::query()->create($data);
        return back()->with('success', 'Cliente cadastrado com sucesso :)');
    } catch (\Throwable $th) {
        return back()->with('error', 'Ocorreu um erro ao cadastrar o usuário: ' . $th->getMessage());
    }
  }
}
