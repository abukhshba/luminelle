<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupplierBills\Pages;

use App\Filament\Resources\SupplierBills\SupplierBillResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSupplierBill extends CreateRecord
{
    protected static string $resource = SupplierBillResource::class;
}
