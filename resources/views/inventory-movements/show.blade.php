@extends('layouts.app')

@section('title', 'Detalles del Movimiento de Inventario')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detalles del Movimiento de Inventario</h4>
                    <div>
                        <a href="{{ route('inventory-movements.edit', $inventoryMovement) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('inventory-movements.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Información del Movimiento</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">ID:</th>
                                    <td><span class="badge bg-info">#{{ $inventoryMovement->id }}</span></td>
                                </tr>
                                <tr>
                                    <th>Tipo:</th>
                                    <td>
                                        @if($inventoryMovement->type == 'entry')
                                            <span class="badge bg-success">Entrada</span>
                                        @else
                                            <span class="badge bg-warning">Salida</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Cantidad:</th>
                                    <td><strong>{{ $inventoryMovement->quantity }} unidades</strong></td>
                                </tr>
                                <tr>
                                    <th>Fecha:</th>
                                    <td>{{ $inventoryMovement->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Actualizado:</th>
                                    <td>{{ $inventoryMovement->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Información del Medicamento</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Medicamento:</th>
                                    <td>{{ $inventoryMovement->medicine->name }}</td>
                                </tr>
                                <tr>
                                    <th>Código:</th>
                                    <td><span class="badge bg-secondary">{{ $inventoryMovement->medicine->code }}</span></td>
                                </tr>
                                <tr>
                                    <th>Precio:</th>
                                    <td>€{{ number_format($inventoryMovement->medicine->price, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Stock Actual:</th>
                                    <td>
                                        @if($inventoryMovement->medicine->stock > 10)
                                            <span class="badge bg-success">{{ $inventoryMovement->medicine->stock }}</span>
                                        @elseif($inventoryMovement->medicine->stock > 0)
                                            <span class="badge bg-warning">{{ $inventoryMovement->medicine->stock }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $inventoryMovement->medicine->stock }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Información del Almacén</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Almacén:</th>
                                    <td>{{ $inventoryMovement->warehouse->name }}</td>
                                </tr>
                                <tr>
                                    <th>Código:</th>
                                    <td><span class="badge bg-info">{{ $inventoryMovement->warehouse->code }}</span></td>
                                </tr>
                                <tr>
                                    <th>Dirección:</th>
                                    <td>{{ $inventoryMovement->warehouse->address }}</td>
                                </tr>
                                <tr>
                                    <th>Encargado:</th>
                                    <td>{{ $inventoryMovement->warehouse->manager_name ?? 'No especificado' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Información del Empleado</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Empleado:</th>
                                    <td>{{ $inventoryMovement->employee->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>Cargo:</th>
                                    <td>{{ $inventoryMovement->employee->position }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $inventoryMovement->employee->email }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono:</th>
                                    <td>{{ $inventoryMovement->employee->phone ?? 'No especificado' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($inventoryMovement->customer)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Información del Cliente</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Cliente:</th>
                                    <td>{{ $inventoryMovement->customer->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $inventoryMovement->customer->email }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono:</th>
                                    <td>{{ $inventoryMovement->customer->phone ?? 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <th>Documento:</th>
                                    <td>{{ $inventoryMovement->customer->document_type }}: {{ $inventoryMovement->customer->document_number }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if($inventoryMovement->notes)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Notas</h5>
                            <div class="alert alert-info">
                                {{ $inventoryMovement->notes }}
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Resumen del Movimiento</h5>
                            <div class="alert alert-{{ $inventoryMovement->type == 'entry' ? 'success' : 'warning' }}">
                                <strong>
                                    @if($inventoryMovement->type == 'entry')
                                        ✅ Entrada de {{ $inventoryMovement->quantity }} unidades de {{ $inventoryMovement->medicine->name }}
                                        en el almacén {{ $inventoryMovement->warehouse->name }}
                                    @else
                                        📤 Salida de {{ $inventoryMovement->quantity }} unidades de {{ $inventoryMovement->medicine->name }}
                                        desde el almacén {{ $inventoryMovement->warehouse->name }}
                                        @if($inventoryMovement->customer)
                                            para el cliente {{ $inventoryMovement->customer->full_name }}
                                        @endif
                                    @endif
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 