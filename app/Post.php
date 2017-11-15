<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'post_img'];
    
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    
    public function addComment($body) {
        return $this->comments()->create([
            'body' => $body,
            'user_id' => Auth::user()->id,
            ]);
    }
}
