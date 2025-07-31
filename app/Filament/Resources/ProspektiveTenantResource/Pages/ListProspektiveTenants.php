<?php

namespace App\Filament\Resources\ProspektiveTenantResource\Pages;

use App\Filament\Resources\ProspektiveTenantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProspektiveTenants extends ListRecords
{
    protected static string $resource = ProspektiveTenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
