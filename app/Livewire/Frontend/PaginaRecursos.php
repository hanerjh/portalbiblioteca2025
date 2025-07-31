<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\RecursoDigital;
use App\Models\CategoriaRecurso;
use App\Models\ProgramaAcademico;
use App\Models\AreaConocimiento;
use App\Models\TipoUsuario;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class PaginaRecursos extends Component
{
    use WithPagination;

    // Propiedades para los filtros
    public $searchLetter = '';
    public $searchName = '';
    public $selectedTipos = [];
    public $selectedAreas = [];
    public $selectedAccesos = [];
    public $selectedUsuarios = [];
    public $selectedProg = [];

    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'searchName' => ['except' => '', 'as' => 'q'],
        'selectedTipos' => ['except' => []],
        'selectedAreas' => ['except' => []],
        'selectedAccesos' => ['except' => []],
        'selectedUsuarios' => ['except' => []],
        'selectedProg' => ['except' => []],
    ];
    
    #[Layout('components.layouts.publico_layout2')]
    //#[Layout('components.layouts.publico_layout')]
    public function render()
    {
        // Obtener los datos para poblar los filtros
        $tipos_recurso = CategoriaRecurso::where('activa', true)->get();
        $areas_conocimiento = AreaConocimiento::where('activa', true)->get();
        $tipos_usuario = TipoUsuario::where('activo', true)->get();
        $recursos_destacados = RecursoDigital::where('activo', true)->where('destacado', true)->take(5)->get();
        $programa = ProgramaAcademico::where('activo', true)->get();

        // Query base para los recursos
        $query = RecursoDigital::query()
            ->where('activo', true)
            ->with(['categoria', 'areasConocimiento', 'tiposUsuario','programasAcademicos']);

        // Aplicar filtros
        $this->applyFilters($query);

        $recursos = $query->orderBy('titulo')->paginate(10);

        return view('livewire.frontend.pagina-recursos', [
            'recursos' => $recursos,
            'tipos_recurso' => $tipos_recurso,
            'areas_conocimiento' => $areas_conocimiento,
            'tipos_usuario' => $tipos_usuario,
            'recursos_destacados' => $recursos_destacados,
            'programas' => $programa,
        ]);
    }
    
    private function applyFilters($query)
    {
        // Filtro por letra
        if ($this->searchLetter) {
            $query->where('titulo', 'like', $this->searchLetter . '%');
        }

        // Filtro por nombre
        if (strlen($this->searchName) >= 3) {
            $query->where('titulo', 'like', '%' . $this->searchName . '%');
        }

        // Filtro por tipo de recurso (desde categoria_recurso)
        if (!empty($this->selectedTipos)) {
            $query->whereHas('categoria', function ($q) {
                $q->whereIn('id', $this->selectedTipos);
            });
        }
        
        // Filtro por área de conocimiento (relación many-to-many)
        if (!empty($this->selectedAreas)) {
            $query->whereHas('areasConocimiento', function ($q) {
                $q->whereIn('areas_conocimiento.id', $this->selectedAreas);
            });
        }

        // Filtro por tipo de acceso
        if (!empty($this->selectedAccesos)) {
            $query->whereIn('tipo_acceso', $this->selectedAccesos);
        }

        // Filtro por tipo de usuario (relación many-to-many)
        if (!empty($this->selectedUsuarios)) {
            $query->whereHas('tiposUsuario', function ($q) {
                $q->whereIn('tipos_usuario.id', $this->selectedUsuarios);
            });
        }

        // Filtro por tipo de usuario (relación many-to-many)
        if (!empty($this->selectedProg)) {
            $query->whereHas('programasAcademicos', function ($q) {
                $q->whereIn('programas_academicos.id', $this->selectedProg);
            });
        }
    }

    public function setLetter($letter)
    {
        $this->searchLetter = ($this->searchLetter == $letter) ? '' : $letter;
        $this->resetPage();
    }

    public function updating()
    {
        $this->resetPage();
    }
}
