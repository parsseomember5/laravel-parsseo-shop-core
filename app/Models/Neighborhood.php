<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
