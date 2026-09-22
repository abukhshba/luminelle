<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentMethod: string implements HasLabel
{
    case Cash = 'cash';
    case Visa = 'visa';
    case BankTransfer = 'bank_transfer';
    case Instapay = 'instapay';
    case Wallet = 'wallet';
    case Other = 'other';

    public function getLabel(): string
    {
        return match ($this) {
            self::Cash => 'Cash',
            self::Visa => 'Visa',
            self::BankTransfer => 'Bank Transfer',
            self::Instapay => 'Instapay',
            self::Wallet => 'Wallet',
            self::Other => 'Other',
        };
    }
}
