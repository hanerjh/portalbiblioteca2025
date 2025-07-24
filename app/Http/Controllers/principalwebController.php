<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Publicacion;
use App\Models\RecursoDigital;
use Illuminate\Http\Request;

class principalwebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Consultar las publicaciones
        $publicaciones = Publicacion::where('estado','Publicado')
        ->latest()
        ->limit(5)
        ->get();

        //Seleccionamos los enlaces que pertenecen al menu id (3) Solcitudes
        $menu=MenuItem::where(['menu_id'=>3, 'activo'=>1])
                               ->whereNull('parent_id')
                               ->with('children')
                               ->orderBy('orden')
                               ->get();

        $recursos = RecursoDigital::with('categoria')
            ->Where(['activo'=>1, 'destacado'=>1])
            ->latest()
            ->paginate(10);

        return view('biblioteca_index',compact('publicaciones','menu', 'recursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
