<?php


namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Publicacion;
use Livewire\Attributes\Layout;

class BlogPost extends Component
{
    public Publicacion $post;

    public function mount($slug)
    {
        // Buscamos la publicación por su slug. Si no se encuentra, Laravel mostrará un 404.
        $this->post = Publicacion::where('slug', $slug)
                                 ->where('estado', 'publicado')
                                 ->firstOrFail();
    }

    #[Layout('components.layouts.publico_layout_page')]
    public function render()
    {
        // Obtener algunas publicaciones recientes para mostrar como sugerencias
        $recentPosts = Publicacion::where('estado', 'publicado')
                                  ->where('id', '!=', $this->post->id)
                                  ->latest('fecha_publicacion')
                                  ->take(4)
                                  ->get();

        return view('livewire.frontend.blog-post', [
            'recentPosts' => $recentPosts
        ]);
    }
}

