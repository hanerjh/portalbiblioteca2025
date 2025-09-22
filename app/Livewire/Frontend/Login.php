<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.loginlayout')]
#[Title('Iniciar Sesión')]
class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            request()->session()->regenerate();
            
            return $this->redirect(route('publicaciones.index'), navigate: true);
        }

        $this->addError('email', 'Las credenciales proporcionadas no coinciden con nuestros registros.');
    }
    
    public function render()
    {
        return view('livewire.frontend.login');
    }
    
}
