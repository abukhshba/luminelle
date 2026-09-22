<?php

declare(strict_types=1);

namespace App\Filament\Resources\Categories\Tables;

use App\Models\Category;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug'),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('dresses_count')
                    ->counts('dresses')
                    ->label('Dresses'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('toggleActive')
                    ->icon(fn (Category $record) => $record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->action(fn (Category $record) => $record->update(['is_active' => ! $record->is_active])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
