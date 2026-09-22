<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ReservationStatus: string implements HasColor, HasLabel
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Delivered = 'delivered';
    case Returned = 'returned';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Confirmed => 'Confirmed',
            self::Delivered => 'Delivered',
            self::Returned => 'Returned',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Pending => 'gray',
            self::Confirmed => 'info',
            self::Delivered => 'warning',
            self::Returned => 'success',
            self::Completed => 'success',
            self::Cancelled => 'danger',
        };
    }
}
