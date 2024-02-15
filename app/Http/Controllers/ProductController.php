<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index()
  {
    return view('products.list', ['products' => Product::with('user')->get()]);
  }

  public function create()
  {
    return view('products.create');
  }

  public function store(Request $req)
  {
    $data = $req->validate([
      'name'     => ['required', 'min:2', 'max:100'],
      'price'    => ['required', 'numeric'],
      'quantity' => ['required', 'integer'],
    ]);

    $data['user_id'] = $req->user()->id;
    Product::query()->create($data);

    return back()->with('success', 'Produto cadastrado com sucesso!');
  }
}
