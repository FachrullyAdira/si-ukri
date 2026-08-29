<?php

namespace App\Filament\Resources\DosenStafResource\Pages;

use App\Filament\Resources\DosenStafResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDosenStaf extends EditRecord
{
    protected static string $resource = DosenStafResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
