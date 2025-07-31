<?php

namespace App\Filament\Resources\PermohonanHgbAtauHtResource\Pages;

use App\Filament\Resources\PermohonanHgbAtauHtResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermohonanHgbAtauHts extends ListRecords
{
    protected static string $resource = PermohonanHgbAtauHtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
