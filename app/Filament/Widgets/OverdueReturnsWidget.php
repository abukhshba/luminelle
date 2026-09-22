<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enums\ReservationStatus;
use App\Models\Reservation;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class OverdueReturnsWidget extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Overdue Returns')
            ->description('Delivered reservations past their return date')
            ->query(
                fn (): Builder => Reservation::query()
                    ->with('customer')
                    ->where('return_date', '<', today())
                    ->where('status', ReservationStatus::Delivered->value)
                    ->orderBy('return_date')
            )
            ->columns([
                TextColumn::make('code')
                    ->badge()
                    ->color('danger')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('return_date')
                    ->date()
                    ->color('danger')
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->money('EGP')
                    ->color('success'),
            ]);
    }
}
