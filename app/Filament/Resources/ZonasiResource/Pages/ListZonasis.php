<?php

namespace App\Filament\Resources\ZonasiResource\Pages;

use App\Filament\Resources\ZonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListZonasis extends ListRecords
{
    protected static string $resource = ZonasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
