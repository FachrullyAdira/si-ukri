<?php

namespace App\Filament\Resources\KelompokKeahlianResource\Pages;

use App\Filament\Resources\KelompokKeahlianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKelompokKeahlians extends ListRecords
{
    protected static string $resource = KelompokKeahlianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
