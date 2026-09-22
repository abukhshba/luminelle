<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentDirection: string implements HasColor, HasLabel
{
    case In = 'in';
    case Out = 'out';

    public function getLabel(): string
    {
        return match ($this) {
            self::In => 'Income',
            self::Out => 'Expense',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::In => 'success',
            self::Out => 'danger',
        };
    }
}
