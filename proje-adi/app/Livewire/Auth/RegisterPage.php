<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Hash; // Hash sınıfını ekleyin


#[Title('Register')]
class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;

    // Kullanıcı kaydını işle
    public function save() {
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|max:255'
        ]);

        // Kullanıcıyı veritabanına kaydet
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password), // Hash sınıfını kullanarak şifreyi hash'le
        ]);

        // Kullanıcı oturumunu başlat
        auth()->login($user);

        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
