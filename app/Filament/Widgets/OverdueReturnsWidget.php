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
            ->heading(__('Overdue Returns'))
            ->description(__('Delivered reservations past their return date'))
            ->query(
                fn (): Builder => Reservation::query()
                    ->with('customer')
                    ->where('return_date', '<', today())
                    ->where('status', ReservationStatus::Delivered->value)
                    ->orderBy('return_date')
            )
            ->columns([
                TextColumn::make('code')
                    ->label(__('Code'))
                    ->badge()
                    ->color('danger')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->label(__('Customer'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('return_date')
                    ->label(__('Return Date'))
                    ->date()
                    ->color('danger')
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->label(__('Total Amount'))
                    ->money('EGP')
                    ->color('success'),
            ]);
    }
}
