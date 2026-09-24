<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enums\ReservationStatus;
use App\Models\Reservation;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class UpcomingReservationsWidget extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('Upcoming Reservations'))
            ->description(__('Next 7 days — sorted by delivery date'))
            ->query(
                fn (): Builder => Reservation::query()
                    ->with('customer')
                    ->whereBetween('delivery_date', [today()->addDay(), today()->addDays(7)])
                    ->whereNotIn('status', [ReservationStatus::Cancelled->value])
                    ->orderBy('delivery_date')
            )
            ->columns([
                TextColumn::make('code')
                    ->label(__('Code'))
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->label(__('Customer'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('delivery_date')
                    ->label(__('Delivery Date'))
                    ->date()
                    ->color('info')
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->label(__('Total Amount'))
                    ->money('EGP')
                    ->color('success'),
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge(),
            ]);
    }
}
