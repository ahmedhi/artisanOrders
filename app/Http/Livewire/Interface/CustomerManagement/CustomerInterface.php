<?php
namespace App\Http\Livewire\Interface\CustomerManagement;

use Livewire\Component;
use App\Models\Customer;

class CustomerInterface extends Component
{
    public $customer;
    public $orders = [];
    public $showSuccesNotification = false;

    public function mount($customerId)
    {
        $this->customer = $customerId ? Customer::find($customerId) : new Customer();

        if (!$this->customer) {
            abort(404, 'Customer not found');
        }

        $this->orders = $this->customer->orders;
    }

    public function save()
    {
        $this->validate([
            'customer.name' => 'required|string|max:255',
            'customer.family_name' => 'required|string|max:255',
            'customer.phone_number' => 'required|string|max:15|unique:customers,phone_number,' . $this->customer->id,
        ]);

        $this->customer->save();

        $this->showSuccesNotification = true;
    }

    public function render()
    {
        return view('livewire.customerManagement.customer-page', [
            'customer' => $this->customer,
            'orders' => $this->orders,
        ]);
    }
}
