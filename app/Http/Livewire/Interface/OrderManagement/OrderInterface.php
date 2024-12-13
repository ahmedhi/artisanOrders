<?php
namespace App\Http\Livewire\Interface\OrderManagement;

use Livewire\Component;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;

class OrderInterface extends Component
{
    public $order;
    public $orderProducts = [];
    public $products;
    public $showSuccesNotification = false;

    public function mount($orderId)
    {
        $this->order = $orderId ? Order::find($orderId) : new Order();

        if (!$this->order) {
            abort(404, 'Order not found');
        }

        $this->products = Product::all();
        $this->orderProducts = $this->order->orderProducts->map(function ($orderProduct) {
            return [
                'product_id' => $orderProduct->product_id,
                'quantity' => $orderProduct->quantity,
            ];
        })->toArray();
    }

    public function addProduct()
    {
        $this->orderProducts[] = ['product_id' => '', 'quantity' => 1];
    }

    public function save()
    {
        $this->validate([
            'order.status' => 'required|integer|in:0,1,2,3,4',
            'orderProducts.*.product_id' => 'required|exists:products,id',
            'orderProducts.*.quantity' => 'required|integer|min:1',
        ]);

        $this->order->save();

        // Sync order products
        $this->order->orderProducts()->delete();
        foreach ($this->orderProducts as $orderProduct) {
            $this->order->orderProducts()->create($orderProduct);
        }

        $this->showSuccesNotification = true;
    }

    public function render()
    {
        return view('livewire.orderManagement.order-page');
    }
}
