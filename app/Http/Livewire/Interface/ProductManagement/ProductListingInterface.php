<?php

namespace App\Http\Livewire\Interface\ProductManagement;

use Livewire\Component;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductListingInterface extends Component
{
    public $products;
    public $users;

    public function mount()
    {
        $this->products = Product::all();
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.productManagement.product-management', [
            'user' => Auth()->user()
        ]);
    }
}
