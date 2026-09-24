<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupplierBills;

use App\Filament\Resources\SupplierBills\Pages\CreateSupplierBill;
use App\Filament\Resources\SupplierBills\Pages\EditSupplierBill;
use App\Filament\Resources\SupplierBills\Pages\ListSupplierBills;
use App\Filament\Resources\SupplierBills\Schemas\SupplierBillForm;
use App\Filament\Resources\SupplierBills\Tables\SupplierBillsTable;
use App\Models\SupplierBill;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SupplierBillResource extends Resource
{
    protected static ?string $model = SupplierBill::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return __('Finance');
    }

    public static function getModelLabel(): string
    {
        return __('Supplier Bill');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Supplier Bills');
    }

    public static function form(Schema $schema): Schema
    {
        return SupplierBillForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SupplierBillsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PaymentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSupplierBills::route('/'),
            'create' => CreateSupplierBill::route('/create'),
            'edit' => EditSupplierBill::route('/{record}/edit'),
        ];
    }
}
