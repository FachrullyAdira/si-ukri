<?php

namespace App\Filament\Pages;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static string $routePath = 'dashboard';

    public function getBreadcrumbs(): array
    {
        return [
            'Dasbor',
        ];
    }
}
