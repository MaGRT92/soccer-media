<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Tag $tag) {
        $posts = $tag->posts()->latest()->paginate(2);
        return view('post.index', compact('posts'));
    }
}
