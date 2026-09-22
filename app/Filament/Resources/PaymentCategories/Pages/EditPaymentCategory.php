<?php

declare(strict_types=1);

namespace App\Filament\Resources\PaymentCategories\Pages;

use App\Filament\Resources\PaymentCategories\PaymentCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPaymentCategory extends EditRecord
{
    protected static string $resource = PaymentCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
