<?php

declare(strict_types=1);

namespace App\Filament\Resources\Suppliers\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SupplierBillsRelationManager extends RelationManager
{
    protected static string $relationship = 'supplierBills';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('bill_number')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('bill_number')
            ->columns([
                TextColumn::make('bill_number'),
                TextColumn::make('total_amount')
                    ->money('EGP'),
                TextColumn::make('bill_date')
                    ->date(),
                TextColumn::make('shipping_fees')
                    ->money('EGP'),
            ])
            ->filters([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
