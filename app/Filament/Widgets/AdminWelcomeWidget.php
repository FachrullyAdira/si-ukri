<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class AdminWelcomeWidget extends Widget
{
    protected static string $view = 'filament.widgets.admin-welcome-widget';

    protected static ?int $sort = -1; // Highest priority at top

    protected int | string | array $columnSpan = 'full';
}
