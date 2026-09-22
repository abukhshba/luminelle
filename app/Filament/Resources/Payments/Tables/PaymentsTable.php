<?php

declare(strict_types=1);

namespace App\Filament\Resources\Payments\Tables;

use App\Enums\PaymentDirection;
use App\Enums\PaymentMethod;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('payment_direction')
                    ->badge(),
                TextColumn::make('paymentCategory.name')
                    ->label('Category'),
                TextColumn::make('amount')
                    ->money('EGP')
                    ->sortable(),
                TextColumn::make('payment_method'),
                TextColumn::make('customer.name'),
                TextColumn::make('supplier.name'),
                TextColumn::make('reservation.code'),
                TextColumn::make('supplierBill.bill_number')
                    ->label('Bill'),
                TextColumn::make('createdBy.name')
                    ->label('By'),
            ])
            ->filters([
                SelectFilter::make('payment_direction')
                    ->options(PaymentDirection::class),
                SelectFilter::make('payment_method')
                    ->options(PaymentMethod::class),
                SelectFilter::make('payment_category')
                    ->relationship('paymentCategory', 'name'),
                Filter::make('date')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('to'),
                    ])
                    ->query(fn ($query, array $data) => $query
                        ->when($data['from'] ?? null, fn ($q, $v) => $q->where('date', '>=', $v))
                        ->when($data['to'] ?? null, fn ($q, $v) => $q->where('date', '<=', $v))
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
