<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        $warehouses = [
            [
                'name' => 'Almacén Principal',
                'code' => 'ALM001',
                'address' => 'Calle de la Industria 100, Madrid',
                'phone' => '+34 91 444 5555',
                'manager_name' => 'Roberto Jiménez',
                'description' => 'Almacén principal para medicamentos de uso común',
                'capacity' => 10000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Almacén Refrigerado',
                'code' => 'ALM002',
                'address' => 'Calle de la Industria 102, Madrid',
                'phone' => '+34 91 444 5556',
                'manager_name' => 'Laura Torres',
                'description' => 'Almacén con control de temperatura para medicamentos termolábiles',
                'capacity' => 5000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Almacén de Controlado',
                'code' => 'ALM003',
                'address' => 'Calle de la Industria 104, Madrid',
                'phone' => '+34 91 444 5557',
                'manager_name' => 'Miguel Ángel Ruiz',
                'description' => 'Almacén de alta seguridad para medicamentos controlados',
                'capacity' => 2000.00,
                'is_active' => true,
            ],
        ];

        foreach ($warehouses as $warehouse) {
            Warehouse::create($warehouse);
        }
    }
} 