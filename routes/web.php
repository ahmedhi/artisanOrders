<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Billing;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Tables;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Rtl;

use App\Http\Livewire\Interface\UserManagement\UserProfileInterface;
use App\Http\Livewire\Interface\UserManagement\UserListingInterface;
use App\Http\Livewire\Interface\ProductManagement\ProductListingInterface;
use App\Http\Livewire\Interface\ProductManagement\ProductInterface;
use App\Http\Livewire\Interface\OrderManagement\OrderListingInterface;
use App\Http\Livewire\Interface\OrderManagement\OrderInterface;
use App\Http\Livewire\Interface\CustomerManagement\CustomerListingInterface;
use App\Http\Livewire\Interface\CustomerManagement\CustomerInterface;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return redirect('/login');
});

Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/login', Login::class)->name('login');

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}',ResetPassword::class)->name('reset-password')->middleware('signed');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/billing', Billing::class)->name('billing');
    Route::get('/profilem', Profile::class)->name('profile');
    Route::get('/tables', Tables::class)->name('tables');
    Route::get('/static-sign-in', StaticSignIn::class)->name('sign-in');
    Route::get('/static-sign-up', StaticSignUp::class)->name('static-sign-up');
    Route::get('/rtl', Rtl::class)->name('rtl');


    Route::get('/users', UserListingInterface::class)->name('user-management');
    Route::get('/profile/{user?}', UserProfileInterface::class)->name('user-profile');

    // Products
    Route::get('/products', ProductListingInterface::class)->name('product-management');
    Route::get('/product/{productId}', ProductInterface::class)->name('product-view');
    Route::post('/products', [ProductController::class, 'store'])->name('product.create');

    // Orders
    Route::get('/orders', OrderListingInterface::class)->name('order-management');
    Route::get('/order/{orderId}', OrderInterface::class)->name('order-view');
    Route::post('/orders', [OrderController::class, 'store'])->name('order.create');

    // Customer
    Route::get('/customers', CustomerListingInterface::class)->name('customer-management');
    Route::get('/customer/{customerId}', CustomerInterface::class)->name('customer-view');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customer.create');

});

