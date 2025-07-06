@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Medicamentos</h4>
                    <a href="{{ route('medicines.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nuevo Medicamento
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
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Categoría</th>
                                    <th>Proveedor</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($medicines as $medicine)
                                    <tr>
                                        <td>{{ $medicine->id }}</td>
                                        <td>{{ $medicine->code }}</td>
                                        <td>{{ $medicine->name }}</td>
                                        <td>{{ Str::limit($medicine->description, 30) ?? 'N/A' }}</td>
                                        <td>${{ number_format($medicine->price, 2) }}</td>
                                        <td>
                                            <span class="badge {{ $medicine->stock > 10 ? 'bg-success' : ($medicine->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                                {{ $medicine->stock }}
                                            </span>
                                        </td>
                                        <td>{{ $medicine->category->name ?? 'N/A' }}</td>
                                        <td>{{ $medicine->supplier->name ?? 'N/A' }}</td>
                                        <td>
                                            @if($medicine->expiration_date)
                                                @if($medicine->expiration_date->isPast())
                                                    <span class="badge bg-danger">{{ $medicine->expiration_date->format('d/m/Y') }} (Vencido)</span>
                                                @elseif($medicine->expiration_date->diffInDays(now()) <= 30)
                                                    <span class="badge bg-warning">{{ $medicine->expiration_date->format('d/m/Y') }} (Próximo)</span>
                                                @else
                                                    <span class="badge bg-success">{{ $medicine->expiration_date->format('d/m/Y') }}</span>
                                                @endif
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($medicine->is_active)
                                                <span class="badge bg-success">Activo</span>
                                            @else
                                                <span class="badge bg-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('medicines.show', $medicine) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('medicines.edit', $medicine) }}" 
                                                   class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('medicines.destroy', $medicine) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('¿Está seguro de eliminar este medicamento?')"
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
                                        <td colspan="11" class="text-center">No hay medicamentos registrados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $medicines->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 