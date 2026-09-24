<?php

declare(strict_types=1);

namespace App\Filament\Resources\Reservations\Schemas;

use App\Models\Dress;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class ReservationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Reservation Details'))
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        Select::make('customer_id')
                            ->label(__('Customer'))
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        DatePicker::make('reservation_date')
                            ->label(__('Reservation Date'))
                            ->required()
                            ->default(today()),
                        DatePicker::make('delivery_date')
                            ->label(__('Delivery Date'))
                            ->required(),
                        DatePicker::make('return_date')
                            ->label(__('Return Date'))
                            ->required()
                            ->afterOrEqual('delivery_date'),
                        Textarea::make('notes')
                            ->label(__('Notes'))
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                Section::make(__('Dresses'))
                    ->columnSpanFull()
                    ->columns(4)
                    ->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->columnSpanFull()
                            ->addActionLabel(__('Add Dress'))
                            ->columns(3)
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::recalculate($get, $set))
                            ->schema([
                                Select::make('dress_id')
                                    ->label(__('Dress'))
                                    ->relationship('dress', 'title')
                                    ->getOptionLabelFromRecordUsing(fn (Dress $record) => "{$record->code} — {$record->title}")
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function (Set $set, ?int $state) {
                                        $price = (float) (Dress::find($state)?->rental_price ?? 0);
                                        $set('price', $price);
                                        $set('total', $price);
                                        $set('discount', 0);
                                    })
                                    ->columnSpan(2),

                                TextInput::make('price')
                                    ->label(__('Rent Amount'))
                                    ->numeric()
                                    ->suffix('EGP')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set $set, Get $get) {
                                        $set('total', (float) ($get('price') ?? 0));
                                    }),

                                Hidden::make('discount')->default(0),
                                Hidden::make('total')->dehydrated(),

                                Textarea::make('notes')
                                    ->label(__('Item Notes'))
                                    ->nullable()
                                    ->columnSpanFull(),
                            ]),

                        TextInput::make('total_amount')
                            ->label(__('Total Amount'))
                            ->numeric()
                            ->suffix('EGP')
                            ->disabled()
                            ->dehydrated(),

                        TextInput::make('down_payment')
                            ->label(__('Down Payment'))
                            ->numeric()
                            ->suffix('EGP')
                            ->default(0)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::recalculate($get, $set)),

                        TextInput::make('remaining_amount')
                            ->label(__('Remaining'))
                            ->numeric()
                            ->suffix('EGP')
                            ->disabled()
                            ->dehydrated(),

                        TextInput::make('insurance_amount')
                            ->label(__('Insurance Amount'))
                            ->numeric()
                            ->suffix('EGP')
                            ->default(0),
                    ]),

                Hidden::make('subtotal')->dehydrated(),
                Hidden::make('created_by')->default(fn () => auth()->id()),
            ]);
    }

    private static function recalculate(Get $get, Set $set): void
    {
        $total = collect($get('items') ?? [])
            ->sum(fn (array $item) => (float) ($item['price'] ?? 0));

        $set('subtotal', round($total, 2));
        $set('total_amount', round($total, 2));

        $downPayment = (float) ($get('down_payment') ?? 0);
        $set('remaining_amount', round(max(0.0, $total - $downPayment), 2));
    }
}
