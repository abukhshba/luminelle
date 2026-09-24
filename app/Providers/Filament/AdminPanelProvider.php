<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Widgets\DressStatusWidget;
use App\Filament\Widgets\FinancialOverviewWidget;
use App\Filament\Widgets\OutstandingBalancesWidget;
use App\Filament\Widgets\OverdueReturnsWidget;
use App\Filament\Widgets\TodaysDeliveriesWidget;
use App\Filament\Widgets\TodaysReturnsWidget;
use App\Filament\Widgets\UpcomingReservationsWidget;
use App\Http\Middleware\SetLocale;
use Filament\FontProviders\BunnyFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->font('Cairo', provider: BunnyFontProvider::class)
            ->userMenuItems([
                MenuItem::make()
                    ->label(fn () => app()->getLocale() === 'ar' ? 'English' : 'العربية')
                    ->url(fn () => route('locale.switch', app()->getLocale() === 'ar' ? 'en' : 'ar'))
                    ->icon(Heroicon::OutlinedLanguage),
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn () => app()->getLocale() === 'ar'
                    ? '<style>html,body{direction:rtl;font-family:"Cairo",sans-serif!important}</style>'
                    : '<style>html,body{direction:ltr;font-family:"Cairo",sans-serif!important}</style>'
            )
            ->renderHook(
                PanelsRenderHook::TOPBAR_END,
                fn () => Blade::render(<<<'HTML'
                    <a href="{{ route('locale.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                       title="{{ app()->getLocale() === 'ar' ? 'Switch to English' : 'التبديل إلى العربية' }}"
                       class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 dark:border-white/10 dark:bg-white/5 dark:text-gray-300 dark:hover:bg-white/10 me-2">
                        <x-heroicon-o-language class="h-5 w-5" />
                        <span class="text-base">{{ app()->getLocale() === 'ar' ? 'EN' : 'ع' }}</span>
                    </a>
                HTML)
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                FinancialOverviewWidget::class,
                OutstandingBalancesWidget::class,
                DressStatusWidget::class,
                TodaysDeliveriesWidget::class,
                TodaysReturnsWidget::class,
                UpcomingReservationsWidget::class,
                OverdueReturnsWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                SetLocale::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
