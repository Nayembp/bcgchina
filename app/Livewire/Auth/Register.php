<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public $image;
    public string $phone = '';
    public string $current_address = '';
    public string $permanent_address = '';
    public string $university = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'image' => ['nullable', 'image', 'max:2048'],
            'phone' => ['nullable', 'string', 'max:20'],
            'current_address' => ['nullable', 'string', 'max:255'],
            'permanent_address' => ['nullable', 'string', 'max:255'],
            'university' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);


        if ($this->image) {
            $imagePath = $this->image->store('user-profile', 'public');
            $validated['image'] = $imagePath;
        } else {
            $validated['image'] = 'profile.png';
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['status'] = 'inactive';

        event(new Registered(($user = User::create($validated))));
       
        $role = Role::where('name', 'user')->first(); 
        $user->assignRole($role);
        // Auth::login($user);

        $this->redirect(route('login', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}