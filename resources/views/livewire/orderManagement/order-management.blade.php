<div>
    <div class="main-content">
        <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white"><strong>Add, Edit, Delete features are not functional!</strong> This is a
                <strong>PRO</strong> feature!
                Click <strong><a href="https://www.creative-tim.com/live/soft-ui-dashboard-pro-laravel" target="_blank"
                        class="text-white">here</a></strong>
                to see the PRO
                order!</span>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Orders</h5>
                            </div>
                            <button class="btn bg-gradient-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#newOrderModal">+&nbsp; New Order</button>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Order ref
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Customer
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Amount
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Create Date
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Status
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Create By
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orders->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center">The order list is empty.</td>
                                        </tr>
                                    @else
                                        @foreach($orders as $order)
                                            <tr>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        <a href="{{ route('order-view', ['orderId' => $order->id]) }}"
                                                            class="mx-3" data-bs-toggle="tooltip"
                                                            data-bs-original-title="View order">
                                                            {{ $order->name() }}
                                                        </a>
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        @if($order->customer)
                                                        <a href="{{ route('customer-view', ['customerId' => $order->customer->id]) }}"
                                                            class="mx-3" data-bs-toggle="tooltip"
                                                            data-bs-original-title="View customer">
                                                            {{ $order->customer->getFullNameAttribute() }}
                                                        </a>
                                                        @else
                                                        Not set
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $order->getOrderAmountAttribute() }} MAD
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $order->created_at->format('d M Y') }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $order->getStatus() }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        <a href="{{ route('user-profile', ['user' => $order->user->id]) }}"
                                                            class="mx-3" data-bs-toggle="tooltip"
                                                            data-bs-original-title="View user">
                                                            {{ $order->user->name }}
                                                        </a>
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Order Modal -->
    <div class="modal fade @if($errors->any()) show @endif" id="newOrderModal" tabindex="-1" aria-labelledby="newOrderModalLabel" aria-hidden="true" @if($errors->any()) style="display: block;" @endif>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newOrderModalLabel">New Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('order.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="customer" class="form-label">Customer</label>
                            <select class="form-control" id="customer" name="customer_id" required>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->getFullNameAttribute() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="products-container">
                            <div class="product-item mb-3">
                                <label for="product" class="form-label">Product</label>
                                <select class="form-control" id="product" name="products[0][product_id]" required>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ old('products.0.product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }} - ${{ $product->price }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="quantity" class="form-label mt-2">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="products[0][quantity]" value="{{ old('products.0.quantity', 1) }}" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary mb-3" id="add-product">Add Another Product</button>
                        <button type="submit" class="btn btn-primary">Create Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var myModal = new bootstrap.Modal(document.getElementById('newOrderModal'));
                myModal.show();
            });
        </script>
    @endif


    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            var container = document.getElementById('products-container');
            var index = container.children.length;
            var productItem = document.createElement('div');
            productItem.className = 'product-item mb-3';
            productItem.innerHTML = `
                <label for="product" class="form-label">Product</label>
                <select class="form-control" id="product" name="products[${index}][product_id]" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                    @endforeach
                </select>
                <label for="quantity" class="form-label mt-2">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="products[${index}][quantity]" value="1" required>
            `;
            container.appendChild(productItem);
        });
    </script>

</div>
