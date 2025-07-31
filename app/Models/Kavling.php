<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];
}
