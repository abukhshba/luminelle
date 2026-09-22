<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'address', 'phone', 'email', 'notes', 'is_active'])]
class Supplier extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function dresses(): HasMany
    {
        return $this->hasMany(Dress::class);
    }

    public function supplierBills(): HasMany
    {
        return $this->hasMany(SupplierBill::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
