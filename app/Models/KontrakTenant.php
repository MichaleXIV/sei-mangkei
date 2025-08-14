<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

class KontrakTenant extends Model
{
    protected $casts = [
        'attachment' => 'string', // change it to 'array' if multiple files
    ];

    protected $guarded = [
        "id",
    ];

    public function Tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function kavlings(): HasMany
    {
        return $this->hasMany(Kavling::class, 'kontrak_tenant_id', 'id');
    }

    public function marketers()
    {
        return $this->belongsToMany(Marketer::class);
    }

    // FOR HANDLING UPDATE "kontrak_tenant_id" IN KAVLING TABLE ====
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($kontrakTenant) {
            if (request()->all()["components"][0]["calls"][0]["method"] == "create") {
                if (!empty($kavlingIds = json_decode(request()->all()["components"][0]["snapshot"])->data->data[0]->kavling_ids[0])) {
                    Kavling::whereIn('id', $kavlingIds)
                        ->update(['kontrak_tenant_id' => $kontrakTenant->id]);
                }
            }
            if (request()->all()["components"][0]["calls"][0]["method"] == "save") {
                if (!empty($kavIds = Arr::undot(request()->all()["components"][0]["updates"])["data"]["kavling_ids"])) {
                    Kavling::whereIn('id', $kavIds)
                        ->update(['kontrak_tenant_id' => $kontrakTenant->id]);
                }
            }
        });
    }
}
