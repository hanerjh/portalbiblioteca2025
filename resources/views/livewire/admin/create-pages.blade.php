<div class="space-y-4">
    <h2 class="text-xl font-bold">Crear nueva Página</h2>

    @if (session()->has('success'))
        <div class="text-green-600">{{ session('success') }}</div>
    @endif

    <input type="text" wire:model="title" placeholder="Título" class="border p-2 w-full">
    <textarea wire:model="content" placeholder="Contenido HTML" class="border p-2 w-full"></textarea>

    <select wire:model="layout_id" class="border p-2 w-full">
        <option value="">-- Selecciona un layout --</option>
        @foreach ($layouts as $layout)
            <option value="{{ $layout->id }}">{{ $layout->name }} ({{ $layout->view_path }})</option>
        @endforeach
    </select>

    <button wire:click="save" class="bg-green-500 text-white px-4 py-2 rounded">Guardar Página</button>
</div>

