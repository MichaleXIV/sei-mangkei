<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zonasi extends Model
{
    protected $fillable = [
        'nama',
    ];

    public function SubZonasi(): HasMany
    {
        return $this->hasMany(SubZonasi::class);
    }
}
