<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KontrakTenant extends Model
{
    protected $guarded = [
        "id",
    ];

    public function Tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
