<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin_post.index', compact('posts'));
    }

    public function create()
    {
        return view('admin_post.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
            'post_img' => 'required',
        ]);

        Post::create(request(['title', 'body']));

        session()->flash('success', 'Successfully added post');

        $file = request()->file('post_img');
        if ($file !== null)
        {
            $file->move('uploads', $file->getClientOriginalName());
        }

        return redirect()->route('admin_post.index');
    }

    public function show(Post $post)
    {
        return view('admin_post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin_post.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
        ]);

        $post->title = request('title');
        $post->body = request('body');
        $post->update();

        session()->flash('success', 'Successfully edited post');

        return redirect()->route('admin_post.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('success', 'Successfully deleted post ' . $post->title);

        return redirect()->route('admin_post.index');
    }

}
