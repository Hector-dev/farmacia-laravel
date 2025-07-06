<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'code',
        'stock',
        'price',
        'supplier_id',
        'category_id',
        'expiration_date',
        'is_active'
    ];

    protected $casts = [
        'expiration_date' => 'date',
        'price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventoryMovements()
    {
        return $this->hasMany(InventoryMovement::class);
    }
}
