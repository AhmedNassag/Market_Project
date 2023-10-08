<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use App\Models\Product;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->get();
        return view('admin.transactions.index', compact('transactions'));
    }



    public function store(Request $request)
    {
        $params                = $request->all();
        $transaction           = DB::transaction(function() use ($params) {
            $transactionParams = [
                'name'             => auth()->user()->name,
                'total_price'      => $params['total'],
                'accept'           => $params['accept'],
                'return'           => $params['return'],
                'transaction_code' => $params['transaction_code'],
                // 'transaction_code' => rand(10, 99)."215".rand(1000000,9999999).rand(1000000000, 9999999999),
			];
			$transaction = Transaction::create($transactionParams);
			$carts = Cart::all();
			if ($transaction && $carts)
            {
				foreach ($carts as $cart)
                {
                    $itemBaseTotal   = $cart->quantity * $cart->price;
                    // $product_code = Product::find($cart->product_id);
					$orderItemParams = [
						'transaction_id' => $transaction->id,
						'product_id'     => $cart->product_id,
                        // 'product_code' => $product_code->code,
						'qty'            => $cart->quantity,
                        'name'           => $cart->name,
						'base_price'     => $cart->price,
						'base_total'     => $itemBaseTotal,
					];
					$orderItem = TransactionDetail::create($orderItemParams);
                    if ($orderItem)
                    {
						$product = Product::findOrFail($cart->product_id);
						$product->quantity -= $cart->quantity;
						$product->save();
                    }
                    $cart->delete();
				}
            }
            return $transaction;
        });
		if ($transaction)
        {
			return redirect()->route('admin.transactions.show', $transaction->id)
            ->with
            ([
				'message'    => 'طلب ناجح',
				'alert-type' => 'success'
			]);
		}
    }



    public function show(Transaction $transaction)
    {
        return view('admin.transactions.show', compact('transaction'));
    }



    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->back()
        ->with
        ([
            'message'    => 'حذف ناجح',
            'alert-type' => 'danger'
        ]);
    }



    public function print_struck(Transaction $transaction)
    {
        return view('admin.transactions.nota', compact('transaction'));
    }
}
