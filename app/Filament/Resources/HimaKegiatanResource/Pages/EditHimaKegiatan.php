<?php

namespace App\Filament\Resources\HimaKegiatanResource\Pages;

use App\Filament\Resources\HimaKegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHimaKegiatan extends EditRecord
{
    protected static string $resource = HimaKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
