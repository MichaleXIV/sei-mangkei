<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marketer extends Model
{
    protected $fillable = [
        'fid',
        'objectid',
        'metadata',
        'remark',
        'srs_id',
        'fcode',
        'gisid',
        'nama_agency',
        'alamat_tenant',
        'nomor_sertifikat_p4t',
        'email',
        'no_telp',
        'fax',
        'no_hp',
        'no_whatsapp',
        'npwp',
        'jenis_marketer'
    ];
}
