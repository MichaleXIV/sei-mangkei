<?php

namespace App\Filament\Resources\UtilitasPerformanceResource\Pages;

use App\Filament\Resources\UtilitasPerformanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUtilitasPerformances extends ListRecords
{
    protected static string $resource = UtilitasPerformanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
