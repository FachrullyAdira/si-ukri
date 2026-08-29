<?php

namespace App\Filament\Resources\PengaturanSitusResource\Pages;

use App\Filament\Resources\PengaturanSitusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengaturanSitus extends ListRecords
{
    protected static string $resource = PengaturanSitusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
