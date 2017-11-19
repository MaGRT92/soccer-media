<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Post extends Model
{

    protected $fillable = ['title', 'body', 'user_id', 'post_img'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function addComment($body)
    {
        return $this->comments()->create([
                    'body' => $body,
                    'user_id' => Auth::user()->id,
        ]);
    }

    public function scopeFilter($query, $filters)
    {
        if (array_key_exists('month', $filters) && $month = $filters['month'])
        {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if (array_key_exists('year', $filters) && $year = $filters['year'])
        {
            $query->whereYear('created_at', $year);
        }
    }

    public static function archives()
    {
        return static::selectRaw('year(created_at) as year, monthname(created_at) month, count(*) as published')
                        ->groupBy('year', 'month')->orderByRaw('min(created_at)')->get()->toArray();
    }
    
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

}
