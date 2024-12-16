<?php

namespace App\Http\Livewire\Interface\OrderManagement;

use App\Models\Customer;
use Livewire\Component;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderListingInterface extends Component
{
    public $orders;
    public $users;

    public function mount()
    {
        $this->orders = Order::all();
        $this->users = User::all();
    }

    public function render()
    {

        

        return view('livewire.orderManagement.order-management', [
            'user' => Auth()->user(),
            'products' => Product::all(),
            'customers' => Customer::all()
        ]);
    }
}
