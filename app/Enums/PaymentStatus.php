<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatus: string implements HasColor, HasLabel
{
    case NotPaid = 'not_paid';
    case PartiallyPaid = 'partially_paid';
    case Paid = 'paid';

    public function getLabel(): string
    {
        return match ($this) {
            self::NotPaid => __('Not Paid'),
            self::PartiallyPaid => __('Partially Paid'),
            self::Paid => __('Paid'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::NotPaid => 'danger',
            self::PartiallyPaid => 'warning',
            self::Paid => 'success',
        };
    }
}
