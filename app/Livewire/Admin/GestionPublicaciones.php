<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Publicacion;
use App\Models\CategoriaPublicacion;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

use function Laravel\Prompts\alert;

class GestionPublicaciones extends Component
{
    use WithPagination, WithFileUploads;

    // Propiedades del modelo
    public $titulo, $slug, $resumen, $contenido, $categoria_id,$categoria, $estado, $publicacion_id, $destacado, $label_destacado="Inactivo",$archivo,$archivo_ruta;
    public $video, $audio;
    // Propiedades de la UI
    public $isOpen = false;
    public $search = '';
    
    // Usar el tema de paginación de Bootstrap
    protected $paginationTheme = 'bootstrap';

    #[Layout('components.layouts.admin')]
    public function render()
    {
       
        $publicaciones = Publicacion::with('categoria')
            ->where('titulo', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);
            
        $categorias = CategoriaPublicacion::where('activa', true)->get();

        return view('livewire/admin/gestion-publicaciones', [
            'publicaciones' => $publicaciones,
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
        $this->reset(['titulo', 'slug', 'resumen', 'contenido', 'categoria_id', 'publicacion_id']);
        $this->estado = 'borrador';
        $this->destacado = false;
    }

    public function actualizarTitulo()
    {
        
        //$this->slug = $this->titulo;
        
        $this->slug = Str::slug($this->titulo);
    }

    public function store()
    {
           // Solo requerir archivo al crear
        if (!$this->publicacion_id) {
            $validate_archivo = 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240'; // 10MB Max
        } else {
            $validate_archivo = 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240';
        }

        $this->validate([
            'titulo' => 'required|string|max:200',
            'slug' => 'required|string|max:200|unique:publicaciones,slug,' . $this->publicacion_id,
            'categoria_id' => 'required|exists:categorias_publicacion,id',
            'resumen' => 'nullable|string',
            'contenido' => 'nullable|string',
            'estado' => 'required|in:borrador,publicado,archivado', 
            'destacado' => 'required|boolean',
            'archivo'=>$validate_archivo,
        ]);

        
        

       if ($this->archivo) {
            //$data['archivo_nombre'] = $this->archivo->getClientOriginalName();
            $this->archivo_ruta = $this->archivo->store('upload_publicaciones', 'public');
            //$data['archivo_tamaño'] = $this->archivo->getSize();
            //$data['tipo_mime'] = $this->archivo->getMimeType();
        }

        Publicacion::updateOrCreate(['id' => $this->publicacion_id], [
            'titulo' => $this->titulo,
            'slug' => $this->slug,
            'resumen' => $this->resumen,
            'contenido' => $this->contenido,
            'video' => $this->video,
            'audio' => $this->audio,
            'categoria_id' => $this->categoria_id,
            'imagen_destacada' => $this->archivo_ruta,
            'destacado' => $this->destacado,
            'estado' => $this->estado,
        ]);

        session()->flash('message', 
            $this->publicacion_id ? 'Publicación actualizada exitosamente.' : 'Publicación creada exitosamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        $this->publicacion_id = $id;
        $this->titulo = $publicacion->titulo;
        $this->slug = $publicacion->slug;
        $this->resumen = $publicacion->resumen;
        $this->contenido = $publicacion->contenido;
        $this->categoria_id = $publicacion->categoria_id;
        $this->estado = $publicacion->estado;
        $this->destacado = $publicacion->destacado;

        $this->openModal();
    }

    public function delete($id)
    {
        Publicacion::find($id)->delete();
        session()->flash('message', 'Publicación eliminada exitosamente.');
    }

    public function chage_destacado(){
        $this->label_destacado = 'Inactivo';

        // $this->destacado += !$this->destacado;
         if($this->destacado==true){ 
           
            $this->label_destacado = 'Activo';
            
         }
         else{
            $this->label_destacado = 'Inactivo';
         }
    }
}
