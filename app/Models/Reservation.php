<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\DiscountType;
use App\Enums\PaymentDirection;
use App\Enums\PaymentStatus;
use App\Enums\ReservationStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

#[Fillable(['code', 'customer_id', 'reservation_date', 'delivery_date', 'return_date', 'subtotal', 'discount_type', 'discount_value', 'total_amount', 'insurance_amount', 'status', 'notes', 'created_by'])]
class Reservation extends Model
{
    use HasFactory, LogsActivity;

    protected function casts(): array
    {
        return [
            'status' => ReservationStatus::class,
            'discount_type' => DiscountType::class,
            'subtotal' => 'decimal:2',
            'discount_value' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'insurance_amount' => 'decimal:2',
            'reservation_date' => 'date',
            'delivery_date' => 'date',
            'return_date' => 'date',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly(['status', 'customer_id', 'total_amount', 'delivery_date', 'return_date']);
    }

    protected static function booted(): void
    {
        static::creating(function (Reservation $reservation) {
            if (empty($reservation->code)) {
                $lastId = static::max('id') ?? 0;
                $reservation->code = 'RES-'.str_pad((string) ($lastId + 1), 5, '0', STR_PAD_LEFT);
            }
        });
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(ReservationItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function rentalPayments(): HasMany
    {
        return $this->hasMany(Payment::class)
            ->where('payment_direction', PaymentDirection::In)
            ->whereHas('paymentCategory', fn ($q) => $q->where('name', 'Reservation Payment'));
    }

    public function paidAmount(): float
    {
        return (float) $this->rentalPayments()->sum('amount');
    }

    public function remainingAmount(): float
    {
        return (float) $this->total_amount - $this->paidAmount();
    }

    public function paymentStatus(): PaymentStatus
    {
        $paid = $this->paidAmount();
        $total = (float) $this->total_amount;

        if ($paid <= 0) {
            return PaymentStatus::NotPaid;
        }

        if ($paid >= $total) {
            return PaymentStatus::Paid;
        }

        return PaymentStatus::PartiallyPaid;
    }

    public function insuranceCollected(): float
    {
        return (float) $this->payments()
            ->where('payment_direction', PaymentDirection::In)
            ->whereHas('paymentCategory', fn ($q) => $q->where('name', 'Insurance Deposit'))
            ->sum('amount');
    }

    public function insuranceRefunded(): float
    {
        return (float) $this->payments()
            ->where('payment_direction', PaymentDirection::Out)
            ->whereHas('paymentCategory', fn ($q) => $q->where('name', 'Insurance Refund'))
            ->sum('amount');
    }

    public function insuranceBalance(): float
    {
        return $this->insuranceCollected() - $this->insuranceRefunded();
    }

    public static function calculateTotal(float $subtotal, ?DiscountType $discountType, float $discountValue): float
    {
        $total = match ($discountType) {
            DiscountType::Fixed => $subtotal - $discountValue,
            DiscountType::Percentage => $subtotal * (1 - $discountValue / 100),
            null => $subtotal,
        };

        return max(0.0, $total);
    }
}
