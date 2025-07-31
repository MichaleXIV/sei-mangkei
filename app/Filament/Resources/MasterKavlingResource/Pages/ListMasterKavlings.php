<?php

namespace App\Filament\Resources\MasterKavlingResource\Pages;

use App\Filament\Resources\MasterKavlingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterKavlings extends ListRecords
{
    protected static string $resource = MasterKavlingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
