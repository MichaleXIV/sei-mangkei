<?php

namespace App\Filament\Resources\KontrakTenantResource\Pages;

use App\Filament\Resources\KontrakTenantResource;
use App\Models\Kavling;
use App\Models\Tenant;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKontrakTenant extends EditRecord
{
    protected static string $resource = KontrakTenantResource::class;

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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // $noBloks = $data['kavling_ids'];
        // Kavling::whereIn('no_bk', $noBloks)->update(['kontrak_tenant_id' => $data['id']]);

        $namaTenant= Tenant::where("id", $data['tenant_id'])->first()->nama;
        $data['tenant'] = $namaTenant;

        return $data;
    }
}
