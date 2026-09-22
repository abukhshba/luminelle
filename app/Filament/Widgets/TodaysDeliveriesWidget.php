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
            ->heading("Today's Deliveries")
            ->query(
                fn (): Builder => Reservation::query()
                    ->with('customer')
                    ->whereDate('delivery_date', today())
                    ->whereNotIn('status', [ReservationStatus::Cancelled->value])
            )
            ->columns([
                TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->money('EGP'),
                TextColumn::make('status')
                    ->badge(),
            ]);
    }
}
