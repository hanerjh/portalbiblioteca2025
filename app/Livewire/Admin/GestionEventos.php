<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Evento;
use App\Models\CategoriaEvento;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class GestionEventos extends Component
{
    use WithPagination, WithFileUploads;

    // Propiedades del modelo
    public $titulo, $slug, $descripcion, $contenido, $categoria_id, $organizador, $archivo,$archivo_ruta;
    public $fecha_inicio, $fecha_fin, $lugar, $modalidad='presencial', $estado='Borrador', $evento_id;

    // Propiedades de la UI
    public $isOpen = false;
    public $search = '';
    protected $paginationTheme = 'bootstrap';

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $eventos = Evento::with('categoria')
            ->where('titulo', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);
            
        $categorias = CategoriaEvento::where('activa', true)->get();

        return view('livewire.admin.gestion-eventos', [
            'eventos' => $eventos,
            'categorias' => $categorias,
        ]);
    }

    // El resto de los métodos (create, store, edit, delete, etc.) son muy similares
    // a los de GestionPublicaciones, solo necesitas ajustar los campos y las reglas de validación.
    // A continuación, un ejemplo del método store:

    public function store()
    {
       
         // Solo requerir archivo al crear
        if (!$this->evento_id) {
            $validate_archivo = 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240'; // 10MB Max
        } else {
            $validate_archivo = 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240';
        }
        
        $this->validate([
            'titulo' => 'required|string|max:200',
            'slug' => 'required|string|unique:eventos,slug,' . $this->evento_id,
            'categoria_id' => 'required|exists:categorias_evento,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'modalidad' => 'required|in:presencial,virtual,hibrido',
            'estado' => 'required|in:Borrador,Publicado,Cancelado,Finalizado',
            'archivo'=>$validate_archivo,
        ]);

        
       if ($this->archivo) {
        
            $this->archivo_ruta = $this->archivo->store('upload_evento', 'public');
            
        }
       
        Evento::updateOrCreate(['id' => $this->evento_id], [
            'titulo' => $this->titulo,
            'slug' => Str::slug($this->titulo),
            'descripcion' => $this->descripcion,
            'contenido' => $this->contenido,
            'categoria_id' => $this->categoria_id,
            'organizador' => $this->organizador,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'modalidad' => $this->modalidad,
            'archivo'=> $this->archivo_ruta,
            'estado' => $this->estado,
        ]);

        session()->flash('message', 'Evento guardado exitosamente.');
        $this->closeModal();
        $this->resetInputFields();
    }
    
    // --- Métodos auxiliares (create, openModal, closeModal, edit, delete, resetInputFields, updatedTitulo) ---
    // --- Debes copiarlos de GestionPublicaciones y adaptarlos a las propiedades de este componente. ---

    public function create() { $this->resetInputFields(); $this->openModal(); }
    public function openModal() { $this->isOpen = true; }
    public function closeModal() { $this->isOpen = false; }

    public function updatedTitulo($value): void { $this->slug = Str::slug($value); }

    private function resetInputFields() { $this->reset(); } // Simplificado, puedes detallarlo
    
    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        $this->evento_id = $id;
        $this->titulo = $evento->titulo;
        $this->slug = $evento->slug;
        $this->descripcion = $evento->descripcion;
        $this->contenido = $evento->contenido;
        $this->categoria_id = $evento->categoria_id;
        $this->organizador = $evento->organizador;
        $this->fecha_inicio = $evento->fecha_inicio ? $evento->fecha_inicio->format('Y-m-d\TH:i') : null;
        $this->fecha_fin = $evento->fecha_fin ? $evento->fecha_fin->format('Y-m-d\TH:i') : null;
        $this->lugar = $evento->lugar;
        $this->modalidad = $evento->modalidad;
        $this->estado = $evento->estado;
        $this->openModal();
    }
    
    public function delete($id)
    {
        Evento::find($id)->delete();
        session()->flash('message', 'Evento eliminado exitosamente.');
    }
}
