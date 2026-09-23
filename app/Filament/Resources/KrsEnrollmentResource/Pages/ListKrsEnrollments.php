<?php

namespace App\Filament\Resources\KrsEnrollmentResource\Pages;

use App\Filament\Resources\KrsEnrollmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKrsEnrollments extends ListRecords
{
    protected static string $resource = KrsEnrollmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
