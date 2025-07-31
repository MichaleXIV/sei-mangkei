<?php

namespace App\Filament\Resources\KontrakTenantResource\Pages;

use App\Filament\Resources\KontrakTenantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKontrakTenants extends ListRecords
{
    protected static string $resource = KontrakTenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
