<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'address',
        'phone',
        'manager_name',
        'description',
        'capacity',
        'is_active'
    ];

    protected $casts = [
        'capacity' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function inventoryMovements()
    {
        return $this->hasMany(InventoryMovement::class);
    }
}
