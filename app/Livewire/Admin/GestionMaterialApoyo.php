<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\MaterialApoyo;
use App\Models\CategoriaMaterialApoyo;
use App\Models\RecursoDigital;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class GestionMaterialApoyo extends Component
{
    use WithPagination, WithFileUploads;

    // Propiedades del modelo
    public $titulo, $descripcion, $tipo, $categoria_id, $url_recurso, $estado, $material_id,$recurso_id,$archivo_ruta;
    public $validarcampo='', $archivo;

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
             
            if($this->validarcampo==1){
                
                $validate_archivo = 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240'; // 10MB Max
            }
            else{
                 $validate_archivo ='required|string|max:500';
            }
        } else {

              if($this->validarcampo==1){
                
                $validate_archivo = 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240';
              }
            else{
                 $validate_archivo ='nullable|string|max:500';
            }
           
        }

        

        $this->validate([
            'titulo' => 'required|string|max:200',
            'tipo' => 'required|in:videotutorial,manual,guia,infografia,documento',
            'categoria_id' => 'required|exists:categorias_material_apoyo,id',           
            'url_recurso' => $validate_archivo,
            'estado' => 'required|in:borrador,publicado,archivado',
            
        ]);

        
       if ($this->archivo) {
            //$data['archivo_nombre'] = $this->archivo->getClientOriginalName();
            $this->url_recurso = $this->archivo->store('documentos', 'public');
            //$data['archivo_tamaño'] = $this->archivo->getSize();
            //$data['tipo_mime'] = $this->archivo->getMimeType();
        }

        $result_ma=MaterialApoyo::updateOrCreate(['id' => $this->material_id], [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'tipo' => $this->tipo,
            'categoria_id' => $this->categoria_id,
            'recurso_id' => $this->recurso_id,
            'url_recurso' => $this->url_recurso,
            'estado' => $this->estado,
        ]);

         // Sincronizar relaciones muchos a muchos
         //$result_ma->recursosDigitales()->sync($this->recurso_id);
      
  

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



       // $material->recursosDigitales()->sync($this->recurso_id);
    }

    public function delete($id)
    {
        MaterialApoyo::find($id)->delete();
        session()->flash('message', 'Material de apoyo eliminado.');
    }
}
