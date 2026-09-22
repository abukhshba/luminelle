<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\DressStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

#[Fillable(['code', 'title', 'description', 'supplier_id', 'category_id', 'size', 'color', 'purchase_price', 'rental_price', 'selling_price', 'status', 'notes'])]
class Dress extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity;

    protected function casts(): array
    {
        return [
            'status' => DressStatus::class,
            'purchase_price' => 'decimal:2',
            'rental_price' => 'decimal:2',
            'selling_price' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Dress $dress): void {
            if (empty($dress->code)) {
                $lastId = static::max('id') ?? 0;
                $dress->code = 'DRS-'.str_pad((string) ($lastId + 1), 5, '0', STR_PAD_LEFT);
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly(['status', 'code', 'title']);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function reservationItems(): HasMany
    {
        return $this->hasMany(ReservationItem::class);
    }
}
