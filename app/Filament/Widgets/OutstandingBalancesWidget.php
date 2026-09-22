<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enums\ReservationStatus;
use App\Models\Reservation;
use App\Models\SupplierBill;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OutstandingBalancesWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $unpaidBills = SupplierBill::with('payments')->get()
            ->sum(fn (SupplierBill $bill) => $bill->remainingAmount());

        $unpaidReservations = Reservation::with(['payments.paymentCategory'])
            ->whereNotIn('status', [ReservationStatus::Completed->value, ReservationStatus::Cancelled->value])
            ->get()
            ->sum(fn (Reservation $reservation) => $reservation->remainingAmount());

        return [
            Stat::make('Outstanding Supplier Bills', 'EGP '.number_format($unpaidBills, 2))
                ->color('warning'),
            Stat::make('Outstanding Reservation Balances', 'EGP '.number_format($unpaidReservations, 2))
                ->color('warning'),
        ];
    }
}
