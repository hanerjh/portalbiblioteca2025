<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Menu;
use App\Models\AreaConocimiento;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use App\Helpers\ColorHelpers;
use App\Helpers\SiglasHelpers;

class GestionAreaConocimiento extends Component
{
    use WithPagination;

    public $nombre, $descripcion, $posicion, $activo, $menu_id,$siglas;
    public $isOpen = false;
    protected $paginationTheme = 'bootstrap';
     #[Layout('components.layouts.admin')]
    public function render()
    {
        $areaconocimiento = AreaConocimiento::paginate(10);
       // $menus = Menu::paginate(10);
        
        return view('livewire.admin.gestion-area-conocimiento', compact('areaconocimiento'));
    }

    public function create() { $this->resetInputFields(); $this->openModal(); }
    public function openModal() { $this->isOpen = true; }
    public function closeModal() { $this->isOpen = false; }
    private function resetInputFields() { $this->reset(); $this->activo = true; }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|string|max:100',
            'activo' => 'required|boolean',
        ]);

        //$baget = generarColorBadge()
        $baget = ColorHelpers::generateTagStyles($this->nombre);
        if(!$this->siglas){

            $siglas = SiglasHelpers::generateSiglasTag($this->nombre);
        }

       // dd($baget);
       AreaConocimiento::updateOrCreate(['id' => $this->menu_id], [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'siglas' =>  $siglas ?? $this->siglas,
            'color_fondo' => $baget['fondo'],
            'color_texto' => $baget['texto'],
            'activa' => $this->activo,
        ]);

        session()->flash('message', 'Menú guardado.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $menu = AreaConocimiento::findOrFail($id);
        $this->menu_id = $id;
        $this->nombre = $menu->nombre;
        $this->descripcion = $menu->descripcion;
         $this->siglas = $menu->siglas;
         if($menu->activa==1){
          $this->activo=true;  
        }else{
             $this->activo=false;
        }  
        $this->openModal();
    }

    public function delete($id)
    {
        AreaConocimiento::find($id)->delete();
        session()->flash('message', 'Área de Conocimiento eliminado.');
    }



   

}
