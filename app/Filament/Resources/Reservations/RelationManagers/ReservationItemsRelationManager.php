<?php

declare(strict_types=1);

namespace App\Filament\Resources\Reservations\RelationManagers;

use App\Models\Dress;
use App\Services\DressAvailabilityService;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReservationItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('dress_id')
                    ->relationship('dress', 'title')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Forms\Set $set, ?int $state) {
                        if ($state) {
                            $dress = Dress::find($state);
                            $set('price', $dress?->rental_price ?? 0);
                        }
                    }),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('EGP')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get) {
                        $set('total', max(0, (float) ($get('price') ?? 0) - (float) ($get('discount') ?? 0)));
                    }),
                TextInput::make('discount')
                    ->numeric()
                    ->prefix('EGP')
                    ->default(0)
                    ->live()
                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get) {
                        $set('total', max(0, (float) ($get('price') ?? 0) - (float) ($get('discount') ?? 0)));
                    }),
                TextInput::make('total')
                    ->numeric()
                    ->prefix('EGP')
                    ->disabled()
                    ->dehydrated(),
                Textarea::make('notes')
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('dress.code'),
                TextColumn::make('dress.title'),
                TextColumn::make('price')
                    ->money('EGP'),
                TextColumn::make('discount')
                    ->money('EGP'),
                TextColumn::make('total')
                    ->money('EGP'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->before(function (array $data, $livewire, CreateAction $action) {
                        $reservation = $livewire->getOwnerRecord();
                        $service = app(DressAvailabilityService::class);

                        if (! $service->isAvailable(
                            $data['dress_id'],
                            $reservation->delivery_date->format('Y-m-d'),
                            $reservation->return_date->format('Y-m-d'),
                            $reservation->id
                        )) {
                            Notification::make()
                                ->title('Dress Not Available')
                                ->body('This dress is already reserved for the selected period.')
                                ->danger()
                                ->send();

                            $action->halt();
                        }
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
