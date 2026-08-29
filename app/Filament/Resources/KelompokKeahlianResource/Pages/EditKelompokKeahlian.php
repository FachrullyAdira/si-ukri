<?php

namespace App\Filament\Resources\KelompokKeahlianResource\Pages;

use App\Filament\Resources\KelompokKeahlianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKelompokKeahlian extends EditRecord
{
    protected static string $resource = KelompokKeahlianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
