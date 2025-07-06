<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\InventoryMovementController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas para medicamentos
Route::resource('medicines', MedicineController::class);

// Rutas para proveedores
Route::resource('suppliers', SupplierController::class);

// Rutas para categorías
Route::resource('categories', CategoryController::class);

// Rutas para empleados
Route::resource('employees', EmployeeController::class);

// Rutas para clientes
Route::resource('customers', CustomerController::class);

// Rutas para almacenes
Route::resource('warehouses', WarehouseController::class);

// Rutas para movimientos de inventario
Route::resource('inventory-movements', InventoryMovementController::class);
