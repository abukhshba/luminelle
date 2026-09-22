<?php

declare(strict_types=1);

namespace App\Filament\Resources\Dresses\Schemas;

use App\Enums\DressStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DressForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('code')
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('title')
                            ->required(),
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('supplier_id')
                            ->relationship('supplier', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('status')
                            ->options(DressStatus::class)
                            ->required()
                            ->default(DressStatus::Available),
                    ])
                    ->columns(2),

                Section::make('Physical Details')
                    ->schema([
                        TextInput::make('size')
                            ->nullable(),
                        TextInput::make('color')
                            ->nullable(),
                        Textarea::make('description')
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Pricing')
                    ->schema([
                        TextInput::make('rental_price')
                            ->numeric()
                            ->prefix('EGP')
                            ->required(),
                        TextInput::make('purchase_price')
                            ->numeric()
                            ->prefix('EGP')
                            ->nullable(),
                        TextInput::make('selling_price')
                            ->numeric()
                            ->prefix('EGP')
                            ->nullable(),
                    ])
                    ->columns(3),

                SpatieMediaLibraryFileUpload::make('images')
                    ->collection('images')
                    ->multiple()
                    ->image()
                    ->columnSpanFull(),

                Textarea::make('notes')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }
}
