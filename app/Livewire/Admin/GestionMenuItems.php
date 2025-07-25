<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Menu;
use App\Models\MenuItem;
use Livewire\Attributes\Layout;

class GestionMenuItems extends Component
{
    public $menu; // Instancia del modelo Menu
    public $menu_id;
    public $items;

    // Propiedades del formulario
    public $titulo, $url, $tipo_enlace, $parent_id = "", $orden, $activo, $target_blank, $item_id, $icono;
    public $isOpen = false;

    public function mount(Menu $menu)
    {
        $this->menu = $menu;
        $this->menu_id = $menu->id;
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $this->items = MenuItem::where('menu_id',$this->menu_id)
                               ->whereNull('parent_id')
                               ->with('children')
                               ->orderBy('orden')
                               ->get();

        $potential_parents = MenuItem::where('menu_id', $this->menu_id)
                                     ->whereNull('parent_id')
                                     ->get();

        return view('livewire.admin.gestion-menu-items', [
            'potential_parents' => $potential_parents,
            'menu' => $this->menu, // <-- Pasamos $menu para que esté disponible en la vista
        ]);
    }

    public function create($parent_id = null)
    {
        $this->resetInputFields();
        $this->parent_id = $parent_id;
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
        $this->reset([
            'titulo', 'url', 'tipo_enlace', 'parent_id', 'orden', 'activo', 'target_blank', 'item_id','icono'
        ]);
       $this->activo=true;
        $this->tipo_enlace = 'interno';
    }

    public function store()
    {
        $this->validate([
            'titulo' => 'required|string|max:100',
            'url' => 'nullable|string|max:255',
            'tipo_enlace' => 'required|in:interno,externo,seccion',
            'activo' => 'required|boolean',
        ]);

        MenuItem::updateOrCreate(['id' => $this->item_id], [
            'menu_id' => $this->menu_id,
            'titulo' => $this->titulo,
            'icono' => $this->icono ?: null,
            'url' => $this->url,
            'tipo_enlace' => $this->tipo_enlace,
            'parent_id' => $this->parent_id ?: null,
            'orden' => $this->orden ?? 0,
            'activo' => $this->activo,
            'target_blank' => $this->target_blank ?? false,
        ]);

        session()->flash('message', 'Item de menú guardado.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $item = MenuItem::findOrFail($id);
        $this->item_id = $id;
        $this->titulo = $item->titulo;
        $this->url = $item->url;
        $this->icono=$item->icono;
        $this->tipo_enlace = $item->tipo_enlace;
        $this->parent_id = $item->parent_id;
        $this->orden = $item->orden;
        if($item->activo==1){

            $this->activo = true;
        }
        else{
            $this->activo = false;
        }
        if($item->target_blank==1){

            $this->target_blank  = true;
        }else{
            $this->target_blank  = false;
        }
      
        
        $this->openModal();
    }

    public function delete($id)
    {
        MenuItem::find($id)->delete();
        session()->flash('message', 'Item de menú eliminado.');
    }
}