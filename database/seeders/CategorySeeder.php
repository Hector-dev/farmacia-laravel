<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Analgésicos',
                'code' => 'ANALG',
                'description' => 'Medicamentos para el alivio del dolor',
                'is_active' => true,
            ],
            [
                'name' => 'Antibióticos',
                'code' => 'ANTIB',
                'description' => 'Medicamentos para tratar infecciones bacterianas',
                'is_active' => true,
            ],
            [
                'name' => 'Antiinflamatorios',
                'code' => 'ANTIF',
                'description' => 'Medicamentos para reducir la inflamación',
                'is_active' => true,
            ],
            [
                'name' => 'Antihistamínicos',
                'code' => 'ANTIH',
                'description' => 'Medicamentos para tratar alergias',
                'is_active' => true,
            ],
            [
                'name' => 'Vitaminas y Suplementos',
                'code' => 'VITAM',
                'description' => 'Suplementos vitamínicos y minerales',
                'is_active' => true,
            ],
            [
                'name' => 'Medicamentos Cardiovasculares',
                'code' => 'CARD',
                'description' => 'Medicamentos para el sistema cardiovascular',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 