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
                    ->label(__('Name'))
                    ->required(),
                TextInput::make('phone')
                    ->label(__('Phone'))
                    ->nullable(),
                TextInput::make('email')
                    ->label(__('Email'))
                    ->email()
                    ->nullable(),
                Textarea::make('address')
                    ->label(__('Address'))
                    ->nullable()
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->label(__('Notes'))
                    ->nullable()
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label(__('Is Active'))
                    ->default(true),
            ]);
    }
}
