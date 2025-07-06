<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = Warehouse::latest()->paginate(10);
        return view('warehouses.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:warehouses|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'manager_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'nullable|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        Warehouse::create($validated);

        return redirect()->route('warehouses.index')
            ->with('success', 'Almacén creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        return view('warehouses.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        return view('warehouses.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:warehouses,code,' . $warehouse->id . '|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'manager_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'nullable|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $warehouse->update($validated);

        return redirect()->route('warehouses.index')
            ->with('success', 'Almacén actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        // Verificar si tiene movimientos asociados
        if ($warehouse->inventoryMovements()->count() > 0) {
            return redirect()->route('warehouses.index')
                ->with('error', 'No se puede eliminar el almacén porque tiene movimientos de inventario asociados.');
        }

        $warehouse->delete();

        return redirect()->route('warehouses.index')
            ->with('success', 'Almacén eliminado exitosamente.');
    }
}
