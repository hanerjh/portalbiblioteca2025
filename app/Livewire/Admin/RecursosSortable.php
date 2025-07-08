<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\RecursoDigital;
use Livewire\Attributes\Layout;

class RecursosSortable extends Component
{
    public $recursos = [];

    protected $listeners = [
    'actualizarOrden' => 'actualizarOrden',
];

    

    public function mount()
    {
        $this->recursos = RecursoDigital::orderBy('orden_visualizacion')->get()->toArray();
        
    }

     #[Layout('components.layouts.admin')]
    public function render()
    {
        
        return view('livewire.admin.recursos-sortable');
        
    }

    
    public function actualizarOrden($nuevaLista)
     {
        //logger('Debug message');
        //dd($nuevaLista);
        foreach ($nuevaLista as $index => $id) {
            RecursoDigital::where('id', $id)->update(['orden_visualizacion' => $index + 1]);
        }

        $this->recursos = RecursoDigital::orderBy('orden_visualizacion')->get()->toArray();
        session()->flash('message', 'Orden actualizado correctamente.');
    }
   
}

