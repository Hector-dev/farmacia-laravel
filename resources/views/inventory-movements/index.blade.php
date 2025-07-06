@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Movimientos de Inventario</h1>
    <a href="{{ route('inventory-movements.create') }}" class="btn btn-primary">Nuevo Movimiento</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Medicina</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Razón</th>
                        <th>Número de Referencia</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movements as $movement)
                    <tr>
                        <td>{{ $movement->medicine->name }}</td>
                        <td>
                            <span class="badge {{ $movement->type === 'entrada' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($movement->type) }}
                            </span>
                        </td>
                        <td>{{ $movement->quantity }}</td>
                        <td>{{ $movement->reason }}</td>
                        <td>{{ $movement->reference_number }}</td>
                        <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('inventory-movements.show', $movement) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('inventory-movements.edit', $movement) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('inventory-movements.destroy', $movement) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $movements->links() }}
    </div>
</div>
@endsection 