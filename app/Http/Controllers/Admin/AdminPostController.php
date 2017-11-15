<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        ]);
        
        $file = request()->file('post_img');
        $post_img = isset($file) ? $file->getClientOriginalName() : '';

        Post::create([
                'title' => request('title'),
                'body' => request('body'),
                'post_img' => $post_img,
                'user_id' => Auth::user()->id,
            ]);

        session()->flash('success', 'Successfully added post');


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
        $post_img = 'images/no_image.png';
        if(trim($post->post_img) !== '') {
            $post_img = 'uploads/' . $post->post_img;
        }
        return view('admin_post.edit', compact('post', 'post_img'));
    }

    public function update(Post $post)
    {
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
        ]);
        $file = request()->file('post_img');
        if($file !== null) {
            $post->post_img = $file->getClientOriginalName();
            $file->move('uploads', $file->getClientOriginalName());
        }
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
