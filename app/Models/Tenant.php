<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    protected $fillable = [
        'fid',
        'objectid',
        'metadata',
        'remark',
        'srs_id',
        'fcode',
        'gisid',
        'nama',
        'alamat',
        'email',
        'notelp',
        'fax',
        'nohp',
        'nowa',
        'npwp',
        'lat',
        'lon',
        'geometry',
        'created_date',
        'created_user',
        'last_edited_date',
        'last_edited_user',
    ];

    public function KontrakTenant(): HasMany
    {
        return $this->hasMany(KontrakTenant::class);
    }
}
