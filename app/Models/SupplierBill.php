<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

#[Fillable(['bill_number', 'supplier_id', 'total_amount', 'bill_date', 'delivery_date', 'shipping_fees', 'notes', 'created_by'])]
class SupplierBill extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity;

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'shipping_fees' => 'decimal:2',
            'bill_date' => 'date',
            'delivery_date' => 'date',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly(['bill_number', 'supplier_id', 'total_amount', 'bill_date', 'notes']);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('bills')->singleFile();
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function paidAmount(): float
    {
        return (float) $this->payments()->sum('amount');
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
}
