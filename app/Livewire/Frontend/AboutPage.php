<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\Attributes\Layout;
class AboutPage extends Component
{
    #[Layout('components.layouts.publico_layout_page')]
    public function render()
    {
        return view('livewire.frontend.about-page');
    }
}
