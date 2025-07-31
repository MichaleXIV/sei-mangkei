<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfrastrukturKawasan extends Model
{
    protected $fillable = [
        'fid',
        'objectid',
        'metadata',
        'remark',
        'srs_id',
        'fcode',
        'gisid',
    ];
}
