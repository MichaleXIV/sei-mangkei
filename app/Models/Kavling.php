<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kavling extends Model
{
    protected $fillable = [
        'fid',
        'objectid',
        'metadata',
        'remark',
        'srs_id',
        'fcode',
        'gisid',
        'bk',
        'no_bk',
        'luas_kav',
        'lok_kav',
        'jenis_kav',
        'shape_lenght',
        'geometry',
        'created_date',
        'created_user',
        'last_edited_date',
        'last_edited_user',
        'luas_kawasan',
        'kontrak_tenant_id',
        'prospektive_tenant_id'
    ];

    public function kontrakTenant(): BelongsTo
    {
        return $this->belongsTo(KontrakTenant::class);
    }

    public function prospektiveTenant(): BelongsTo
    {
        return $this->belongsTo(ProspektiveTenant::class);
    }
}
