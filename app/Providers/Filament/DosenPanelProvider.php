<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
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
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class DosenPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('dosen')
            ->path('dosen')
            ->login(\App\Filament\Pages\Auth\CustomLogin::class)
            ->spa()
            ->darkMode(false)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->brandName('SI UKRI Dosen')
            ->brandLogo(asset('images/logo-si-ukri.png'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('images/logo.png'))
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn () => '<link rel="stylesheet" href="' . asset('css/filament-admin-theme.css') . '?v=' . time() . '">'
            )
            ->resources([
                \App\Filament\Resources\KelasResource::class,
                \App\Filament\Resources\MateriPertemuanResource::class,
                \App\Filament\Resources\TugasResource::class,
                \App\Filament\Resources\PengumpulanTugasResource::class,
                \App\Filament\Resources\KrsEnrollmentResource::class,
                \App\Filament\Resources\MahasiswaResource::class,
            ])
            ->discoverResources(in: app_path('Filament/Dosen/Resources'), for: 'App\\Filament\\Dosen\\Resources')
            ->discoverPages(in: app_path('Filament/Dosen/Pages'), for: 'App\\Filament\\Dosen\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Dosen/Widgets'), for: 'App\\Filament\\Dosen\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
