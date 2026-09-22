<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum DressStatus: string implements HasColor, HasLabel
{
    case Available = 'available';
    case Reserved = 'reserved';
    case Rented = 'rented';
    case Maintenance = 'maintenance';
    case Inactive = 'inactive';

    public function getLabel(): string
    {
        return match ($this) {
            self::Available => 'Available',
            self::Reserved => 'Reserved',
            self::Rented => 'Rented',
            self::Maintenance => 'Maintenance',
            self::Inactive => 'Inactive',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Available => 'success',
            self::Reserved => 'warning',
            self::Rented => 'info',
            self::Maintenance => 'gray',
            self::Inactive => 'danger',
        };
    }
}
