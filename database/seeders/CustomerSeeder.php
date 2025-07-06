<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'first_name' => 'María',
                'last_name' => 'López',
                'email' => 'maria.lopez@email.com',
                'phone' => '+34 600 777 888',
                'address' => 'Calle Gran Vía 123, Madrid',
                'document_number' => '22334455D',
                'document_type' => 'DNI',
                'birth_date' => '1985-05-15',
                'medical_history' => 'Alergia a penicilina',
                'allergies' => 'Penicilina, polen',
                'is_active' => true,
            ],
            [
                'first_name' => 'José',
                'last_name' => 'Fernández',
                'email' => 'jose.fernandez@email.com',
                'phone' => '+34 600 999 000',
                'address' => 'Calle Alcalá 456, Madrid',
                'document_number' => '33445566E',
                'document_type' => 'DNI',
                'birth_date' => '1978-12-03',
                'medical_history' => 'Hipertensión controlada',
                'allergies' => 'Ninguna conocida',
                'is_active' => true,
            ],
            [
                'first_name' => 'Isabel',
                'last_name' => 'Sánchez',
                'email' => 'isabel.sanchez@email.com',
                'phone' => '+34 600 111 333',
                'address' => 'Calle Serrano 789, Madrid',
                'document_number' => '44556677F',
                'document_type' => 'DNI',
                'birth_date' => '1992-08-22',
                'medical_history' => 'Diabetes tipo 2',
                'allergies' => 'Sulfamidas',
                'is_active' => true,
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
} 