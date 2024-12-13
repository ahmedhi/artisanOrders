<?php
namespace App\Http\Livewire\Interface\ProductManagement;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductInterface extends Component
{
    public $showSuccesNotification = false;
    public $showFailureNotification = false;

    public $product;
    public $productOwner;
    public $productId;

    protected $rules = [
        'product.name' => 'max:40|min:3',
        'product.description' => 'max:200',
        'product.price' => 'numeric',
        'product.stock_quantity' => 'integer',
        'product.is_service' => 'boolean',
    ];

    public function mount($productId)
    {
        $this->product = $productId ? Product::find($productId) : new Product();
        $this->productOwner = $this->product?->user;

        if (!$this->product) {
            abort(404, 'Product not found');
        }
    }

    public function render()
    {
        return view('livewire.productManagement.product-profile-page');
    }

    public function save()
    {
        if(env('IS_DEMO')) {
            $this->showDemoNotification = true;
        } else {
            $this->validate();
            $this->product->save();
            $this->showSuccesNotification = true;
        }
        session()->flash('message', 'Product saved successfully!');
    }
}
