<?php

namespace App\Filament\Resources\HimaPengurusResource\Pages;

use App\Filament\Resources\HimaPengurusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHimaPengurus extends ListRecords
{
    protected static string $resource = HimaPengurusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
