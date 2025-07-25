<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Menu;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class GestionMenus extends Component
{
    use WithPagination;

    public $nombre, $descripcion, $posicion, $activo, $menu_id;
    public $isOpen = false;
    protected $paginationTheme = 'bootstrap';
     #[Layout('components.layouts.admin')]
    public function render()
    {
        $menus = Menu::paginate(10);
        return view('livewire.admin.gestion-menus', compact('menus'));
    }

    public function create() { $this->resetInputFields(); $this->openModal(); }
    public function openModal() { $this->isOpen = true; }
    public function closeModal() { $this->isOpen = false; }
    private function resetInputFields() { $this->reset(); $this->activo = true; }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|string|max:100',
            'posicion' => 'required|string|max:50',
            'activo' => 'required|boolean',
        ]);

        Menu::updateOrCreate(['id' => $this->menu_id], [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'posicion' => $this->posicion,
            'activo' => $this->activo,
        ]);

        session()->flash('message', 'Menú guardado.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $this->menu_id = $id;
        $this->nombre = $menu->nombre;
        $this->descripcion = $menu->descripcion;
        $this->posicion = $menu->posicion;
        if($menu->activo==1){
          $this->activo=true;  
        }else{
             $this->activo=false;
        }  
        $this->openModal();
    }

    public function delete($id)
    {
        Menu::find($id)->delete();
        session()->flash('message', 'Menú eliminado.');
    }
}
