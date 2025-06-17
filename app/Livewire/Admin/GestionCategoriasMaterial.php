<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\CategoriaMaterialApoyo;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class GestionCategoriasMaterial extends Component
{
    use WithPagination;

    // Propiedades
    public $nombre, $descripcion, $icono, $activa, $categoria_id;
    public $isOpen = false;
    public $search = '';
    protected $paginationTheme = 'bootstrap';

     #[Layout('components.layouts.admin')]
    public function render()
    {
        $categorias = CategoriaMaterialApoyo::where('nombre', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(10);

        return view('livewire.admin.gestion-categorias-material', compact('categorias'));
    }

    public function create() { $this->resetInputFields(); $this->openModal(); }
    public function openModal() { $this->isOpen = true; }
    public function closeModal() { $this->isOpen = false; }
    private function resetInputFields() { $this->reset(); $this->activa = true; }
    
    public function store()
    {
        $this->validate([
            'nombre' => 'required|string|max:100',
            'activa' => 'required|boolean',
        ]);

        CategoriaMaterialApoyo::updateOrCreate(['id' => $this->categoria_id], [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'icono' => $this->icono,
            'activa' => $this->activa,
        ]);

        session()->flash('message', $this->categoria_id ? 'Categoría actualizada.' : 'Categoría creada.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $categoria = CategoriaMaterialApoyo::findOrFail($id);
        $this->categoria_id = $id;
        $this->nombre = $categoria->nombre;
        $this->descripcion = $categoria->descripcion;
        $this->icono = $categoria->icono;
        $this->activa = $categoria->activa;
        $this->openModal();
    }

    public function delete($id)
    {
        CategoriaMaterialApoyo::find($id)->delete();
        session()->flash('message', 'Categoría eliminada.');
    }
}
