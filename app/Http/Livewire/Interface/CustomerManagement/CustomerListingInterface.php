<?php

namespace App\Http\Livewire\Interface\CustomerManagement;

use Livewire\Component;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerListingInterface extends Component
{
    public $customers;

    public function mount()
    {
        $this->customers = Customer::where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.customerManagement.customer-management', [
            'customers' => $this->customers,
        ]);
    }
}
