<?php

namespace Database\Seeders;

use App\Models\InventoryMovement;
use App\Models\Medicine;
use App\Models\Warehouse;
use App\Models\Employee;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class InventoryMovementSeeder extends Seeder
{
    public function run(): void
    {
        $medicines = Medicine::all();
        $warehouses = Warehouse::all();
        $employees = Employee::all();
        $customers = Customer::all();

        $movements = [
            [
                'medicine_id' => $medicines->first()->id,
                'warehouse_id' => $warehouses->first()->id,
                'employee_id' => $employees->first()->id,
                'customer_id' => null,
                'type' => 'entry',
                'quantity' => 50,
                'notes' => 'Entrada inicial de stock',
            ],
            [
                'medicine_id' => $medicines->first()->id,
                'warehouse_id' => $warehouses->first()->id,
                'employee_id' => $employees->get(1)->id,
                'customer_id' => $customers->first()->id,
                'type' => 'exit',
                'quantity' => 5,
                'notes' => 'Venta a cliente',
            ],
            [
                'medicine_id' => $medicines->get(1)->id,
                'warehouse_id' => $warehouses->first()->id,
                'employee_id' => $employees->first()->id,
                'customer_id' => null,
                'type' => 'entry',
                'quantity' => 30,
                'notes' => 'Reposición de inventario',
            ],
            [
                'medicine_id' => $medicines->get(2)->id,
                'warehouse_id' => $warehouses->get(1)->id,
                'employee_id' => $employees->get(2)->id,
                'customer_id' => null,
                'type' => 'entry',
                'quantity' => 25,
                'notes' => 'Medicamento refrigerado',
            ],
            [
                'medicine_id' => $medicines->get(3)->id,
                'warehouse_id' => $warehouses->first()->id,
                'employee_id' => $employees->get(1)->id,
                'customer_id' => $customers->get(1)->id,
                'type' => 'exit',
                'quantity' => 10,
                'notes' => 'Venta de suplementos vitamínicos',
            ],
        ];

        foreach ($movements as $movement) {
            InventoryMovement::create($movement);
        }
    }
} 