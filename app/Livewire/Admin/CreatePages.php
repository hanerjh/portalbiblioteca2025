<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Page;
use App\Models\Layouts;
use Livewire\Attributes\Layout;

class CreatePages extends Component
{
     public $title;
    public $content;
    public $layout_id;

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'layout_id' => 'required|exists:layouts,id',
        ]);

        Page::create([
            'title' => $this->title,
            'content' => $this->content,
            'layout_id' => $this->layout_id,
        ]);

        session()->flash('success', 'Página creada correctamente');
        $this->reset();
    }
    
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.create-pages', [
            'layouts' => Layouts::all(),
        ]);
    }
}
