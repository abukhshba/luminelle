<?php

declare(strict_types=1);

namespace App\Filament\Resources\Dresses\Tables;

use App\Enums\DressStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DressesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('images')
                    ->collection('images')
                    ->label(''),
                TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->sortable()
                    ->label('Category'),
                TextColumn::make('supplier.name')
                    ->sortable()
                    ->label('Supplier'),
                TextColumn::make('size'),
                TextColumn::make('color'),
                TextColumn::make('rental_price')
                    ->money('EGP')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name'),
                SelectFilter::make('supplier')
                    ->relationship('supplier', 'name'),
                SelectFilter::make('status')
                    ->options(DressStatus::class),
                Filter::make('size')
                    ->form([
                        TextInput::make('size'),
                    ])
                    ->query(fn (Builder $query, array $data) => $query->when(
                        $data['size'] ?? null,
                        fn (Builder $q, string $v) => $q->where('size', $v)
                    )),
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
