<?php

namespace App\Filament\Resources\RkapResource\Pages;

use App\Filament\Resources\RkapResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRkaps extends ListRecords
{
    protected static string $resource = RkapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
