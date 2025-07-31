<?php

namespace App\Filament\Resources\ZonasiResource\Pages;

use App\Filament\Resources\ZonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZonasi extends EditRecord
{
    protected static string $resource = ZonasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
