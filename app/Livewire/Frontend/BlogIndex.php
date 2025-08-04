<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Publicacion;
use App\Models\CategoriaPublicacion;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class BlogIndex extends Component
{
    use WithPagination;

    public $selectedCategory = null;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'selectedCategory' => ['except' => null, 'as' => 'categoria'],
    ];

    #[Layout('components.layouts.publico_layout_page')]
    public function render()
    {
        // Query base para publicaciones publicadas
        $query = Publicacion::where('estado', 'publicado');

        // Filtrar por categoría si hay una seleccionada
        if ($this->selectedCategory) {
            $query->whereHas('categoria', function ($q) {
                $q->where('slug', $this->selectedCategory);
            });
        }
        
        // Obtener la publicación más reciente para destacarla
        $featuredPost = (clone $query)->latest('fecha_publicacion')->first();
        
        // Obtener las demás publicaciones, excluyendo la destacada si existe
        if ($featuredPost) {
            $query->where('id', '!=', $featuredPost->id);
        }

        $posts = $query->latest('fecha_publicacion')->paginate(6);
        
        // Obtener todas las categorías para los filtros
        $categorias = CategoriaPublicacion::where('activa', true)->get();

        return view('livewire.frontend.blog-index', [
            'featuredPost' => $featuredPost,
            'posts' => $posts,
            'categorias' => $categorias,
        ]); // Usamos el layout público
    }

    public function filterByCategory($categorySlug)
    {
        $this->selectedCategory = $categorySlug;
        $this->resetPage();
    }

    public function clearCategoryFilter()
    {
        $this->selectedCategory = null;
        $this->resetPage();
    }
}

