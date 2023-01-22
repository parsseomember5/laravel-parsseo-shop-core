<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use Sluggable;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'title',
        'image',
        'slug',
        'featured',
        'meta_description',
        'description',
        'canonical'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'unique' => true,
                'onUpdate' => false,
                'includeTrashed' => true
            ]
        ];
    }

    public function getImage(){
        if ($this->image){
            return '/storage' . $this->image;
        }
        return asset('images/default.jpg');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_category','category_id','product_id');
    }
}
