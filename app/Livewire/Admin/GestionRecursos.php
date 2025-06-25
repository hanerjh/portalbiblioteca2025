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

class GestionRecursos extends Component
{
    use WithPagination;

    // Propiedades del modelo
    public $titulo, $descripcion, $url, $categoria_id, $proveedor, $tipo_acceso, $recurso_id;
    public array $tipo_usuario_form=[];
    public array $area_conocimiento_form=[];
     public array $programa_form=[];
   
    
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
            'tipoUsuarios'=>$tipo_usuario,
             'area'=>$area_conocimiento,
             'programa'=>$programaAcademicos,
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
        $this->dispatch('resetChoices'); 
    }

    public function store()
    {
        $this->validate([
            'titulo' => 'required|string|max:200',
            'categoria_id' => 'required|exists:categorias_recurso,id',
            'tipo_acceso' => 'required|in:libre,restringido,suscripcion',
            'url' => 'required|url',
            'proveedor' => 'nullable|string|max:150',
            'descripcion' => 'nullable|string',
        ]);

        $result_recurso=RecursoDigital::updateOrCreate(['id' => $this->recurso_id], [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'url' => $this->url,
            'categoria_id' => $this->categoria_id,
            'proveedor' => $this->proveedor,
            'tipo_acceso' => $this->tipo_acceso,
        ]);
    
        //FORMA DINAMICA DE REGISTRAR INFORMACION A TABLAS PIVOTES MUCHO A MUCHOS 
        // [recuros_area],[recuros_usuario], [recuros_programa] etc.
        /**
         * 1. $result_recurso guarda el contendido del modelo de RecursoDigital
         * 2. $result_recurso->areasConocimiento() es una relacion  de muchos a mucho entre los modelos (tablas)
         * areasConocimiento() es la funcion creada en el modelo de RecursoDigital que hace la unido de uno a muchos
         * 3. ->sync([1,2,3]) metodo que permite agregar los datos array a la tabla pivite (mucho a muchos [recuros_area])
         */
        $result_recurso->areasConocimiento()->sync($this->area_conocimiento_form);
        $result_recurso->tiposUsuario()->sync($this->tipo_usuario_form);
        $result_recurso->programasAcademicos()->sync($this->programa_form);

         //dd($this->tipo_usuario_form, $this->area_conocimiento_form);

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
