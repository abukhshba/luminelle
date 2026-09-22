<?php

declare(strict_types=1);

namespace App\Filament\Resources\Dresses\Pages;

use App\Filament\Resources\Dresses\DressResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDresses extends ListRecords
{
    protected static string $resource = DressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
