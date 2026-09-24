<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentState: string implements HasColor, HasLabel
{
    case Draft = 'draft';
    case Confirmed = 'confirmed';
    case Refunded = 'refunded';

    public function getLabel(): string
    {
        return match ($this) {
            self::Draft => __('Draft'),
            self::Confirmed => __('Confirmed'),
            self::Refunded => __('Refunded'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Draft => 'gray',
            self::Confirmed => 'success',
            self::Refunded => 'info',
        };
    }
}
