<?php

namespace App\Filament\Resources\PermohonanHgbAtauHtResource\Pages;

use App\Filament\Resources\PermohonanHgbAtauHtResource;
use App\Models\Tenant;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePermohonanHgbAtauHt extends CreateRecord
{
    protected static string $resource = PermohonanHgbAtauHtResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $namaTenant= Tenant::where("id", $data['tenant_id'])->first()->nama;
        $data['tenant'] = $namaTenant;

        return $data;
    }
}
