<div class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, 0.5);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $userId ? 'Editar' : 'Crear' }} Usuario</h5>
                <button type="button" class="btn-close" wire:click="closeModal()"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="{{ $userId ? 'update' : 'store' }}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" wire:model.lazy="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" wire:model.lazy="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" wire:model.lazy="password">
                         @if($userId) <small class="form-text text-muted">Dejar en blanco para no cambiar la contraseña.</small> @endif
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" id="password_confirmation" class="form-control" wire:model.lazy="password_confirmation">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal()">Cancelar</button>
                <button type="button" class="btn btn-primary" wire:click="{{ $userId ? 'update' : 'store' }}">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
