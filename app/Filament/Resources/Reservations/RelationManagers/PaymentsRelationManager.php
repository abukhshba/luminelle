<?php

declare(strict_types=1);

namespace App\Filament\Resources\Reservations\RelationManagers;

use App\Enums\PaymentDirection;
use App\Enums\PaymentMethod;
use App\Enums\PaymentState;
use App\Models\Payment;
use App\Models\PaymentCategory;
use Filament\Actions\Action;
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
use Filament\Support\Icons\Heroicon;
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
                Select::make('payment_method')
                    ->options(PaymentMethod::class)
                    ->required(),
                Select::make('status')
                    ->options(PaymentState::class)
                    ->default(PaymentState::Draft->value)
                    ->required(),
                Select::make('payment_category_id')
                    ->relationship('paymentCategory', 'name')
                    ->nullable(),
                Textarea::make('notes')
                    ->nullable(),
                Hidden::make('payment_direction')
                    ->default(PaymentDirection::In->value),
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
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('date')
                    ->date(),
                TextColumn::make('amount')
                    ->money('EGP'),
                TextColumn::make('payment_direction')
                    ->badge(),
                TextColumn::make('paymentCategory.name')
                    ->label(__('Category')),
                TextColumn::make('payment_method'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data, $livewire): array {
                        $reservation = $livewire->getOwnerRecord();
                        $data['payment_direction'] = PaymentDirection::In->value;
                        $data['customer_id'] = $reservation->customer_id;
                        $data['created_by'] = auth()->id();

                        if (empty($data['payment_category_id'])) {
                            $data['payment_category_id'] = PaymentCategory::where('name', 'Reservation Payment')->value('id');
                        }

                        return $data;
                    }),
            ])
            ->recordActions([
                Action::make('changeStatus')
                    ->label(__('Change Status'))
                    ->icon(Heroicon::OutlinedArrowPath)
                    ->color('gray')
                    ->form([
                        Select::make('status')
                            ->options(PaymentState::class)
                            ->required(),
                    ])
                    ->fillForm(fn (Payment $record): array => ['status' => $record->status->value])
                    ->action(fn (Payment $record, array $data) => $record->update(['status' => $data['status']])),
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
