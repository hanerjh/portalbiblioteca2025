<div class="space-y-4">
    <h2 class="text-xl font-bold">Crear nuevo Layout</h2>

    @if (session()->has('success'))
        <div class="text-green-600">{{ session('success') }}</div>
    @endif

    <input type="text" wire:model="name" placeholder="Nombre del layout" class="border p-2 w-full">
    <input type="text" wire:model="viewPath" placeholder="Ruta Blade (layouts.marketing)" class="border p-2 w-full">

    <button wire:click="save" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
</div>

