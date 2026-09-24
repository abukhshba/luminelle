<?php

declare(strict_types=1);

namespace App\Filament\Resources\PaymentCategories\Schemas;

use App\Enums\PaymentDirection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PaymentCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->required()
                    ->maxLength(255),
                Select::make('direction')
                    ->label(__('Direction'))
                    ->options(PaymentDirection::class)
                    ->required(),
                Toggle::make('is_active')
                    ->label(__('Is Active'))
                    ->default(true),
            ]);
    }
}
