<?php

namespace App\Http\Controllers;

use App\Models\InventoryMovement;
use App\Models\Medicine;
use App\Models\Warehouse;
use App\Models\Employee;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movements = InventoryMovement::with(['medicine', 'warehouse', 'employee', 'customer'])
            ->latest()
            ->paginate(10);
        return view('inventory-movements.index', compact('movements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicines = Medicine::where('is_active', true)->get();
        $warehouses = Warehouse::where('is_active', true)->get();
        $employees = Employee::where('is_active', true)->get();
        $customers = Customer::where('is_active', true)->get();
        
        return view('inventory-movements.create', compact('medicines', 'warehouses', 'employees', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'employee_id' => 'required|exists:employees,id',
            'customer_id' => 'nullable|exists:customers,id',
            'type' => 'required|in:entry,exit',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        // Verificar stock disponible para salidas
        if ($validated['type'] === 'exit') {
            $medicine = Medicine::find($validated['medicine_id']);
            if ($medicine->stock < $validated['quantity']) {
                return back()->withErrors(['quantity' => 'Stock insuficiente. Stock disponible: ' . $medicine->stock]);
            }
        }

        DB::transaction(function () use ($validated) {
            // Crear el movimiento
            InventoryMovement::create($validated);

            // Actualizar el stock del medicamento
            $medicine = Medicine::find($validated['medicine_id']);
            if ($validated['type'] === 'entry') {
                $medicine->increment('stock', $validated['quantity']);
            } else {
                $medicine->decrement('stock', $validated['quantity']);
            }
        });

        return redirect()->route('inventory-movements.index')
            ->with('success', 'Movimiento de inventario registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryMovement $inventoryMovement)
    {
        $inventoryMovement->load(['medicine', 'warehouse', 'employee', 'customer']);
        return view('inventory-movements.show', compact('inventoryMovement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryMovement $inventoryMovement)
    {
        $medicines = Medicine::where('is_active', true)->get();
        $warehouses = Warehouse::where('is_active', true)->get();
        $employees = Employee::where('is_active', true)->get();
        $customers = Customer::where('is_active', true)->get();
        
        return view('inventory-movements.edit', compact('inventoryMovement', 'medicines', 'warehouses', 'employees', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InventoryMovement $inventoryMovement)
    {
        $validated = $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'employee_id' => 'required|exists:employees,id',
            'customer_id' => 'nullable|exists:customers,id',
            'type' => 'required|in:entry,exit',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        // Verificar stock disponible para salidas
        if ($validated['type'] === 'exit') {
            $medicine = Medicine::find($validated['medicine_id']);
            $currentStock = $medicine->stock;
            
            // Si es el mismo medicamento, ajustar el stock
            if ($inventoryMovement->medicine_id == $validated['medicine_id']) {
                if ($inventoryMovement->type === 'entry') {
                    $currentStock -= $inventoryMovement->quantity;
                } else {
                    $currentStock += $inventoryMovement->quantity;
                }
            }
            
            if ($currentStock < $validated['quantity']) {
                return back()->withErrors(['quantity' => 'Stock insuficiente. Stock disponible: ' . $currentStock]);
            }
        }

        DB::transaction(function () use ($validated, $inventoryMovement) {
            // Revertir el movimiento anterior
            $medicine = Medicine::find($inventoryMovement->medicine_id);
            if ($inventoryMovement->type === 'entry') {
                $medicine->decrement('stock', $inventoryMovement->quantity);
            } else {
                $medicine->increment('stock', $inventoryMovement->quantity);
            }

            // Actualizar el movimiento
            $inventoryMovement->update($validated);

            // Aplicar el nuevo movimiento
            $newMedicine = Medicine::find($validated['medicine_id']);
            if ($validated['type'] === 'entry') {
                $newMedicine->increment('stock', $validated['quantity']);
            } else {
                $newMedicine->decrement('stock', $validated['quantity']);
            }
        });

        return redirect()->route('inventory-movements.index')
            ->with('success', 'Movimiento de inventario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryMovement $inventoryMovement)
    {
        DB::transaction(function () use ($inventoryMovement) {
            // Revertir el movimiento
            $medicine = Medicine::find($inventoryMovement->medicine_id);
            if ($inventoryMovement->type === 'entry') {
                $medicine->decrement('stock', $inventoryMovement->quantity);
            } else {
                $medicine->increment('stock', $inventoryMovement->quantity);
            }

            // Eliminar el movimiento
            $inventoryMovement->delete();
        });

        return redirect()->route('inventory-movements.index')
            ->with('success', 'Movimiento de inventario eliminado exitosamente.');
    }
}
