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
                Section::make(__('Basic Information'))
                    ->schema([
                        TextInput::make('code')
                            ->label(__('Code'))
                            ->disabled()
                            ->dehydrated(false)
                            ->hiddenOn('create')
                            ->placeholder(__('Auto-generated')),
                        TextInput::make('title')
                            ->label(__('Title'))
                            ->required(),
                        Select::make('category_id')
                            ->label(__('Category'))
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('supplier_id')
                            ->label(__('Supplier'))
                            ->relationship('supplier', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('status')
                            ->label(__('Status'))
                            ->options(DressStatus::class)
                            ->required()
                            ->default(DressStatus::Available),
                    ])
                    ->columns(2),

                Section::make(__('Physical Details'))
                    ->schema([
                        TextInput::make('size')
                            ->label(__('Size'))
                            ->nullable(),
                        TextInput::make('color')
                            ->label(__('Color'))
                            ->nullable(),
                        Textarea::make('description')
                            ->label(__('Description'))
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make(__('Pricing'))
                    ->schema([
                        TextInput::make('rental_price')
                            ->label(__('Rental Price'))
                            ->numeric()
                            ->prefix('EGP')
                            ->required(),
                        TextInput::make('purchase_price')
                            ->label(__('Purchase Price'))
                            ->numeric()
                            ->prefix('EGP')
                            ->nullable(),
                        TextInput::make('selling_price')
                            ->label(__('Selling Price'))
                            ->numeric()
                            ->prefix('EGP')
                            ->nullable(),
                    ])
                    ->columns(3),

                SpatieMediaLibraryFileUpload::make('images')
                    ->label(__('Images'))
                    ->collection('images')
                    ->multiple()
                    ->image()
                    ->columnSpanFull(),

                Textarea::make('notes')
                    ->label(__('Notes'))
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }
}
