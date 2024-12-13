<div class="main-content">
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white"><strong>Add, Edit, Delete features are not functional!</strong> This is a
            <strong>PRO</strong> feature!
            Click <strong><a href="https://www.creative-tim.com/live/soft-ui-dashboard-pro-laravel" target="_blank"
                    class="text-white">here</a></strong>
            to see the PRO
            product!</span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Products</h5>
                        </div>
                        <button class="btn bg-gradient-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#newProductModal">+&nbsp; New Product</button>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Price (MAD)
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Stock Quantity
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Is Service
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Product Owner
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($products->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">The product list is empty.</td>
                                    </tr>
                                @else
                                    @foreach($products as $product)
                                        <tr>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <a href="{{ route('product-view', ['productId' => $product->id]) }}"
                                                        class="mx-3" data-bs-toggle="tooltip"
                                                        data-bs-original-title="View product">
                                                        {{ $product->name }}
                                                    </a>
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $product->price }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $product->stock_quantity }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $product->is_service ? 'Yes' : 'No' }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <a href="{{ route('user-profile', ['user' => $product->user->id]) }}"
                                                        class="mx-3" data-bs-toggle="tooltip"
                                                        data-bs-original-title="View user profile">
                                                        {{ $product->user->name}}
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

<!-- New Product Modal -->
<div class="modal fade @if($errors->any()) show @endif" id="newProductModal" tabindex="-1" aria-labelledby="newProductModalLabel" aria-hidden="true" @if($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newProductModalLabel">New Product</h5>
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
                <form action="{{ route('product.create') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock_quantity" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control"
                        id="stock_quantity" name="stock_quantity"
                        value="{{ old('stock_quantity', 0) }}">
                    </div>
                    <div class="mb-3">
                        <label for="is_service" class="form-label">Is Service</label>
                        <select class="form-control" id="is_service" name="is_service" required>
                            <option value="0" {{ old('is_service') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_service') == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="is_active" class="form-label">Is Active</label>
                        <select class="form-control" id="is_active" name="is_active" required>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productOwner" class="form-label">Product Owner</label>
                        <input type="text" class="form-control" id="productOwner" name="productOwner" value="{{ $user->name }}" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('newProductModal'));
            myModal.show();
        });
    </script>
@endif
