<?php

declare(strict_types=1);

namespace App\Filament\Resources\Payments\Pages;

use App\Enums\PaymentDirection;
use App\Filament\Resources\Payments\PaymentResource;
use App\Models\Payment;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;

class ListPayments extends ListRecords
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $all = Payment::count();
        $income = Payment::where('payment_direction', PaymentDirection::In)->count();
        $expenses = Payment::where('payment_direction', PaymentDirection::Out)->count();

        return [
            'all' => Tab::make('All')
                ->icon(Heroicon::OutlinedBanknotes)
                ->badge($all),

            'income' => Tab::make('Income')
                ->icon(Heroicon::OutlinedArrowTrendingUp)
                ->badge($income)
                ->badgeColor('success')
                ->query(fn ($query) => $query->where('payment_direction', PaymentDirection::In)),

            'expenses' => Tab::make('Expenses')
                ->icon(Heroicon::OutlinedArrowTrendingDown)
                ->badge($expenses)
                ->badgeColor('danger')
                ->query(fn ($query) => $query->where('payment_direction', PaymentDirection::Out)),
        ];
    }
}
