<?php

namespace App\Filament\Resources\InfrastrukturKawasanResource\Pages;

use App\Filament\Resources\InfrastrukturKawasanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInfrastrukturKawasans extends ListRecords
{
    protected static string $resource = InfrastrukturKawasanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
