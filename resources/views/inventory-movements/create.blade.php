@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Nuevo Movimiento de Inventario</h1>
    <a href="{{ route('inventory-movements.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('inventory-movements.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="medicine_id" class="form-label">Medicina</label>
                <select class="form-select @error('medicine_id') is-invalid @enderror" id="medicine_id" name="medicine_id" required>
                    <option value="">Seleccione una medicina</option>
                    @foreach($medicines as $medicine)
                        <option value="{{ $medicine->id }}" {{ old('medicine_id') == $medicine->id ? 'selected' : '' }}>
                            {{ $medicine->name }} (Stock: {{ $medicine->stock }})
                        </option>
                    @endforeach
                </select>
                @error('medicine_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tipo de Movimiento</label>
                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                    <option value="">Seleccione un tipo</option>
                    <option value="entrada" {{ old('type') == 'entrada' ? 'selected' : '' }}>Entrada</option>
                    <option value="salida" {{ old('type') == 'salida' ? 'selected' : '' }}>Salida</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Cantidad</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" required min="1">
                @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="reason" class="form-label">Razón</label>
                <input type="text" class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" value="{{ old('reason') }}">
                @error('reason')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="reference_number" class="form-label">Número de Referencia</label>
                <input type="text" class="form-control @error('reference_number') is-invalid @enderror" id="reference_number" name="reference_number" value="{{ old('reference_number') }}">
                @error('reference_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@endsection 