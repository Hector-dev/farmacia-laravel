@extends('layouts.app')

@section('title', 'Detalles del Empleado')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detalles del Empleado</h4>
                    <div>
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Información Personal</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Nombre:</th>
                                    <td>{{ $employee->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $employee->email }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono:</th>
                                    <td>{{ $employee->phone ?? 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <th>Dirección:</th>
                                    <td>{{ $employee->address ?? 'No especificada' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Información Laboral</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Cargo:</th>
                                    <td>{{ $employee->position }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha Contratación:</th>
                                    <td>{{ $employee->hire_date->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Salario:</th>
                                    <td>{{ $employee->salary ? '€' . number_format($employee->salary, 2) : 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <th>Documento:</th>
                                    <td>{{ $employee->document_type }}: {{ $employee->document_number }}</td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        @if($employee->is_active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Movimientos de Inventario Registrados</h5>
                            @if($employee->inventoryMovements->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Medicamento</th>
                                                <th>Tipo</th>
                                                <th>Cantidad</th>
                                                <th>Almacén</th>
                                                <th>Cliente</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($employee->inventoryMovements->take(10) as $movement)
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
                                                <td>{{ $movement->warehouse->name }}</td>
                                                <td>{{ $movement->customer ? $movement->customer->full_name : 'N/A' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if($employee->inventoryMovements->count() > 10)
                                    <p class="text-muted">Mostrando los últimos 10 movimientos de {{ $employee->inventoryMovements->count() }} totales.</p>
                                @endif
                            @else
                                <div class="alert alert-warning">
                                    No hay movimientos de inventario registrados por este empleado.
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