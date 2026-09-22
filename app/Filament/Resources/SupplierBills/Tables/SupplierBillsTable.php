<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupplierBills\Tables;

use App\Enums\PaymentStatus;
use App\Models\SupplierBill;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SupplierBillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bill_number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('supplier.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->money('EGP')
                    ->sortable(),
                TextColumn::make('paid_amount')
                    ->label('Paid')
                    ->money('EGP')
                    ->getStateUsing(fn (SupplierBill $record) => $record->paidAmount()),
                TextColumn::make('remaining_amount')
                    ->label('Remaining')
                    ->money('EGP')
                    ->getStateUsing(fn (SupplierBill $record) => $record->remainingAmount()),
                TextColumn::make('payment_status')
                    ->label('Status')
                    ->badge()
                    ->getStateUsing(fn (SupplierBill $record) => $record->paymentStatus())
                    ->formatStateUsing(fn (PaymentStatus $state) => $state->getLabel())
                    ->color(fn (PaymentStatus $state) => $state->getColor()),
                TextColumn::make('bill_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('createdBy.name')
                    ->label('Created By'),
            ])
            ->filters([
                //
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
