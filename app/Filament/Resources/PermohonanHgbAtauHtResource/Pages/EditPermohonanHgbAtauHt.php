<?php

namespace App\Filament\Resources\PermohonanHgbAtauHtResource\Pages;

use App\Filament\Resources\PermohonanHgbAtauHtResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermohonanHgbAtauHt extends EditRecord
{
    protected static string $resource = PermohonanHgbAtauHtResource::class;

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
