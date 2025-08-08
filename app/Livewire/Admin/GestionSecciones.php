<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Seccion;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

class GestionSecciones extends Component
{
    use WithPagination;

    // Modelo
    public $nombre, $slug, $contenido, $template, $activa, $seccion_id;

    // UI
    public $isOpen = false;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    #[Layout('components.layouts.admin')]
    public function render()
    {
        $secciones = Seccion::where('nombre', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.gestion-secciones', [
            'secciones' => $secciones,
        ]);
    }

    public function create() { $this->resetInputFields(); $this->openModal(); }
    public function openModal() { $this->isOpen = true; }
    public function closeModal() { $this->isOpen = false; }
    private function resetInputFields() { $this->reset(); $this->activa = true; $this->template = 'default'; }
   

    public function store()
    {
        $this->slug = Str::slug($this->nombre);

        $this->validate([
            'nombre' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:secciones,slug,' . $this->seccion_id,
            'contenido' => 'nullable|string',
            'template' => 'required|string|max:50',
            'activa' => 'required|boolean',
        ]);

        Seccion::updateOrCreate(['id' => $this->seccion_id], [
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'contenido' => $this->contenido,
            'template' => $this->template,
            'activa' => $this->activa,
        ]);

        session()->flash('message', 'Sección guardada exitosamente.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $seccion = Seccion::findOrFail($id);
        $this->seccion_id = $id;
        $this->nombre = $seccion->nombre;
        $this->slug = $seccion->slug;
        $this->contenido = $seccion->contenido;
        $this->template = $seccion->template;
        $this->activa = $seccion->activa;
        $this->openModal();
    }

    public function delete($id)
    {
        Seccion::find($id)->delete();
        session()->flash('message', 'Sección eliminada exitosamente.');
    }
}
