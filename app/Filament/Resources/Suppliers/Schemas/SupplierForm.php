<?php

declare(strict_types=1);

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('phone')
                    ->nullable(),
                TextInput::make('email')
                    ->email()
                    ->nullable(),
                Textarea::make('address')
                    ->nullable()
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->nullable()
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
