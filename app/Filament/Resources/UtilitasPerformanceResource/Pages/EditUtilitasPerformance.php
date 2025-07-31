<?php

namespace App\Filament\Resources\UtilitasPerformanceResource\Pages;

use App\Filament\Resources\UtilitasPerformanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUtilitasPerformance extends EditRecord
{
    protected static string $resource = UtilitasPerformanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
