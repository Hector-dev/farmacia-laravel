@extends('layouts.app')

@section('title', 'Detalles del Medicamento')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detalles del Medicamento</h4>
                    <div>
                        <a href="{{ route('medicines.edit', $medicine) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('medicines.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Información General</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Nombre:</th>
                                    <td>{{ $medicine->name }}</td>
                                </tr>
                                <tr>
                                    <th>Código:</th>
                                    <td><span class="badge bg-info">{{ $medicine->code }}</span></td>
                                </tr>
                                <tr>
                                    <th>Precio:</th>
                                    <td><span class="badge bg-success">€{{ number_format($medicine->price, 2) }}</span></td>
                                </tr>
                                <tr>
                                    <th>Stock:</th>
                                    <td>
                                        @if($medicine->stock > 10)
                                            <span class="badge bg-success">{{ $medicine->stock }} unidades</span>
                                        @elseif($medicine->stock > 0)
                                            <span class="badge bg-warning">{{ $medicine->stock }} unidades</span>
                                        @else
                                            <span class="badge bg-danger">Sin stock</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Proveedor:</th>
                                    <td>{{ $medicine->supplier->name }}</td>
                                </tr>
                                <tr>
                                    <th>Categoría:</th>
                                    <td>{{ $medicine->category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha Vencimiento:</th>
                                    <td>
                                        @if($medicine->expiration_date)
                                            @if($medicine->expiration_date->isPast())
                                                <span class="badge bg-danger">{{ $medicine->expiration_date->format('d/m/Y') }} (Vencido)</span>
                                            @elseif($medicine->expiration_date->diffInDays(now()) <= 30)
                                                <span class="badge bg-warning">{{ $medicine->expiration_date->format('d/m/Y') }} (Próximo a vencer)</span>
                                            @else
                                                <span class="badge bg-success">{{ $medicine->expiration_date->format('d/m/Y') }}</span>
                                            @endif
                                        @else
                                            <span class="text-muted">No especificada</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Información Adicional</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Estado:</th>
                                    <td>
                                        @if($medicine->is_active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Creado:</th>
                                    <td>{{ $medicine->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Actualizado:</th>
                                    <td>{{ $medicine->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($medicine->description)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Descripción</h5>
                            <div class="alert alert-info">
                                {{ $medicine->description }}
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Movimientos de Inventario</h5>
                            @if($medicine->inventoryMovements->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Tipo</th>
                                                <th>Cantidad</th>
                                                <th>Almacén</th>
                                                <th>Empleado</th>
                                                <th>Cliente</th>
                                                <th>Notas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($medicine->inventoryMovements->take(10) as $movement)
                                            <tr>
                                                <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    @if($movement->type == 'entry')
                                                        <span class="badge bg-success">Entrada</span>
                                                    @else
                                                        <span class="badge bg-warning">Salida</span>
                                                    @endif
                                                </td>
                                                <td>{{ $movement->quantity }}</td>
                                                <td>{{ $movement->warehouse->name }}</td>
                                                <td>{{ $movement->employee->full_name }}</td>
                                                <td>{{ $movement->customer ? $movement->customer->full_name : 'N/A' }}</td>
                                                <td>{{ $movement->notes ?? 'Sin notas' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if($medicine->inventoryMovements->count() > 10)
                                    <p class="text-muted">Mostrando los últimos 10 movimientos de {{ $medicine->inventoryMovements->count() }} totales.</p>
                                @endif
                            @else
                                <div class="alert alert-warning">
                                    No hay movimientos de inventario registrados para este medicamento.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 