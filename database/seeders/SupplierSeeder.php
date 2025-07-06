<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Farmacéutica Nacional S.A.',
                'contact_name' => 'Juan Pérez',
                'email' => 'contacto@farmaceuticanacional.com',
                'phone' => '+34 91 123 4567',
                'address' => 'Calle Mayor 123, Madrid',
                'tax_id' => 'B12345678',
                'notes' => 'Proveedor principal de medicamentos genéricos',
                'is_active' => true,
            ],
            [
                'name' => 'Medicamentos Express',
                'contact_name' => 'María García',
                'email' => 'ventas@medicamentosexpress.com',
                'phone' => '+34 93 987 6543',
                'address' => 'Avenida Diagonal 456, Barcelona',
                'tax_id' => 'B87654321',
                'notes' => 'Especialistas en medicamentos de alta demanda',
                'is_active' => true,
            ],
            [
                'name' => 'Distribuidora Farmacéutica Valencia',
                'contact_name' => 'Carlos López',
                'email' => 'info@dfvalencia.com',
                'phone' => '+34 96 555 1234',
                'address' => 'Carrer de Colón 789, Valencia',
                'tax_id' => 'B11223344',
                'notes' => 'Cobertura regional en Valencia',
                'is_active' => true,
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
} 