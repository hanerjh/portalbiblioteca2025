<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\MaterialApoyo;
use App\Models\CategoriaMaterialApoyo;
use App\Models\RecursoDigital;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class GestionMaterialApoyo extends Component
{
    use WithPagination;

    // Propiedades del modelo
    public $titulo, $descripcion, $tipo, $categoria_id, $url_recurso, $estado, $material_id,$recurso_id,$archivo_ruta;
    public $validarcampo=1;

    // UI
    public $isOpen = false;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    #[Layout('components.layouts.admin')]
    public function render()
    {
        $materiales = MaterialApoyo::with('categoria')
            ->where('titulo', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        $recursoDigital= RecursoDigital::where('activo',true)->get();
            
        $categorias = CategoriaMaterialApoyo::where('activa', true)->get();

        return view('livewire.admin.gestion-material-apoyo', [
            'materiales' => $materiales,
            'categorias' => $categorias,
            'recursodigital'=>$recursoDigital,
        ]);
    }

    public function create() { $this->resetInputFields(); $this->openModal(); }
    public function openModal() { $this->isOpen = true; }
    public function closeModal() { $this->isOpen = false; }
    private function resetInputFields() { $this->reset(); $this->estado = 'borrador'; $this->tipo = 'videotutorial'; }

    public function store()
    {
           // Solo requerir archivo al crear
        if (!$this->material_id) {
            $validate_archivo = 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240'; // 10MB Max
        } else {
            $validate_archivo = 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240';
        }

        $this->validate([
            'titulo' => 'required|string|max:200',
            'tipo' => 'required|in:videotutorial,manual,guia,infografia,documento',
            'categoria_id' => 'required|exists:categorias_material_apoyo,id',
            'url_recurso' => 'required|string|max:500',
            'estado' => 'required|in:borrador,publicado,archivado',
            'archivo'=>$validate_archivo,
        ]);

        
       if ($this->archivo) {
            //$data['archivo_nombre'] = $this->archivo->getClientOriginalName();
            $this->url_recurso = $this->archivo->store('documentos', 'public');
            //$data['archivo_tamaño'] = $this->archivo->getSize();
            //$data['tipo_mime'] = $this->archivo->getMimeType();
        }

        MaterialApoyo::updateOrCreate(['id' => $this->material_id], [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'tipo' => $this->tipo,
            'categoria_id' => $this->categoria_id,
            'url_recurso' => $this->url_recurso,
            'estado' => $this->estado,
        ]);

        session()->flash('message', 'Material de apoyo guardado.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $material = MaterialApoyo::findOrFail($id);
        $this->material_id = $id;
        $this->titulo = $material->titulo;
        $this->descripcion = $material->descripcion;
        $this->tipo = $material->tipo;
        $this->categoria_id = $material->categoria_id;
        $this->url_recurso = $material->url_recurso;
        $this->estado = $material->estado;
        $this->openModal();
    }

    public function delete($id)
    {
        MaterialApoyo::find($id)->delete();
        session()->flash('message', 'Material de apoyo eliminado.');
    }
}
