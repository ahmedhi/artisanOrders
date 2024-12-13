<div>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('../assets/img/curved-images/curved6.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../assets/img/defaultImage/customer.png" alt="..." class="w-100 border-radius-lg shadow-sm">
                        {{--
                        <a href="javascript:;"
                            class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Edit Image"></i>
                        </a>
                        --}}
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $customer->fullName }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            Phone: {{ $customer->phone_number }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Orders</h5>
            </div>
            <div class="card-body">
                <ul>
                    @foreach($orders as $order)
                        <li>{{ $order->name() }} - {{ $order->getOrderAmountAttribute() }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
