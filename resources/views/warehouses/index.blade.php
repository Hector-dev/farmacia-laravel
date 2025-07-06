@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Almacenes</h4>
                    <a href="{{ route('warehouses.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nuevo Almacén
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Gerente</th>
                                    <th>Capacidad</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($warehouses as $warehouse)
                                    <tr>
                                        <td>{{ $warehouse->id }}</td>
                                        <td>{{ $warehouse->code }}</td>
                                        <td>{{ $warehouse->name }}</td>
                                        <td>{{ Str::limit($warehouse->address, 30) }}</td>
                                        <td>{{ $warehouse->phone ?? 'N/A' }}</td>
                                        <td>{{ $warehouse->manager_name ?? 'N/A' }}</td>
                                        <td>{{ $warehouse->capacity ? number_format($warehouse->capacity, 2) : 'N/A' }}</td>
                                        <td>
                                            @if($warehouse->is_active)
                                                <span class="badge bg-success">Activo</span>
                                            @else
                                                <span class="badge bg-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('warehouses.show', $warehouse) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('warehouses.edit', $warehouse) }}" 
                                                   class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('warehouses.destroy', $warehouse) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('¿Está seguro de eliminar este almacén?')"
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No hay almacenes registrados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $warehouses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 