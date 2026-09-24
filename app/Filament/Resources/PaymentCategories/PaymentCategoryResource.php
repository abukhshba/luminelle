<?php

declare(strict_types=1);

namespace App\Filament\Resources\PaymentCategories;

use App\Filament\Resources\PaymentCategories\Pages\CreatePaymentCategory;
use App\Filament\Resources\PaymentCategories\Pages\EditPaymentCategory;
use App\Filament\Resources\PaymentCategories\Pages\ListPaymentCategories;
use App\Filament\Resources\PaymentCategories\Schemas\PaymentCategoryForm;
use App\Filament\Resources\PaymentCategories\Tables\PaymentCategoriesTable;
use App\Models\PaymentCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PaymentCategoryResource extends Resource
{
    protected static ?string $model = PaymentCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAdjustmentsHorizontal;

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return __('Finance');
    }

    public static function getModelLabel(): string
    {
        return __('Payment Category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Payment Categories');
    }

    public static function form(Schema $schema): Schema
    {
        return PaymentCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PaymentCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPaymentCategories::route('/'),
            'create' => CreatePaymentCategory::route('/create'),
            'edit' => EditPaymentCategory::route('/{record}/edit'),
        ];
    }
}
