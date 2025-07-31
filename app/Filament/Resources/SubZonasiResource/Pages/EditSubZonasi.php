<?php

namespace App\Filament\Resources\SubZonasiResource\Pages;

use App\Filament\Resources\SubZonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubZonasi extends EditRecord
{
    protected static string $resource = SubZonasiResource::class;

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
