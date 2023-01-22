<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function newses()
    {
        return $this->hasMany(News::class);
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
