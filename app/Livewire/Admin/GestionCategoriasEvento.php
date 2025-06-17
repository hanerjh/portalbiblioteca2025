<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\CategoriaEvento;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class GestionCategoriasEvento extends Component
{
    use WithPagination;

    // Propiedades
    public $nombre, $slug, $descripcion, $color, $icono, $activa, $categoria_id;
    public $isOpen = false;
    public $search = '';
    protected $paginationTheme = 'bootstrap';

     #[Layout('components.layouts.admin')]
    public function render()
    {
        $categorias = CategoriaEvento::where('nombre', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(10);

        return view('livewire.admin.gestion-categorias-evento', compact('categorias'));
    }

    public function create() { $this->resetInputFields(); $this->openModal(); }
    public function openModal() { $this->isOpen = true; }
    public function closeModal() { $this->isOpen = false; }
    private function resetInputFields() { $this->reset(); $this->activa = true; $this->color = '#28a745'; }
    public function updatedNombre($value) { $this->slug = Str::slug($value); }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:categorias_evento,slug,' . $this->categoria_id,
            'color' => 'required|string|max:7',
            'activa' => 'required|boolean',
        ]);

        CategoriaEvento::updateOrCreate(['id' => $this->categoria_id], [
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'descripcion' => $this->descripcion,
            'color' => $this->color,
            'icono' => $this->icono,
            'activa' => $this->activa,
        ]);

        session()->flash('message', $this->categoria_id ? 'Categoría actualizada.' : 'Categoría creada.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $categoria = CategoriaEvento::findOrFail($id);
        $this->categoria_id = $id;
        $this->nombre = $categoria->nombre;
        $this->slug = $categoria->slug;
        $this->descripcion = $categoria->descripcion;
        $this->color = $categoria->color;
        $this->icono = $categoria->icono;
        $this->activa = $categoria->activa;
        $this->openModal();
    }

    public function delete($id)
    {
        CategoriaEvento::find($id)->delete();
        session()->flash('message', 'Categoría eliminada.');
    }
}
