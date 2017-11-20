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

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public static function getTagsList($choosed_tags_ids = array())
    {
        $tags = Tag::all();
        $html = '';
        foreach ($tags as $tag)
        {
            $checked = '';
            if(in_array($tag->id, $choosed_tags_ids)) {
                $checked = 'checked="checked"';
            }
            $html .= '<li class="w3-padding-small"><input class="w3-check post_tag" type="checkbox"' . $checked . 'value="' . $tag->id . '">';
            $html .= '<label id="choosed_tag_lbl_' . $tag->id . '">' . $tag->name . '</label></li>';
        }
        return $html;
    }

    public function getChoosedTags()
    {
        $tags_names = $this->tags()->pluck('name');
        $html = '';
        foreach ($tags_names as $tag_name)
        {
            $html .= '<div class="w3-col m4 w3-padding w3-center">';
            $html .= '<div class="w3-tag w3-round w3-teal" style="padding:3px">';
            $html .= '<div class="w3-tag w3-round w3-teal w3-border w3-border-white">';
            $html .= $tag_name;
            $html .= '</div></div></div>';
        }
        return $html;
    }

}
