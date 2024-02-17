<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesController extends Controller
{
  public function index(Request $request)
  {
    $query = Sale::with(['product', 'client']);

    if ($request->has('filter') && $request->input('filter') == 'my_sales') {
        $query->where('client_id', auth()->user()->id);
    }

    $sales = $query->get();
    
    return view('sales.list', [
        'sales' => $sales,
        'parcelas' => Transaction::get()
    ]);
  }
  

  public function create()
  {
    $clients = User::select('id', 'name')->get();
    $products = Product::select('id', 'name', 'price', 'quantity')->get();

    return view('sales.create', [
      'clients'  => $clients,
      'products' => $products,
    ]);
  }

  public function store(Request $req)
  {
    $req->validate([
      'client_id' => ['nullable', 'exists:clients,id'],
    ]);

    $details = [
      'parcelas' => $req->valorParcela,
      'datas_pagamentos' => $req->dataPagamento
    ];

    $resValorEDataPagamento = [];

    for ($i = 0; $i < count($details['parcelas']); $i++) {
        $resValorEDataPagamento[] = [
            'valor'          => $details['parcelas'][$i],
            'data_pagamento' => $details['datas_pagamentos'][$i]
        ];
    }

    $resProduct = [];

    foreach ($req->produtos as $produto) {
        $id = $produto['id'];

        if (Transaction::whereIn('product_id', [$id])->get()->isNotEmpty()) {
          return response()->json(['error' => true], 422);
        }
    

        if (!isset($resProduct[$id]) || $resProduct[$id]['quantity'] < $produto['quantity']) {
            $resProduct[$id] = $produto;
            $resProduct[$id]['client_id'] = $req->clienteId;
        }
    }

    $resProductFinal = array_values($resProduct);
    foreach ($resProductFinal as $res) {

      foreach ($resValorEDataPagamento as $item) {
        $paymentDate = Carbon::createFromFormat('Y-m-d', $item['data_pagamento']);

        Transaction::query()->create([
          'purchase_value' => $item['valor'],
          'payment_date'   => $paymentDate,
          'product_id'     => $res['id'],
        ]);
      }
      
      Sale::query()->create([
        'client_id'        => $res['client_id'] !== null ? (int)$res['client_id'] : null,
        'product_id'       => $res['id'],
        'quantity_product' => $res['quantity'],
      ]);
    }
    return response()->json(['ok' => "Venda realizada com sucesso! :)"]);
  }
}
