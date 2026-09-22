<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enums\DressStatus;
use App\Models\Dress;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DressStatusWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Available Dresses', Dress::where('status', DressStatus::Available)->count())
                ->color('success'),
            Stat::make('Reserved Dresses', Dress::where('status', DressStatus::Reserved)->count())
                ->color('warning'),
            Stat::make('Rented Dresses', Dress::where('status', DressStatus::Rented)->count())
                ->color('info'),
            Stat::make('In Maintenance', Dress::where('status', DressStatus::Maintenance)->count())
                ->color('gray'),
        ];
    }
}
