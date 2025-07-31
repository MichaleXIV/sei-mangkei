<?php

namespace App\Filament\Resources\RkapResource\Pages;

use App\Filament\Resources\RkapResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRkap extends CreateRecord
{
    protected static string $resource = RkapResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
