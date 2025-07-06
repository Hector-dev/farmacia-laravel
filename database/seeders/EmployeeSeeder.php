<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            [
                'first_name' => 'Ana',
                'last_name' => 'Martínez',
                'email' => 'ana.martinez@farmacia.com',
                'phone' => '+34 600 111 222',
                'position' => 'Farmacéutica',
                'hire_date' => '2020-01-15',
                'salary' => 2500.00,
                'address' => 'Calle de la Paz 45, Madrid',
                'document_number' => '12345678A',
                'document_type' => 'DNI',
                'is_active' => true,
            ],
            [
                'first_name' => 'Luis',
                'last_name' => 'González',
                'email' => 'luis.gonzalez@farmacia.com',
                'phone' => '+34 600 333 444',
                'position' => 'Auxiliar de Farmacia',
                'hire_date' => '2021-03-20',
                'salary' => 1800.00,
                'address' => 'Avenida de América 67, Madrid',
                'document_number' => '87654321B',
                'document_type' => 'DNI',
                'is_active' => true,
            ],
            [
                'first_name' => 'Carmen',
                'last_name' => 'Rodríguez',
                'email' => 'carmen.rodriguez@farmacia.com',
                'phone' => '+34 600 555 666',
                'position' => 'Técnico de Farmacia',
                'hire_date' => '2019-11-10',
                'salary' => 2000.00,
                'address' => 'Calle Princesa 89, Madrid',
                'document_number' => '11223344C',
                'document_type' => 'DNI',
                'is_active' => true,
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
} 