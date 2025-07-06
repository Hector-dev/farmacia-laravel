<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'document_number' => 'required|string|unique:customers|max:255',
            'document_type' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'document_number' => 'required|string|unique:customers,document_number,' . $customer->id . '|max:255',
            'document_type' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        // Verificar si tiene movimientos asociados
        if ($customer->inventoryMovements()->count() > 0) {
            return redirect()->route('customers.index')
                ->with('error', 'No se puede eliminar el cliente porque tiene movimientos de inventario asociados.');
        }

        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Cliente eliminado exitosamente.');
    }
}
