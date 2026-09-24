<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Enums\DressStatus;
use App\Models\Dress;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Pos extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.pos';

    public string $search = '';

    public static function getNavigationLabel(): string
    {
        return __('POS');
    }

    public function getTitle(): string|Htmlable
    {
        return __('Point of Sale');
    }

    #[Computed]
    public function dresses(): Collection
    {
        return Dress::with('media')
            ->where('status', '!=', DressStatus::Inactive)
            ->when($this->search, fn ($q) => $q->where(function ($q): void {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('code', 'like', "%{$this->search}%");
            }))
            ->orderByRaw("FIELD(status, 'available', 'reserved', 'rented', 'maintenance')")
            ->orderBy('title')
            ->get();
    }
}
