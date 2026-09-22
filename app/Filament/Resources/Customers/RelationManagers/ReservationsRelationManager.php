<?php

declare(strict_types=1);

namespace App\Filament\Resources\Customers\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReservationsRelationManager extends RelationManager
{
    protected static string $relationship = 'reservations';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                TextColumn::make('code'),
                TextColumn::make('delivery_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('return_date')
                    ->date(),
                TextColumn::make('total_amount')
                    ->money('EGP'),
                TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->toolbarActions([]);
    }
}
