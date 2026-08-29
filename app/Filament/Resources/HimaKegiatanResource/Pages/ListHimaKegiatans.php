<?php

namespace App\Filament\Resources\HimaKegiatanResource\Pages;

use App\Filament\Resources\HimaKegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHimaKegiatans extends ListRecords
{
    protected static string $resource = HimaKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
