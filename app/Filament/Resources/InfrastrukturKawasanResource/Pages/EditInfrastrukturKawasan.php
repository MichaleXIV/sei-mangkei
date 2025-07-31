<?php

namespace App\Filament\Resources\InfrastrukturKawasanResource\Pages;

use App\Filament\Resources\InfrastrukturKawasanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInfrastrukturKawasan extends EditRecord
{
    protected static string $resource = InfrastrukturKawasanResource::class;

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
