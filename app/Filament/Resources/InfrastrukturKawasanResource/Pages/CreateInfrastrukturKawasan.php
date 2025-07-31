<?php

namespace App\Filament\Resources\InfrastrukturKawasanResource\Pages;

use App\Filament\Resources\InfrastrukturKawasanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInfrastrukturKawasan extends CreateRecord
{
    protected static string $resource = InfrastrukturKawasanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
