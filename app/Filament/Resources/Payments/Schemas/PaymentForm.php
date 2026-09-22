<?php

declare(strict_types=1);

namespace App\Filament\Resources\Payments\Schemas;

use App\Enums\PaymentDirection;
use App\Enums\PaymentMethod;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Payment Details')
                    ->schema([
                        TextInput::make('code')
                            ->disabled()
                            ->dehydrated(false)
                            ->hiddenOn('create'),
                        Select::make('payment_direction')
                            ->options(PaymentDirection::class)
                            ->required()
                            ->live(),
                        Select::make('payment_category_id')
                            ->relationship(
                                'paymentCategory',
                                'name',
                                fn ($query, Get $get) => $query
                                    ->when(
                                        $get('payment_direction'),
                                        fn ($q, $dir) => $q->where('direction', $dir)
                                    )
                                    ->where('is_active', true)
                            )
                            ->searchable()
                            ->nullable(),
                        TextInput::make('amount')
                            ->numeric()
                            ->prefix('EGP')
                            ->required(),
                        DatePicker::make('date')
                            ->required()
                            ->default(today()),
                        Select::make('payment_method')
                            ->options(PaymentMethod::class)
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Link to Entity (optional)')
                    ->schema([
                        Select::make('reservation_id')
                            ->relationship('reservation', 'code')
                            ->searchable()
                            ->nullable(),
                        Select::make('supplier_bill_id')
                            ->relationship('supplierBill', 'bill_number')
                            ->searchable()
                            ->nullable(),
                        Select::make('customer_id')
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->nullable(),
                        Select::make('supplier_id')
                            ->relationship('supplier', 'name')
                            ->searchable()
                            ->nullable(),
                    ])
                    ->columns(2),

                SpatieMediaLibraryFileUpload::make('receipt')
                    ->collection('receipts')
                    ->columnSpanFull(),

                Textarea::make('notes')
                    ->nullable()
                    ->columnSpanFull(),

                Hidden::make('created_by')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
