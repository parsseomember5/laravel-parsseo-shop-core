<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Spatie\Tags\HasTags;

class Product extends Model implements Viewable
{
    use Sluggable, SoftDeletes, HasTags,InteractsWithViews;

    protected $canonicalBasePath = '/products';
    protected $guarded           = [];
    protected $casts             = [
        'image' => 'array',
        'faq' => 'array'
    ];

    const STATUS = [
      "pending"   => 'در حال بررسی',
      "published" => 'منتشر شده',
      "draft"     => 'پیش نویس',
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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function path(): string
    {
        return "/products/$this->slug";
    }

    public function author()
    {
        return $this->belongsTo(Admin::class,'author_id');
    }

    public function translation()
    {
        return $this->hasOne(Post::class,'translation_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->where('status', true);
    }

    public function modal()
    {
        return $this->belongsTo(Modal::class);
    }

    public function recommendeds()
    {
        return $this->belongsToMany(Product::class, 'product_recommended', 'product_id', 'recommended_id');
    }

    public function getImage($size = 'original'){

        if ($this->image == null || $this->image == ""){
            return asset('images/default.jpg');
        }
        return '/storage'.$this->image[$size];
    }
}
