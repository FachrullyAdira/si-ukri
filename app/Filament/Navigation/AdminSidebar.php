<?php

namespace App\Filament\Navigation;

use Filament\Navigation\NavigationGroup;

class AdminSidebar
{
    public static function getGroups(): array
    {
        $user = auth()->user();
        $groups = [];

        // Always show for now if we want, or restrict:
        $groups[] = NavigationGroup::make('Publikasi')->icon('heroicon-o-newspaper');
        $groups[] = NavigationGroup::make('Peran dan Izin')->icon('heroicon-o-shield-check');
        $groups[] = NavigationGroup::make('Akademik & Kurikulum')->icon('heroicon-o-academic-cap');
        $groups[] = NavigationGroup::make('Kemahasiswaan & Alumni')->icon('heroicon-o-users');
        $groups[] = NavigationGroup::make('Profil & Legalitas')->icon('heroicon-o-building-library');
        $groups[] = NavigationGroup::make('LMS')->icon('heroicon-o-computer-desktop');
        $groups[] = NavigationGroup::make('Pengaturan & Sistem')->icon('heroicon-o-cog-8-tooth');

        return $groups;
    }
}
