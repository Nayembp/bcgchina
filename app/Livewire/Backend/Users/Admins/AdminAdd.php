<?php

namespace App\Livewire\Backend\Users\Admins;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminAdd extends Component
{
    public $name;
    public $phone;
    public $current_address;
    public $permanent_address;
    public $university;
    public $email;
    public $password;
    public $password_confirmation;
    public $selectedRole;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'current_address' => ['required', 'string', 'max:255'],
            'permanent_address' => ['required', 'string', 'max:255'],
            'university' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'selectedRole' => ['required', 'string'],
        ];
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'current_address' => $this->current_address,
            'permanent_address' => $this->permanent_address,
            'university' => $this->university,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole($this->selectedRole);

        $this->dispatch('toast', 
            message: 'Admin created successfully!', 
            type: 'success'
        );        
        
        $this->reset(['name', 'email', 'password', 'password_confirmation', 'selectedRole']);
        return $this->redirect(route('admin.index'), navigate: true);
    }
    

    public function render()
    {
        $roles = Role::all();
        return view('livewire.backend.users.admins.admin-add', compact('roles'));
    }
}