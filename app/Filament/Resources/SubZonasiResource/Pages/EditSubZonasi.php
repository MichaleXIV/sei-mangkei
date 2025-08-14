<?php

namespace App\Filament\Resources\SubZonasiResource\Pages;

use App\Filament\Resources\SubZonasiResource;
use App\Models\Zonasi;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubZonasi extends EditRecord
{
    protected static string $resource = SubZonasiResource::class;

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
        $namaZona = Zonasi::where("id", $data['zonasi_id'])->first()->nama;
        $data['zonasi'] = $namaZona;

        return $data;
    }
}
