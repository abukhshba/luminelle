<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enums\PaymentDirection;
use App\Enums\PaymentState;
use App\Models\Payment;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FinancialOverviewWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = today();
        $monthStart = today()->startOfMonth();

        $todayIncome = Payment::where('payment_direction', PaymentDirection::In)
            ->where('status', PaymentState::Confirmed)
            ->whereDate('date', $today)
            ->sum('amount');

        $todayExpenses = Payment::where('payment_direction', PaymentDirection::Out)
            ->where('status', PaymentState::Confirmed)
            ->whereDate('date', $today)
            ->sum('amount');

        $monthIncome = Payment::where('payment_direction', PaymentDirection::In)
            ->where('status', PaymentState::Confirmed)
            ->where('date', '>=', $monthStart)
            ->sum('amount');

        $monthExpenses = Payment::where('payment_direction', PaymentDirection::Out)
            ->where('status', PaymentState::Confirmed)
            ->where('date', '>=', $monthStart)
            ->sum('amount');

        return [
            Stat::make(__("Today's Income"), 'EGP '.number_format((float) $todayIncome, 2))
                ->icon(Heroicon::OutlinedArrowTrendingUp)
                ->description(__('Cash in today'))
                ->descriptionIcon(Heroicon::ArrowUp)
                ->descriptionColor('success')
                ->color('success'),

            Stat::make(__("Today's Expenses"), 'EGP '.number_format((float) $todayExpenses, 2))
                ->icon(Heroicon::OutlinedArrowTrendingDown)
                ->description(__('Cash out today'))
                ->descriptionIcon(Heroicon::ArrowDown)
                ->descriptionColor('danger')
                ->color('danger'),

            Stat::make(__('Month Income'), 'EGP '.number_format((float) $monthIncome, 2))
                ->icon(Heroicon::OutlinedBanknotes)
                ->description(__('Total in — :month', ['month' => today()->translatedFormat('F')]))
                ->descriptionColor('success')
                ->color('success'),

            Stat::make(__('Month Expenses'), 'EGP '.number_format((float) $monthExpenses, 2))
                ->icon(Heroicon::OutlinedReceiptPercent)
                ->description(__('Total out — :month', ['month' => today()->translatedFormat('F')]))
                ->descriptionColor('danger')
                ->color('danger'),
        ];
    }
}
