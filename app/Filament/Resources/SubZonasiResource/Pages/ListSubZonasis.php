<?php

namespace App\Filament\Resources\SubZonasiResource\Pages;

use App\Filament\Resources\SubZonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubZonasis extends ListRecords
{
    protected static string $resource = SubZonasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
