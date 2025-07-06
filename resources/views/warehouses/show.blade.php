@extends('layouts.app')

@section('title', 'Detalles del Almacén')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detalles del Almacén</h4>
                    <div>
                        <a href="{{ route('warehouses.edit', $warehouse) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('warehouses.index') }}" class="btn btn-secondary btn-sm">
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
                                    <td>{{ $warehouse->name }}</td>
                                </tr>
                                <tr>
                                    <th>Código:</th>
                                    <td><span class="badge bg-info">{{ $warehouse->code }}</span></td>
                                </tr>
                                <tr>
                                    <th>Dirección:</th>
                                    <td>{{ $warehouse->address }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono:</th>
                                    <td>{{ $warehouse->phone ?? 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <th>Encargado:</th>
                                    <td>{{ $warehouse->manager_name ?? 'No especificado' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Información Adicional</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Capacidad:</th>
                                    <td>{{ $warehouse->capacity ? number_format($warehouse->capacity, 2) . ' m³' : 'No especificada' }}</td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        @if($warehouse->is_active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Creado:</th>
                                    <td>{{ $warehouse->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Actualizado:</th>
                                    <td>{{ $warehouse->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($warehouse->description)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Descripción</h5>
                            <div class="alert alert-info">
                                {{ $warehouse->description }}
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Movimientos de Inventario</h5>
                            @if($warehouse->inventoryMovements->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Medicamento</th>
                                                <th>Tipo</th>
                                                <th>Cantidad</th>
                                                <th>Empleado</th>
                                                <th>Cliente</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($warehouse->inventoryMovements->take(10) as $movement)
                                            <tr>
                                                <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                                                <td>{{ $movement->medicine->name }}</td>
                                                <td>
                                                    @if($movement->type == 'entry')
                                                        <span class="badge bg-success">Entrada</span>
                                                    @else
                                                        <span class="badge bg-warning">Salida</span>
                                                    @endif
                                                </td>
                                                <td>{{ $movement->quantity }}</td>
                                                <td>{{ $movement->employee->full_name }}</td>
                                                <td>{{ $movement->customer ? $movement->customer->full_name : 'N/A' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if($warehouse->inventoryMovements->count() > 10)
                                    <p class="text-muted">Mostrando los últimos 10 movimientos de {{ $warehouse->inventoryMovements->count() }} totales.</p>
                                @endif
                            @else
                                <div class="alert alert-warning">
                                    No hay movimientos de inventario registrados para este almacén.
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