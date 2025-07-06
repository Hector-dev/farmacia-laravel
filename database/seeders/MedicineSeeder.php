<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = Supplier::all();
        $categories = Category::all();

        $medicines = [
            [
                'name' => 'Paracetamol 500mg',
                'description' => 'Analgésico y antipirético para el alivio del dolor y la fiebre',
                'code' => 'PARA500',
                'stock' => 150,
                'price' => 5.50,
                'supplier_id' => $suppliers->first()->id,
                'category_id' => $categories->where('name', 'Analgésicos')->first()->id,
                'expiration_date' => '2026-12-31',
                'is_active' => true,
            ],
            [
                'name' => 'Ibuprofeno 600mg',
                'description' => 'Antiinflamatorio no esteroideo para dolor e inflamación',
                'code' => 'IBUP600',
                'stock' => 120,
                'price' => 7.20,
                'supplier_id' => $suppliers->first()->id,
                'category_id' => $categories->where('name', 'Antiinflamatorios')->first()->id,
                'expiration_date' => '2026-10-15',
                'is_active' => true,
            ],
            [
                'name' => 'Amoxicilina 500mg',
                'description' => 'Antibiótico de amplio espectro para infecciones bacterianas',
                'code' => 'AMOX500',
                'stock' => 80,
                'price' => 12.50,
                'supplier_id' => $suppliers->get(1)->id,
                'category_id' => $categories->where('name', 'Antibióticos')->first()->id,
                'expiration_date' => '2025-08-20',
                'is_active' => true,
            ],
            [
                'name' => 'Vitamina C 1000mg',
                'description' => 'Suplemento vitamínico para fortalecer el sistema inmune',
                'code' => 'VITC1000',
                'stock' => 200,
                'price' => 8.90,
                'supplier_id' => $suppliers->get(2)->id,
                'category_id' => $categories->where('name', 'Vitaminas y Suplementos')->first()->id,
                'expiration_date' => '2027-03-15',
                'is_active' => true,
            ],
            [
                'name' => 'Loratadina 10mg',
                'description' => 'Antihistamínico para el tratamiento de alergias',
                'code' => 'LORA10',
                'stock' => 95,
                'price' => 9.75,
                'supplier_id' => $suppliers->get(1)->id,
                'category_id' => $categories->where('name', 'Antihistamínicos')->first()->id,
                'expiration_date' => '2026-06-30',
                'is_active' => true,
            ],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
} 