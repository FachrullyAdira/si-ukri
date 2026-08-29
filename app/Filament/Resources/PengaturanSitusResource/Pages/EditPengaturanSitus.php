<?php

namespace App\Filament\Resources\PengaturanSitusResource\Pages;

use App\Filament\Resources\PengaturanSitusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengaturanSitus extends EditRecord
{
    protected static string $resource = PengaturanSitusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
