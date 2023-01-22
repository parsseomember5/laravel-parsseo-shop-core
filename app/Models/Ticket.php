<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $fillable = ['learning_id', 'user_id', 'title', 'tracking', 'status', 'content', 'priority', 'file', 'admin_id'];
    protected $withCount = ['replies'];

    const STATUS = [
        'waiting' => 'منتظر پاسخ',
        'pending' => 'در حال رسیدگی',
        'answer'  => 'پاسخ داده شده',
        'done'    => 'حل شده',
        'close'   => 'بسته شده',
        'archive' => 'بایگانی شده',
    ];

    const PRIORITY = [
        0 => 'کم',
        1 => 'عادی',
        2 => 'بحرانی'
    ];

    public function getRouteKeyName()
    {
        return 'tracking';
    }

    public function path()
    {
        return "/profile/tickets/$this->tracking";
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->tracking = self::makeUniqueTracking();
        });
    }

    private static function makeUniqueTracking()
    {
        do {
            $tracking = rand(pow(10, 6 - 1), pow(10, 6) - 1);
            $found = self::where('tracking', $tracking)->first();
        }
        while (!is_null($found));
        return $tracking;
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
