<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;


class Publicacion extends Component
{
    public $title="Titulo alternativo";
    
   ## #[Layout('layouts.admin.layout_admin')]
    public function render()
    {
        return view('livewire.admin.publicacion');
       
    }

    
}
