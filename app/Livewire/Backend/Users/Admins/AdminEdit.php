<?php

namespace App\Livewire\Backend\Users\Admins;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminEdit extends Component
{
    public User $user;
    public $name;
    public $email;
    public $current_address;
    public $permanent_address;
    public $university;
    public $phone;
    public $password;
    public $password_confirmation;
    public $selectedRole;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
        $this->name = $this->user->name;
        $this->current_address = $this->user->current_address;
        $this->permanent_address = $this->user->permanent_address;
        $this->university = $this->user->university;
        $this->phone = $this->user->phone;
        $this->email = $this->user->email;
        $this->selectedRole = $this->user->roles->first()?->name;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'current_address' => ['required', 'string', 'max:255'],
            'permanent_address' => ['required', 'string', 'max:255'],
            'university' => ['required', 'string', 'max:255'],
            'phone' => 'required|numeric|digits_between:10,15',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'selectedRole' => ['required', 'string'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'current_address' => $this->current_address,
            'permanent_address' => $this->permanent_address,
            'university' => $this->university,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $this->user->password,
        ]);

        $this->user->syncRoles($this->selectedRole);

        $this->dispatch('toast', 
            message: 'Admin updated successfully!', 
            type: 'success'
        );      
        
    }

    public function render()
    {
        $roles = Role::all();
        return view('livewire.backend.users.admins.admin-edit', compact('roles'));
    }
}