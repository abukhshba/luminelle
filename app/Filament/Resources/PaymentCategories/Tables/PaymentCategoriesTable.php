<?php

declare(strict_types=1);

namespace App\Filament\Resources\PaymentCategories\Tables;

use App\Enums\PaymentDirection;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PaymentCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('direction')
                    ->badge()
                    ->formatStateUsing(fn (PaymentDirection $state) => $state->getLabel())
                    ->color(fn (PaymentDirection $state) => $state->getColor()),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('payments_count')
                    ->counts('payments')
                    ->label('Payments'),
            ])
            ->filters([
                SelectFilter::make('direction')
                    ->options(PaymentDirection::class),
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
