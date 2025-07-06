@extends('layouts.app')

@section('title', 'Detalles de la Categoría')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detalles de la Categoría</h4>
                    <div>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
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
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Código:</th>
                                    <td><span class="badge bg-info">{{ $category->code }}</span></td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Creado:</th>
                                    <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Actualizado:</th>
                                    <td>{{ $category->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            @if($category->description)
                            <h5>Descripción</h5>
                            <div class="alert alert-info">
                                {{ $category->description }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Medicamentos en esta Categoría</h5>
                            @if($category->medicines->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>
                                                <th>Stock</th>
                                                <th>Proveedor</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($category->medicines as $medicine)
                                            <tr>
                                                <td>{{ $medicine->code }}</td>
                                                <td>{{ $medicine->name }}</td>
                                                <td>€{{ number_format($medicine->price, 2) }}</td>
                                                <td>
                                                    @if($medicine->stock > 10)
                                                        <span class="badge bg-success">{{ $medicine->stock }}</span>
                                                    @elseif($medicine->stock > 0)
                                                        <span class="badge bg-warning">{{ $medicine->stock }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ $medicine->stock }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $medicine->supplier->name }}</td>
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
                                <p class="text-muted">Total de medicamentos: {{ $category->medicines->count() }}</p>
                            @else
                                <div class="alert alert-warning">
                                    No hay medicamentos registrados en esta categoría.
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