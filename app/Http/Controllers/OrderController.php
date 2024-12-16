<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Auth::user()->orders()->create([
            'status' => 0,
        ]);

        foreach ($request->products as $product) {
            $order->orderProducts()->create([
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
            ]);
        }

        return redirect()->route('order-management')->with('success', 'Order created successfully.');
    }
}
