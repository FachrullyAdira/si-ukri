<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Widgets\AdminWelcomeWidget;
use App\Filament\Widgets\StatsOverviewWidget;

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
                'primary' => Color::Hex('#0A6B39'),   // Emerald Logo Green
                'danger'  => Color::Hex('#EF3829'),   // Coral Logo Red
                'amber'   => Color::Hex('#D97706'),   // Academic Gold
                'info'    => Color::Hex('#0284C7'),   // Sky Blue
                'success' => Color::Hex('#059669'),   // Emerald Success
                'gray'    => Color::Slate,            // Sleek Modern Slate
            ])
            ->brandName('SI UKRI Admin Portal')
            ->brandLogo(asset('images/logo-si-ukri.png'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('images/logo.png'))
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth('full')
            ->databaseNotifications()
            ->navigationGroups([
                'Konten & Berita',
                'Akademik & Kurikulum',
                'Kemahasiswaan & Alumni',
                'Profil & Legalitas',
                'Pengaturan & Sistem',
            ])
            ->renderHook(
                'panels::head.done',
                fn () => '<link rel="stylesheet" href="' . asset('css/filament-admin-theme.css') . '?v=' . time() . '">'
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                AdminWelcomeWidget::class,
                StatsOverviewWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
