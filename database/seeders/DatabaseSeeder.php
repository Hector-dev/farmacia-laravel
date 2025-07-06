<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SupplierSeeder::class,
            CategorySeeder::class,
            EmployeeSeeder::class,
            CustomerSeeder::class,
            WarehouseSeeder::class,
            MedicineSeeder::class,
            InventoryMovementSeeder::class,
        ]);
    }
}
