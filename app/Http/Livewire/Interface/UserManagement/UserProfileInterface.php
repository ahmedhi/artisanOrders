<?php

namespace App\Http\Livewire\Interface\UserManagement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfileInterface extends Component
{
    public User $user;
    public $isSuperAdminViewing = false;
    public $showSuccesNotification  = false;
    public $showDemoNotification = false;

    protected $rules = [
        'user.name' => 'max:40|min:3',
        'user.email' => 'email:rfc,dns',
        'user.phone' => 'max:10',
        'user.about' => 'max:200',
        'user.location' => 'min:3'
    ];

    public function mount($userId = null)
    {
        $this->userId = $userId;
        $this->user = Auth::user();
        $this->isSuperAdminViewing = false;

        if ($this->userId) {
            // Récupérer les informations de l'utilisateur
            $this->user = User::find($this->userId);

            if (!$this->user) {
                abort(404, 'User not found'); // Gérer le cas où l'utilisateur n'existe pas
            }
        }
    }

    public function save() {
        if(env('IS_DEMO')) {
           $this->showDemoNotification = true;
        } else {
            $this->validate();
            $this->user->save();
            $this->showSuccesNotification = true;
        }
    }
    public function render()
    {
        return view('livewire.laravel-examples.user-profile', [
            'user' => $this->user,
            'isSuperAdminViewing' => $this->isSuperAdminViewing
        ]);
    }
}
