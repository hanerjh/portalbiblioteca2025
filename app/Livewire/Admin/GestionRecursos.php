<?php

namespace App\Livewire\Admin;

use App\Models\AreaConocimiento;
use Livewire\Component;
use App\Models\RecursoDigital;
use App\Models\CategoriaRecurso;
use App\Models\ProgramaAcademico;
use App\Models\TipoUsuario;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class GestionRecursos extends Component
{
    use WithPagination, WithFileUploads;

    // Propiedades del modelo
    public $titulo, $descripcion, $url, $categoria_id, $proveedor, $tipo_acceso, $recurso_id,$archivo_ruta, $archivo, $activo, $destacado;
    public array $tipo_usuario_form = [];
    public array $area_conocimiento_form = [];
    public array $programa_form = [];
   
    // Propiedades de la UI
    public $isOpen = false;
    public $search = '';
    protected $paginationTheme = 'bootstrap';

    #[On('tiposActualizados')]
    public function tiposActualizados(array $seleccionados)
    {
        $this->tipo_usuario_form = $seleccionados;
    }

    #[On('areasActualizadas')]
    public function areasActualizadas(array $seleccionados)
    {
        $this->area_conocimiento_form = $seleccionados;
    }

    #[On('programaActualizadas')]
    public function programaActualizadas(array $seleccionados)
    {
        $this->programa_form = $seleccionados;
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $recursos = RecursoDigital::with('categoria')
            ->where('titulo', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);
            
        $categorias = CategoriaRecurso::where('activa', true)->get();
        $tipo_usuario = TipoUsuario::where('activo', true)->get();
        $area_conocimiento = AreaConocimiento::where('activa', true)->get();
        $programaAcademicos = ProgramaAcademico::where('activo', true)->get();
       
        return view('livewire.admin.gestion-recursos', [
            'recursos' => $recursos,
            'categorias' => $categorias,
            'tipoUsuarios' => $tipo_usuario,
            'area' => $area_conocimiento,
            'programa' => $programaAcademicos,
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
        // Disparar evento después de un pequeño delay para asegurar que el modal esté renderizado
        $this->js('setTimeout(() => { window.dispatchEvent(new CustomEvent("limpiar-selects")); }, 100);');
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
        // Limpiar selects al cerrar
        $this->js('setTimeout(() => { window.dispatchEvent(new CustomEvent("limpiar-selects")); }, 100);');
    }

    private function resetInputFields()
    {
        $this->reset([
            'titulo', 'descripcion', 'url', 'categoria_id', 
            'proveedor', 'recurso_id', 'tipo_usuario_form', 
            'area_conocimiento_form', 'programa_form','activo','destacado'
        ]);
        $this->tipo_acceso = 'Acceso abierto'; // Valor por defecto
       
         
    }

    public function store()
    {
             // Solo requerir archivo al crear
        if (!$this->recurso_id) {
            $validate_archivo = 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240'; // 10MB Max
            //dd($validate_archivo);
        } else {
            $validate_archivo = 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240';
             //dd($validate_archivo);
        }


        $this->validate([
            'titulo' => 'required|string|max:200',
            'categoria_id' => 'required|exists:categorias_recurso,id',
            'tipo_acceso' => 'required|in:Acceso abierto,restringido,suscripcion',
            'url' => 'required|url',
            'proveedor' => 'nullable|string|max:150',
            'descripcion' => 'nullable|string',
            'archivo' => $validate_archivo,
        ]);

      $datos=[
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'url' => $this->url,
            'categoria_id' => $this->categoria_id,
            'proveedor' => $this->proveedor,
            'tipo_acceso' => $this->tipo_acceso,
            'activo' => $this->activo,
            'destacado' => $this->destacado ?? false,
            
        ];

        if ($this->archivo) {
            //$data['archivo_nombre'] = $this->archivo->getClientOriginalName();
            $this->archivo_ruta = $this->archivo->store('recursos', 'public');
            //$data['archivo_tamaño'] = $this->archivo->getSize();
            //$data['tipo_mime'] = $this->archivo->getMimeType();
            $datos['imagen_recurso']= $this->archivo_ruta;
        }



        $result_recurso = RecursoDigital::updateOrCreate(['id' =>(int) $this->recurso_id], $datos);
    
        // Sincronizar relaciones muchos a muchos
        $result_recurso->areasConocimiento()->sync($this->area_conocimiento_form);
        $result_recurso->tiposUsuario()->sync($this->tipo_usuario_form);
        $result_recurso->programasAcademicos()->sync($this->programa_form);
        
        session()->flash('message', 'Recurso digital guardado exitosamente.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $recurso = RecursoDigital::with(['tiposUsuario', 'areasConocimiento', 'programasAcademicos'])
            ->findOrFail($id);
            
        $this->recurso_id = $id;
        $this->titulo = $recurso->titulo;
        $this->descripcion = $recurso->descripcion;
        $this->url = $recurso->url;
        $this->categoria_id = $recurso->categoria_id;
        $this->proveedor = $recurso->proveedor;
        $this->tipo_acceso = $recurso->tipo_acceso;
        $this->activo = $recurso->activo;
        $this->destacado = $recurso->destacado;
        
        // Cargar relaciones existentes
        $this->tipo_usuario_form = $recurso->tiposUsuario->pluck('id')->toArray();
        $this->area_conocimiento_form = $recurso->areasConocimiento->pluck('id')->toArray();
        $this->programa_form = $recurso->programasAcademicos->pluck('id')->toArray();
        
        $this->openModal();
        
        // Disparar evento para cargar los valores en los selects con un delay
        $valores = [
            'tipos' => $this->tipo_usuario_form,
            'areas' => $this->area_conocimiento_form,
            'programas' => $this->programa_form
        ];
        $this->js('setTimeout(() => { window.dispatchEvent(new CustomEvent("limpiar-selects")); }, 100);');
        $this->js('setTimeout(() => { 
            window.dispatchEvent(new CustomEvent("cargar-valores-selects", { 
                detail: ' . json_encode($valores) . ' 
            })); 
        }, 300);');
    }

    public function delete($id)
    {
        RecursoDigital::find($id)->delete();
        session()->flash('message', 'Recurso digital eliminado exitosamente.');
    }
}