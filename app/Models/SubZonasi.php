<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubZonasi extends Model
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
        'zonasi', // TODO: remove this if possible
        "zonasi_id",
        'gisid_zonasi',
        'shape_lenght',
        'geometry',
        'created_date',
        'created_user',
        'last_edited_date',
        'last_edited_user',
    ];

    public function Zonasi(): BelongsTo
    {
        return $this->belongsTo(Zonasi::class);
    }
}
