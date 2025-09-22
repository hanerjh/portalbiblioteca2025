<div>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 80vh;">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-4">Iniciar Sesión</h2>
                        <form wire:submit.prevent="login">
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" wire:model="email" required autofocus>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" id="password" class="form-control" wire:model="password" required>
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" id="remember" class="form-check-input" wire:model="remember">
                                <label class="form-check-label" for="remember">Recuérdame</label>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <span wire:loading.remove>Ingresar</span>
                                    <span wire:loading>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Ingresando...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

