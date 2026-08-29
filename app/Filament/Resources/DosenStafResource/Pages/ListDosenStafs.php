<?php

namespace App\Filament\Resources\DosenStafResource\Pages;

use App\Filament\Resources\DosenStafResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDosenStafs extends ListRecords
{
    protected static string $resource = DosenStafResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
