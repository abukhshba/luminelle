<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['reservation_id', 'dress_id', 'price', 'discount', 'total', 'notes'])]
class ReservationItem extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'discount' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        $recalculate = function (ReservationItem $item): void {
            $reservation = $item->reservation;
            if ($reservation === null) {
                return;
            }

            $subtotal = (float) $reservation->items()->sum('total');
            $total = Reservation::calculateTotal(
                $subtotal,
                $reservation->discount_type,
                (float) $reservation->discount_value
            );

            $reservation->updateQuietly([
                'subtotal' => $subtotal,
                'total_amount' => $total,
            ]);
        };

        static::saved($recalculate);
        static::deleted($recalculate);
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function dress(): BelongsTo
    {
        return $this->belongsTo(Dress::class);
    }
}
