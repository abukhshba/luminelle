<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupplierBills\RelationManagers;

use App\Enums\PaymentDirection;
use App\Enums\PaymentMethod;
use App\Models\PaymentCategory;
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
                    ->required()
                    ->rules([
                        fn () => function (string $attribute, $value, \Closure $fail) {
                            $bill = $this->getOwnerRecord();
                            $remaining = $bill->remainingAmount();
                            if ((float) $value > $remaining) {
                                $fail('Amount cannot exceed the remaining balance of EGP '.number_format($remaining, 2));
                            }
                        },
                    ]),
                DatePicker::make('date')
                    ->required()
                    ->default(today()),
                Select::make('payment_method')
                    ->options(PaymentMethod::class)
                    ->required(),
                Textarea::make('notes')
                    ->nullable(),
                Hidden::make('payment_direction')
                    ->default(PaymentDirection::Out->value),
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
                TextColumn::make('payment_method')
                    ->badge(),
                TextColumn::make('notes'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data, $livewire): array {
                        $bill = $livewire->getOwnerRecord();
                        $data['payment_direction'] = PaymentDirection::Out->value;
                        $data['supplier_id'] = $bill->supplier_id;
                        $data['created_by'] = auth()->id();
                        $data['payment_category_id'] = PaymentCategory::where('name', 'Supplier Bill')->value('id');

                        return $data;
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
