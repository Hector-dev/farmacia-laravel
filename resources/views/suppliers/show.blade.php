@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detalles del Proveedor</h4>
                    <div>
                        <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
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
                                    <td><strong>ID:</strong></td>
                                    <td>{{ $supplier->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nombre:</strong></td>
                                    <td>{{ $supplier->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Contacto:</strong></td>
                                    <td>{{ $supplier->contact_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $supplier->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Teléfono:</strong></td>
                                    <td>{{ $supplier->phone ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Información Adicional</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Estado:</strong></td>
                                    <td>
                                        @if($supplier->is_active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>NIF:</strong></td>
                                    <td>{{ $supplier->tax_id ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Creado:</strong></td>
                                    <td>{{ $supplier->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Actualizado:</strong></td>
                                    <td>{{ $supplier->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($supplier->address)
                        <div class="row mt-3">
                            <div class="col-12">
                                <h5>Dirección</h5>
                                <p>{{ $supplier->address }}</p>
                            </div>
                        </div>
                    @endif

                    @if($supplier->notes)
                        <div class="row mt-3">
                            <div class="col-12">
                                <h5>Notas</h5>
                                <p>{{ $supplier->notes }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Medicamentos Asociados</h5>
                            @if($supplier->medicines->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Nombre</th>
                                                <th>Stock</th>
                                                <th>Precio</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($supplier->medicines as $medicine)
                                                <tr>
                                                    <td>{{ $medicine->code }}</td>
                                                    <td>{{ $medicine->name }}</td>
                                                    <td>{{ $medicine->stock }}</td>
                                                    <td>${{ number_format($medicine->price, 2) }}</td>
                                                    <td>
                                                        @if($medicine->is_active)
                                                            <span class="badge bg-success">Activo</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactivo</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">No hay medicamentos asociados a este proveedor.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 