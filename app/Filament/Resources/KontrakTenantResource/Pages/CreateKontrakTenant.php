<?php

namespace App\Filament\Resources\KontrakTenantResource\Pages;

use App\Filament\Resources\KontrakTenantResource;
use App\Models\Kavling;
use App\Models\Tenant;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Number;

class CreateKontrakTenant extends CreateRecord
{
    protected static string $resource = KontrakTenantResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // $noBlok= Kavling::where("id", $data['kavling_id'])->first()->no_bk;
        // $data['no_bk'] = $noBlok;

        $startDate = \Carbon\Carbon::parse($data['kontrak_date']);
        $endDate = \Carbon\Carbon::parse($data['end_date']);
        $contractValue = (float) $data['kontrak_nilai'];

        $durationInYears = $startDate->diffInDays($endDate) / 365;
        $accrualValue = $durationInYears > 0 ? $contractValue / $durationInYears : 0;
        $data['nilai_accrual'] = $accrualValue;

        $namaTenant= Tenant::where("id", $data['tenant_id'])->first()->nama;
        $data['tenant'] = $namaTenant;

        return $data;
    }
}
