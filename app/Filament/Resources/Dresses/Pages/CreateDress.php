<?php

declare(strict_types=1);

namespace App\Filament\Resources\Dresses\Pages;

use App\Filament\Resources\Dresses\DressResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDress extends CreateRecord
{
    protected static string $resource = DressResource::class;
}
