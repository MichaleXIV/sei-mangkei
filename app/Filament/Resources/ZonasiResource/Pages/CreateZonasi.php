<?php

namespace App\Filament\Resources\ZonasiResource\Pages;

use App\Filament\Resources\ZonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateZonasi extends CreateRecord
{
    protected static string $resource = ZonasiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
