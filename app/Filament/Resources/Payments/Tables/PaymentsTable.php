<?php

declare(strict_types=1);

namespace App\Filament\Resources\Payments\Tables;

use App\Enums\PaymentDirection;
use App\Enums\PaymentMethod;
use App\Enums\PaymentState;
use App\Models\Payment;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;
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
                TextColumn::make('status')
                    ->badge()
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
                SelectFilter::make('status')
                    ->options(PaymentState::class),
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
                Action::make('changeStatus')
                    ->label('Change Status')
                    ->icon(Heroicon::OutlinedArrowPath)
                    ->color('gray')
                    ->form([
                        Select::make('status')
                            ->options(PaymentState::class)
                            ->required(),
                    ])
                    ->fillForm(fn (Payment $record): array => ['status' => $record->status->value])
                    ->action(fn (Payment $record, array $data) => $record->update(['status' => $data['status']])),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
