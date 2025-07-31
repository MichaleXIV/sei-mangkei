<?php

namespace App\Filament\Resources\MasterKavlingResource\Pages;

use App\Filament\Resources\MasterKavlingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterKavling extends EditRecord
{
    protected static string $resource = MasterKavlingResource::class;

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
