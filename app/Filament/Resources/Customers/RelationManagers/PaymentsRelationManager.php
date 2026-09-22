<?php

declare(strict_types=1);

namespace App\Filament\Resources\Customers\RelationManagers;

use App\Enums\PaymentDirection;
use App\Enums\PaymentMethod;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('amount')
                    ->numeric()
                    ->required(),
                DatePicker::make('date')
                    ->required()
                    ->default(today()),
                Select::make('payment_direction')
                    ->options(PaymentDirection::class)
                    ->required(),
                Select::make('payment_method')
                    ->options(PaymentMethod::class)
                    ->required(),
                Select::make('payment_category_id')
                    ->relationship('paymentCategory', 'name')
                    ->nullable(),
                Textarea::make('notes')
                    ->nullable(),
                Hidden::make('created_by')
                    ->default(fn () => auth()->id()),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                TextColumn::make('code'),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('amount')
                    ->money('EGP'),
                TextColumn::make('payment_direction')
                    ->badge(),
                TextColumn::make('paymentCategory.name')
                    ->label('Category'),
                TextColumn::make('payment_method'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
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
