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
            self::Cash => __('Cash'),
            self::Visa => __('Visa'),
            self::BankTransfer => __('Bank Transfer'),
            self::Instapay => __('Instapay'),
            self::Wallet => __('Wallet'),
            self::Other => __('Other'),
        };
    }
}
