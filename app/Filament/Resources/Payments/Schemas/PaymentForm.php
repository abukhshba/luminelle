<?php

declare(strict_types=1);

namespace App\Filament\Resources\Payments\Schemas;

use App\Enums\PaymentDirection;
use App\Enums\PaymentMethod;
use App\Enums\PaymentState;
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
                Section::make(__('Payment Details'))
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('code')
                            ->label(__('Code'))
                            ->disabled()
                            ->dehydrated(false)
                            ->hiddenOn('create'),
                        Select::make('status')
                            ->label(__('Status'))
                            ->options(PaymentState::class)
                            ->default(PaymentState::Draft->value)
                            ->required(),
                        Select::make('payment_direction')
                            ->label(__('Payment Direction'))
                            ->options(PaymentDirection::class)
                            ->required()
                            ->live(),
                        Select::make('payment_category_id')
                            ->label(__('Payment Category'))
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
                            ->label(__('Amount'))
                            ->numeric()
                            ->prefix('EGP')
                            ->required(),
                        DatePicker::make('date')
                            ->label(__('Date'))
                            ->required()
                            ->default(today()),
                        Select::make('payment_method')
                            ->label(__('Payment Method'))
                            ->options(PaymentMethod::class)
                            ->required(),
                    ])
                    ->columns(2),

                Section::make(__('Link to Entity (optional)'))
                    ->columnSpanFull()
                    ->schema([
                        Select::make('reservation_id')
                            ->label(__('Reservation'))
                            ->relationship('reservation', 'code')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('supplier_bill_id')
                            ->label(__('Supplier Bill'))
                            ->relationship('supplierBill', 'bill_number')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('customer_id')
                            ->label(__('Customer'))
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('supplier_id')
                            ->label(__('Supplier'))
                            ->relationship('supplier', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])
                    ->columns(2),

                SpatieMediaLibraryFileUpload::make('receipt')
                    ->label(__('Receipt'))
                    ->collection('receipts')
                    ->columnSpanFull(),

                Textarea::make('notes')
                    ->label(__('Notes'))
                    ->nullable()
                    ->columnSpanFull(),

                Hidden::make('created_by')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
