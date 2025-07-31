<?php

namespace App\Filament\Resources\KontrakTenantResource\Pages;

use App\Filament\Resources\KontrakTenantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKontrakTenant extends EditRecord
{
    protected static string $resource = KontrakTenantResource::class;

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
