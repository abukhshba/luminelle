<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentDirection;
use App\Enums\PaymentMethod;
use App\Enums\PaymentState;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

#[Fillable(['code', 'amount', 'date', 'payment_direction', 'payment_method', 'status', 'payment_category_id', 'customer_id', 'supplier_id', 'reservation_id', 'supplier_bill_id', 'notes', 'created_by'])]
class Payment extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity;

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'date' => 'date',
            'payment_direction' => PaymentDirection::class,
            'payment_method' => PaymentMethod::class,
            'status' => PaymentState::class,
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly(['amount', 'date', 'payment_direction', 'payment_method', 'reservation_id', 'supplier_bill_id']);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('receipts')->singleFile();
    }

    public function paymentCategory(): BelongsTo
    {
        return $this->belongsTo(PaymentCategory::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function supplierBill(): BelongsTo
    {
        return $this->belongsTo(SupplierBill::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function booted(): void
    {
        static::creating(function (Payment $payment) {
            if (empty($payment->code)) {
                $lastCode = static::max('id') ?? 0;
                $payment->code = 'PAY-'.str_pad((string) ($lastCode + 1), 5, '0', STR_PAD_LEFT);
            }
        });
    }
}
