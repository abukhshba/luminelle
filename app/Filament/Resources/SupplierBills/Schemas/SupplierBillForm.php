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
                    ->label(__('Supplier'))
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('bill_number')
                    ->label(__('Bill Number'))
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('total_amount')
                    ->label(__('Total Amount'))
                    ->numeric()
                    ->prefix('EGP')
                    ->required(),
                DatePicker::make('bill_date')
                    ->label(__('Bill Date'))
                    ->required(),
                DatePicker::make('delivery_date')
                    ->label(__('Delivery Date'))
                    ->nullable(),
                TextInput::make('shipping_fees')
                    ->label(__('Shipping Fees'))
                    ->numeric()
                    ->prefix('EGP')
                    ->default(0),
                Textarea::make('notes')
                    ->label(__('Notes'))
                    ->nullable()
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('bill_file')
                    ->label(__('Bill File'))
                    ->collection('bills')
                    ->columnSpanFull(),
                Hidden::make('created_by')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
