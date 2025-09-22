<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestionar Usuarios</h1>
        <button class="btn btn-primary" wire:click="create()">
            <i class="bi bi-plus-circle-fill me-1"></i> Crear Nuevo Usuario
        </button>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($isOpen)
        @include('livewire.admin.modals.usuario-modal')
    @endif

    <div class="card shadow">
        <div class="card-header">
            <input type="text" class="form-control" placeholder="Buscar usuario por nombre o email..." wire:model.live="search">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha de Creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <button wire:click="edit({{ $user->id }})" class="btn btn-sm btn-warning">Editar</button>
                                <button wire:click="delete({{ $user->id }})" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">Eliminar</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No se encontraron usuarios.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>
</div>
