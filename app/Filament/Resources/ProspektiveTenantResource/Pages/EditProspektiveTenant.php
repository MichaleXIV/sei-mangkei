<?php

namespace App\Filament\Resources\ProspektiveTenantResource\Pages;

use App\Filament\Resources\ProspektiveTenantResource;
use App\Models\Tenant;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProspektiveTenant extends EditRecord
{
    protected static string $resource = ProspektiveTenantResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $namaTenant= Tenant::where("id", $data['tenant_id'])->first()->nama;
        $data['tenant'] = $namaTenant;

        return $data;
    }
}
