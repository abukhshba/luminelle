<?php

declare(strict_types=1);

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerForm
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
                    ->required(),
                TextInput::make('whatsapp')
                    ->label(__('WhatsApp'))
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
            ]);
    }
}
