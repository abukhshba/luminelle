<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupplierBills\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SupplierBillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('supplier_id')
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('bill_number')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('total_amount')
                    ->numeric()
                    ->prefix('EGP')
                    ->required(),
                DatePicker::make('bill_date')
                    ->required(),
                DatePicker::make('delivery_date')
                    ->nullable(),
                TextInput::make('shipping_fees')
                    ->numeric()
                    ->prefix('EGP')
                    ->default(0),
                Textarea::make('notes')
                    ->nullable()
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('bill_file')
                    ->collection('bills')
                    ->columnSpanFull(),
                Hidden::make('created_by')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
