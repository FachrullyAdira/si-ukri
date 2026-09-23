<?php

namespace App\Filament\Resources\MateriPertemuanResource\Pages;

use App\Filament\Resources\MateriPertemuanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMateriPertemuans extends ListRecords
{
    protected static string $resource = MateriPertemuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
