<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enums\PaymentDirection;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FinancialOverviewWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = today();
        $monthStart = today()->startOfMonth();

        $todayIncome = Payment::where('payment_direction', PaymentDirection::In)
            ->whereDate('date', $today)
            ->sum('amount');

        $todayExpenses = Payment::where('payment_direction', PaymentDirection::Out)
            ->whereDate('date', $today)
            ->sum('amount');

        $monthIncome = Payment::where('payment_direction', PaymentDirection::In)
            ->where('date', '>=', $monthStart)
            ->sum('amount');

        $monthExpenses = Payment::where('payment_direction', PaymentDirection::Out)
            ->where('date', '>=', $monthStart)
            ->sum('amount');

        return [
            Stat::make("Today's Income", 'EGP '.number_format($todayIncome, 2))
                ->color('success'),
            Stat::make("Today's Expenses", 'EGP '.number_format($todayExpenses, 2))
                ->color('danger'),
            Stat::make('Month Income', 'EGP '.number_format($monthIncome, 2))
                ->color('success'),
            Stat::make('Month Expenses', 'EGP '.number_format($monthExpenses, 2))
                ->color('danger'),
        ];
    }
}
