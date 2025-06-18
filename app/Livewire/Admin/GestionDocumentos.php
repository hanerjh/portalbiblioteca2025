<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Documento;
use App\Models\CategoriaDocumento;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class GestionDocumentos extends Component
{
    use WithPagination, WithFileUploads;

    // Propiedades del modelo
    public $titulo, $descripcion, $categoria_id, $autor, $publico, $documento_id;
    public $archivo; // Para la carga de archivos

    // Propiedades de la UI
    public $isOpen = false;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    
    #[Layout('components.layouts.admin')]
    public function render()
    {
        $documentos = Documento::with('categoria')
            ->where('titulo', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);
        //dd($documentos);
        $categorias = CategoriaDocumento::where('activa', true)->get();

        return view('livewire.admin.gestion-documentos', [
            'documentos' => $documentos,
            'categorias' => $categorias,
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal() { $this->isOpen = true; }
    public function closeModal() { $this->isOpen = false; }

    private function resetInputFields()
    {
        $this->reset();
        $this->publico = true; // Valor por defecto
    }

    public function store()
    {
        $rules = [
            'titulo' => 'required|string|max:200',
            'categoria_id' => 'required|exists:categorias_documento,id',
            'autor' => 'nullable|string|max:100',
            'publico' => 'required|boolean',
            'descripcion' => 'nullable|string',
        ];

        // verificamos si se va a registrar un documento nuevo o se va a realizar una actualización
        if (!$this->documento_id) {
            $rules['archivo'] = 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240'; // 10MB Max
        } else {
            $rules['archivo'] = 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240';
        }

        $this->validate($rules);
        
        $data = [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'categoria_id' => $this->categoria_id,
            'autor' => $this->autor,
            'publico' => $this->publico,
        ];

        if ($this->archivo) {
            $data['archivo_nombre'] = $this->archivo->getClientOriginalName();
            $data['archivo_ruta'] = $this->archivo->store('documentos', 'public');
            $data['archivo_tamaño'] = $this->archivo->getSize();
            $data['tipo_mime'] = $this->archivo->getMimeType();
        }

        Documento::updateOrCreate(['id' => $this->documento_id], $data);

        session()->flash('message', 'Documento guardado exitosamente.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $documento = Documento::findOrFail($id);
        $this->documento_id = $id;
        $this->titulo = $documento->titulo;
        $this->descripcion = $documento->descripcion;
        $this->categoria_id = $documento->categoria_id;
        $this->autor = $documento->autor;
        $this->publico = $documento->publico;
        $this->openModal();
    }

    public function delete($id)
    {
        // Opcional: Eliminar archivo del storage
        // $doc = Documento::find($id);
        // Storage::disk('public')->delete($doc->archivo_ruta);
        Documento::find($id)->delete();
        session()->flash('message', 'Documento eliminado exitosamente.');
    }
}
