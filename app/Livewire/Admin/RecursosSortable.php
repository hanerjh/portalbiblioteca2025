<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\RecursoDigital;
use Livewire\Attributes\Layout;

class RecursosSortable extends Component
{
    public $recursos = [];
    

    public function mount()
    {
        $this->recursos = RecursoDigital::orderBy('orden_visualizacion')->get()->toArray();
        
    }

    public function actualizarOrden($nuevaLista)
    {
        foreach ($nuevaLista as $index => $id) {
            RecursoDigital::where('id', $id)->update(['orden' => $index + 1]);
        }

        $this->recursos = RecursoDigital::orderBy('orden')->get()->toArray();
        session()->flash('message', 'Orden actualizado correctamente.');
    }
    #[Layout('components.layouts.admin')]
    public function render()
    {
        
        return view('livewire.admin.recursos-sortable');
        
    }
}

