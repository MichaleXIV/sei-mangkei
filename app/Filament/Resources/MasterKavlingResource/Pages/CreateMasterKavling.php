<?php

namespace App\Filament\Resources\MasterKavlingResource\Pages;

use App\Filament\Resources\MasterKavlingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMasterKavling extends CreateRecord
{
    protected static string $resource = MasterKavlingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
