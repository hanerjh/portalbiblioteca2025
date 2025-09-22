<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;


class GestionUsuarios extends Component
{

    use WithPagination;

    // Propiedades del formulario
    public $name, $email, $password, $password_confirmation;
    public $userId;

    // Banderas y configuración
    public $isOpen = 0;
    public $search = '';

    protected $paginationTheme = 'bootstrap';
    #[Layout('components.layouts.admin')]
    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);
  
        return view('livewire.admin.gestion-usuarios', ['users' => $users]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->userId = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::updateOrCreate(['id' => $this->userId], [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', $this->userId ? 'Usuario actualizado correctamente.' : 'Usuario creado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }
    
    public function update()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
        ];

        // Solo validar la contraseña si se ha ingresado una nueva
        if (!empty($this->password)) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }
        
        $this->validate($rules);
        
        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];
        
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        User::find($this->userId)->update($data);

        session()->flash('message', 'Usuario actualizado correctamente.');
        $this->closeModal();
        $this->resetInputFields();
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = ''; // No cargar el hash de la contraseña
        $this->password_confirmation = '';

        $this->openModal();
    }

    public function delete($id)
    {
        // Evitar que el administrador se elimine a sí mismo
        /*if ($id == auth()->id()) {
            session()->flash('error', 'No puedes eliminar tu propia cuenta.');
            return;
        }*/

        User::find($id)->delete();
        session()->flash('message', 'Usuario eliminado correctamente.');
    }
   
}
