<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class);
    }
}
