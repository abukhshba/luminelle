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
                    ->required(),
                TextInput::make('phone')
                    ->required(),
                TextInput::make('whatsapp')
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
            ]);
    }
}
