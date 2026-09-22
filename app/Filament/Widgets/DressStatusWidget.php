<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enums\DressStatus;
use App\Models\Dress;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DressStatusWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total = Dress::count();

        return [
            Stat::make('Available', Dress::where('status', DressStatus::Available)->count())
                ->icon(Heroicon::OutlinedCheckCircle)
                ->description('Ready to rent')
                ->descriptionColor('success')
                ->color('success'),

            Stat::make('Reserved', Dress::where('status', DressStatus::Reserved)->count())
                ->icon(Heroicon::OutlinedCalendarDays)
                ->description('Booked, not yet delivered')
                ->descriptionColor('warning')
                ->color('warning'),

            Stat::make('Rented', Dress::where('status', DressStatus::Rented)->count())
                ->icon(Heroicon::OutlinedSwatch)
                ->description('Currently with customers')
                ->descriptionColor('info')
                ->color('info'),

            Stat::make('Maintenance', Dress::where('status', DressStatus::Maintenance)->count())
                ->icon(Heroicon::OutlinedWrenchScrewdriver)
                ->description('Out of service')
                ->descriptionColor('gray')
                ->color('gray'),
        ];
    }
}
