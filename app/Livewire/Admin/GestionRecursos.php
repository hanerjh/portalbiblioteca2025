<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\RecursoDigital;
use App\Models\CategoriaRecurso;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class GestionRecursos extends Component
{
    use WithPagination;

    // Propiedades del modelo
    public $titulo, $descripcion, $url, $categoria_id, $proveedor, $tipo_acceso, $recurso_id;

    // Propiedades de la UI
    public $isOpen = false;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    #[Layout('components.layouts.admin')]
    public function render()
    {
        $recursos = RecursoDigital::with('categoria')
            ->where('titulo', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);
            
        $categorias = CategoriaRecurso::where('activa', true)->get();

        return view('livewire.admin.gestion-recursos', [
            'recursos' => $recursos,
            'categorias' => $categorias,
        ]);
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
        $this->reset();
        $this->tipo_acceso = 'libre'; // Valor por defecto
    }

    public function store()
    {
        $this->validate([
            'titulo' => 'required|string|max:200',
            'categoria_id' => 'required|exists:categorias_recurso,id',
            'tipo_acceso' => 'required|in:libre,restringido,suscripcion',
            'url' => 'nullable|url',
            'proveedor' => 'nullable|string|max:150',
            'descripcion' => 'nullable|string',
        ]);

        RecursoDigital::updateOrCreate(['id' => $this->recurso_id], [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'url' => $this->url,
            'categoria_id' => $this->categoria_id,
            'proveedor' => $this->proveedor,
            'tipo_acceso' => $this->tipo_acceso,
        ]);

        session()->flash('message', 'Recurso digital guardado exitosamente.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $recurso = RecursoDigital::findOrFail($id);
        $this->recurso_id = $id;
        $this->titulo = $recurso->titulo;
        $this->descripcion = $recurso->descripcion;
        $this->url = $recurso->url;
        $this->categoria_id = $recurso->categoria_id;
        $this->proveedor = $recurso->proveedor;
        $this->tipo_acceso = $recurso->tipo_acceso;
        $this->openModal();
    }

    public function delete($id)
    {
        RecursoDigital::find($id)->delete();
        session()->flash('message', 'Recurso digital eliminado exitosamente.');
    }
}
