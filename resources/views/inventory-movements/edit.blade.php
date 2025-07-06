@extends('layouts.app')

@section('title', 'Editar Movimiento de Inventario')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Editar Movimiento de Inventario</h4>
                    <div>
                        <a href="{{ route('inventory-movements.show', $inventoryMovement) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                        <a href="{{ route('inventory-movements.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('inventory-movements.update', $inventoryMovement) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="medicine_id" class="form-label">Medicamento *</label>
                                    <select class="form-select @error('medicine_id') is-invalid @enderror" 
                                            id="medicine_id" name="medicine_id" required>
                                        <option value="">Seleccionar medicamento</option>
                                        @foreach($medicines as $medicine)
                                            <option value="{{ $medicine->id }}" 
                                                {{ old('medicine_id', $inventoryMovement->medicine_id) == $medicine->id ? 'selected' : '' }}>
                                                {{ $medicine->name }} ({{ $medicine->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('medicine_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="warehouse_id" class="form-label">Almacén *</label>
                                    <select class="form-select @error('warehouse_id') is-invalid @enderror" 
                                            id="warehouse_id" name="warehouse_id" required>
                                        <option value="">Seleccionar almacén</option>
                                        @foreach($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}" 
                                                {{ old('warehouse_id', $inventoryMovement->warehouse_id) == $warehouse->id ? 'selected' : '' }}>
                                                {{ $warehouse->name }} ({{ $warehouse->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('warehouse_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="employee_id" class="form-label">Empleado *</label>
                                    <select class="form-select @error('employee_id') is-invalid @enderror" 
                                            id="employee_id" name="employee_id" required>
                                        <option value="">Seleccionar empleado</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}" 
                                                {{ old('employee_id', $inventoryMovement->employee_id) == $employee->id ? 'selected' : '' }}>
                                                {{ $employee->full_name }} ({{ $employee->position }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="customer_id" class="form-label">Cliente (Opcional)</label>
                                    <select class="form-select @error('customer_id') is-invalid @enderror" 
                                            id="customer_id" name="customer_id">
                                        <option value="">Sin cliente</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" 
                                                {{ old('customer_id', $inventoryMovement->customer_id) == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Tipo de Movimiento *</label>
                                    <select class="form-select @error('type') is-invalid @enderror" 
                                            id="type" name="type" required>
                                        <option value="entry" {{ old('type', $inventoryMovement->type) == 'entry' ? 'selected' : '' }}>Entrada</option>
                                        <option value="exit" {{ old('type', $inventoryMovement->type) == 'exit' ? 'selected' : '' }}>Salida</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Cantidad *</label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                           id="quantity" name="quantity" value="{{ old('quantity', $inventoryMovement->quantity) }}" 
                                           min="1" required>
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notas</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3">{{ old('notes', $inventoryMovement->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Actualizar Movimiento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 