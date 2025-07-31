<?php

namespace App\Filament\Resources\UtilitasPerformanceResource\Pages;

use App\Filament\Resources\UtilitasPerformanceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUtilitasPerformance extends CreateRecord
{
    protected static string $resource = UtilitasPerformanceResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
