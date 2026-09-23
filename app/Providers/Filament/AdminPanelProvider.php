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
            ->path('superadmin')
            ->login(\App\Filament\Pages\Auth\CustomLogin::class)
            ->spa()
            ->darkMode(false)
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
            ->navigationGroups(\App\Filament\Navigation\AdminSidebar::getGroups())
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn () => '<link rel="stylesheet" href="' . asset('css/filament-admin-theme.css') . '?v=' . time() . '">'
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
                fn () => new \Illuminate\Support\HtmlString('<div class="text-center mt-8 text-xs font-medium text-emerald-700 flex justify-center items-center gap-1.5"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08Zm3.094 8.016a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" /></svg> Dilindungi dengan enkripsi SSL 256-bit</div>')
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                AdminWelcomeWidget::class,
                StatsOverviewWidget::class,
                \App\Filament\Widgets\MahasiswaChartWidget::class,
                \App\Filament\Widgets\AksesChartWidget::class,
                \App\Filament\Widgets\LatestBeritaWidget::class,
            ])
            ->plugin(\Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin::make())
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
