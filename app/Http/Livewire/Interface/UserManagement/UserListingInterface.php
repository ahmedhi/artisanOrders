<?php

namespace App\Http\Livewire\Interface\UserManagement;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class UserListingInterface extends Component
{
    public function render()
    {
        $users = User::all();
        return view('livewire.laravel-examples.user-management', [
            'users' => $users
        ]);
    }
}
