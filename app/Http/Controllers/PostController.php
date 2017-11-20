<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index() {
        $posts = Post::latest()->filter(request(['month', 'year']))->paginate(2);
        return view('post.index', compact('posts'));
    }
    
    public function show(Post $post) {
        return view('post.show', compact('post'));
    }
    
     public function indexTag(Tag $tag) {
        $posts = $tag->posts()->latest()->paginate(2);
        return view('post.index', compact('posts'));
    }
    
}
