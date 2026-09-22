<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentDirection;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'direction', 'is_active'])]
class PaymentCategory extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'direction' => PaymentDirection::class,
            'is_active' => 'boolean',
        ];
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
