<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Page;
use App\Models\Seccion;
use Livewire\Attributes\Layout;

class PageViewer extends Component
{
   //public Page $page;
   public Seccion $page;
   public $layout;

    public function mount($id)
    {
        //$this->page = Page::with('layout')->findOrFail($id);
        //$this->page = Seccion::findOrFail($id);
        $this->page = Seccion::where('slug', $id)
            ->firstOrFail();
    }

    #[Layout('components.layouts.publico_layout_page')]
    public function render()
    {
        return view('livewire.frontend.page-viewer', [
            'page' => $this->page,
        ]);

       
    }

      public function layout()
    {
        return 'components.layouts.publico_layout_page';
        //return $this->page->layout->view_path;
        // Ej: "components.layouts.publico_layout_page"
        // remplaza a 
    }
}
