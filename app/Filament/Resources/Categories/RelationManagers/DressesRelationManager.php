<?php

declare(strict_types=1);

namespace App\Filament\Resources\Categories\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DressesRelationManager extends RelationManager
{
    protected static string $relationship = 'dresses';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('code'),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('rental_price')
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
