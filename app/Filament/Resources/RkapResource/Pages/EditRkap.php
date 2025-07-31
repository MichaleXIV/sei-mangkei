<?php

namespace App\Filament\Resources\RkapResource\Pages;

use App\Filament\Resources\RkapResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRkap extends EditRecord
{
    protected static string $resource = RkapResource::class;

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
