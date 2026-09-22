<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupplierBills\Pages;

use App\Filament\Resources\SupplierBills\SupplierBillResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSupplierBills extends ListRecords
{
    protected static string $resource = SupplierBillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
