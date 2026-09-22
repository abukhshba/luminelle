<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enums\ReservationStatus;
use App\Models\Reservation;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class TodaysReturnsWidget extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading("Today's Returns")
            ->query(
                fn (): Builder => Reservation::query()
                    ->with('customer')
                    ->whereDate('return_date', today())
                    ->whereNotIn('status', [ReservationStatus::Cancelled->value])
            )
            ->columns([
                TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('return_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
            ]);
    }
}
