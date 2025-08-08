<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Layouts;
use Livewire\Attributes\Layout;


class CreateLayout extends Component
{
   
    public $name;
    public $viewPath;

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'viewPath' => 'required|unique:layouts,view_path',
        ]);

        Layouts::create([
            'name' => $this->name,
            'view_path' => $this->viewPath,
        ]);

        session()->flash('success', 'Layout creado correctamente');
        $this->reset();
    }
    #[Layout('components.layouts.admin')]
       public function render()
    {
        return view('livewire.admin.create-layout');
    }
}
