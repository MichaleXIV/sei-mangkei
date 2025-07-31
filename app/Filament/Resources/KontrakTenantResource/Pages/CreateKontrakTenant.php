<?php

namespace App\Filament\Resources\KontrakTenantResource\Pages;

use App\Filament\Resources\KontrakTenantResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKontrakTenant extends CreateRecord
{
    protected static string $resource = KontrakTenantResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
