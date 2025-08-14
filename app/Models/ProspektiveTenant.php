<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

class ProspektiveTenant extends Model
{
    protected $guarded = [
        "id",
    ];

    public function kavlings(): HasMany
    {
        return $this->hasMany(Kavling::class, 'prospektive_tenant_id', 'id');
    }

    // FOR HANDLING UPDATE "prospektive_tenant_id" IN KAVLING TABLE ====
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($prospektiveTenant) {
            if (request()->all()["components"][0]["calls"][0]["method"] == "create") {
                if (!empty($kavlingIds = json_decode(request()->all()["components"][0]["snapshot"])->data->data[0]->kavlings[0])) {
                    Kavling::whereIn('id', $kavlingIds)
                        ->update(['prospektive_tenant_id' => $prospektiveTenant->id]);
                }
            }
            if (request()->all()["components"][0]["calls"][0]["method"] == "save") {
                if (!empty($kavIds = Arr::undot(request()->all()["components"][0]["updates"])["data"]["kavlings"])) {
                    Kavling::whereIn('id', $kavIds)
                        ->update(['prospektive_tenant_id' => $prospektiveTenant->id]);
                }
            }
        });
    }
}
