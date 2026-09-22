<?php

declare(strict_types=1);

namespace App\Filament\Resources\Reservations\Tables;

use App\Enums\PaymentStatus;
use App\Enums\ReservationStatus;
use App\Models\Reservation;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ReservationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('delivery_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('return_date')
                    ->date(),
                TextColumn::make('total_amount')
                    ->money('EGP'),
                TextColumn::make('paid_amount')
                    ->money('EGP')
                    ->label('Paid')
                    ->getStateUsing(fn (Reservation $record) => $record->paidAmount()),
                TextColumn::make('remaining')
                    ->money('EGP')
                    ->label('Remaining')
                    ->getStateUsing(fn (Reservation $record) => $record->remainingAmount()),
                TextColumn::make('payment_status')
                    ->badge()
                    ->label('Payment')
                    ->getStateUsing(fn (Reservation $record) => $record->paymentStatus())
                    ->formatStateUsing(fn (PaymentStatus $state) => $state->getLabel())
                    ->color(fn (PaymentStatus $state) => $state->getColor()),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('createdBy.name')
                    ->label('Created By'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(ReservationStatus::class),
                Filter::make('delivery_date')
                    ->form([
                        DatePicker::make('delivery_from'),
                        DatePicker::make('delivery_to'),
                    ])
                    ->query(fn ($query, array $data) => $query
                        ->when($data['delivery_from'] ?? null, fn ($q, $v) => $q->where('delivery_date', '>=', $v))
                        ->when($data['delivery_to'] ?? null, fn ($q, $v) => $q->where('delivery_date', '<=', $v))
                    ),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
