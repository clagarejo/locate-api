<!-- resources/views/users/create.blade.php -->

<form action="{{ route('users.store') }}" method="POST">
    @csrf <!-- Agregar token CSRF -->

    <!-- Campo de nombre completo -->
    <div class="mb-3">
        <label for="fullname" class="form-label">Nombre completo</label>
        <input type="text" class="form-control" id="fullname" name="fullname" required>
    </div>

    <!-- Campo de correo electrónico -->
    <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <!-- Campo de teléfono -->
    <div class="mb-3">
        <label for="phone" class="form-label">Teléfono</label>
        <input type="tel" class="form-control" id="phone" name="phone" required>
    </div>

    <!-- Campo de dirección -->
    <div class="mb-3">
        <label for="address" class="form-label">Dirección</label>
        <input type="text" class="form-control" id="address" name="address" required>
    </div>

    <!-- Campo de tipo de documento -->
    <div class="mb-3">
        <label for="document_type" class="form-label">Tipo de documento</label>
        <select class="form-select" id="document_type" name="document_type" required>
            <option value="" disabled selected>Seleccionar tipo de documento</option>
            @foreach($documentTypes as $documentType)
                <option value="{{ $documentType->id }}">{{ $documentType->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Campo de número de documento -->
    <div class="mb-3">
        <label for="document" class="form-
