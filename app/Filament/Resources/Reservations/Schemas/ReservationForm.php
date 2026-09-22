<?php

declare(strict_types=1);

namespace App\Filament\Resources\Reservations\Schemas;

use App\Enums\DiscountType;
use App\Enums\ReservationStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReservationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Reservation Details')
                    ->schema([
                        TextInput::make('code')
                            ->disabled()
                            ->dehydrated(false)
                            ->hiddenOn('create'),
                        Select::make('customer_id')
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('status')
                            ->options(ReservationStatus::class)
                            ->required()
                            ->default(ReservationStatus::Pending),
                        DatePicker::make('reservation_date')
                            ->required()
                            ->default(today()),
                        DatePicker::make('delivery_date')
                            ->required(),
                        DatePicker::make('return_date')
                            ->required()
                            ->afterOrEqual('delivery_date'),
                        TextInput::make('insurance_amount')
                            ->numeric()
                            ->prefix('EGP')
                            ->default(0),
                        Textarea::make('notes')
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Pricing Summary')
                    ->schema([
                        TextInput::make('subtotal')
                            ->numeric()
                            ->prefix('EGP')
                            ->disabled()
                            ->dehydrated(),
                        Select::make('discount_type')
                            ->options(DiscountType::class)
                            ->nullable(),
                        TextInput::make('discount_value')
                            ->numeric()
                            ->prefix('EGP')
                            ->default(0),
                        TextInput::make('total_amount')
                            ->numeric()
                            ->prefix('EGP')
                            ->disabled()
                            ->dehydrated(),
                    ])
                    ->columns(2),

                Hidden::make('created_by')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
