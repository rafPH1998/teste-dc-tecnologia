<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index()
  {
    $products = Product::with('user')->get();

    foreach ($products as $product) {
        // calcula a quantidade total de produtos vendidos para este produto
        $totalSold = Sale::where('product_id', $product->id)->sum('quantity_product');
        
        // subtrai a quantidade vendida da quantidade atual
        $updatedQuantity = max(0, $product->quantity - $totalSold);

        // atualiza a quantidade na tabela de produtos
        $product['quantity'] = $updatedQuantity;
        $product->save();
    }

    return view('products.list', ['products' => $products]);
  }

  public function create()
  {
    return view('products.create');
  }

  public function store(Request $req)
  {
    $data = $req->validate([
      'name'     => ['required', 'min:2', 'max:100', 'unique:products,name'],
      'price'    => ['required', 'numeric'],
      'quantity' => ['required', 'integer'],
    ]);

    $data['user_id'] = $req->user()->id;
    Product::query()->create($data);

    return back()->with('success', 'Produto cadastrado com sucesso!');
  }
}
