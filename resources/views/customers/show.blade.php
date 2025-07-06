@extends('layouts.app')

@section('title', 'Detalles del Cliente')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detalles del Cliente</h4>
                    <div>
                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-sm">
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
                                    <td>{{ $customer->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $customer->email }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono:</th>
                                    <td>{{ $customer->phone ?? 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <th>Dirección:</th>
                                    <td>{{ $customer->address ?? 'No especificada' }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha Nacimiento:</th>
                                    <td>{{ $customer->birth_date ? $customer->birth_date->format('d/m/Y') : 'No especificada' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Información de Documentación</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Documento:</th>
                                    <td>{{ $customer->document_type }}: {{ $customer->document_number }}</td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        @if($customer->is_active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Creado:</th>
                                    <td>{{ $customer->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Actualizado:</th>
                                    <td>{{ $customer->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($customer->medical_history)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Historial Médico</h5>
                            <div class="alert alert-info">
                                {{ $customer->medical_history }}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($customer->allergies)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Alergias</h5>
                            <div class="alert alert-warning">
                                {{ $customer->allergies }}
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Compras Realizadas</h5>
                            @if($customer->inventoryMovements->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Medicamento</th>
                                                <th>Cantidad</th>
                                                <th>Almacén</th>
                                                <th>Empleado</th>
                                                <th>Notas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customer->inventoryMovements->take(10) as $movement)
                                            <tr>
                                                <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                                                <td>{{ $movement->medicine->name }}</td>
                                                <td>{{ $movement->quantity }}</td>
                                                <td>{{ $movement->warehouse->name }}</td>
                                                <td>{{ $movement->employee->full_name }}</td>
                                                <td>{{ $movement->notes ?? 'Sin notas' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if($customer->inventoryMovements->count() > 10)
                                    <p class="text-muted">Mostrando las últimas 10 compras de {{ $customer->inventoryMovements->count() }} totales.</p>
                                @endif
                            @else
                                <div class="alert alert-warning">
                                    No hay compras registradas para este cliente.
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