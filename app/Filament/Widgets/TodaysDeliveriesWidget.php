<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enums\ReservationStatus;
use App\Models\Reservation;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class TodaysDeliveriesWidget extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading(__("Today's Deliveries"))
            ->description(__('Reservations being delivered today'))
            ->query(
                fn (): Builder => Reservation::query()
                    ->with('customer')
                    ->whereDate('delivery_date', today())
                    ->whereNotIn('status', [ReservationStatus::Cancelled->value])
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
