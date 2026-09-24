<?php

declare(strict_types=1);

namespace App\Filament\Resources\Dresses;

use App\Filament\Resources\Dresses\Pages\CreateDress;
use App\Filament\Resources\Dresses\Pages\EditDress;
use App\Filament\Resources\Dresses\Pages\ListDresses;
use App\Filament\Resources\Dresses\Schemas\DressForm;
use App\Filament\Resources\Dresses\Tables\DressesTable;
use App\Models\Dress;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DressResource extends Resource
{
    protected static ?string $model = Dress::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSwatch;

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return __('Catalog');
    }

    public static function getModelLabel(): string
    {
        return __('Dress');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Dresses');
    }

    public static function form(Schema $schema): Schema
    {
        return DressForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DressesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDresses::route('/'),
            'create' => CreateDress::route('/create'),
            'edit' => EditDress::route('/{record}/edit'),
        ];
    }
}
