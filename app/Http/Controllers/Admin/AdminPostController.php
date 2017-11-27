<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
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
        $tags = Tag::all();
        $post_img = 'images/no_image.png';
        return view('admin_post.create', compact('tags', 'post_img'));
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'slug' => 'required|unique:posts,slug',
            'body' => 'required',
        ]);

        $post_img = '';

        if (request()->hasFile('post_img') && request()->file('post_img')->isValid())
        {
            $post_img = request()->file('post_img')->getClientOriginalName();
        }

        $post = Post::create([
                    'title' => request('title'),
                    'body' => request('body'),
                    'slug' => request('slug'),
                    'post_img' => $post_img,
                    'user_id' => Auth::user()->id,
        ]);


        if (null !== request('tags'))
        {
            $post->tags()->sync(request('tags'), false);
        }

        session()->flash('success', 'Successfully added post');


        if ($post_img !== '')
        {
            request()->file('post_img')->move('uploads', $post_img);
        }

        return redirect()->route('admin_post.index');
    }

    public function show(Post $post)
    {
        $post_img = 'images/no_image.png';
        if (trim($post->post_img) !== '')
        {
            $post_img = 'uploads/' . $post->post_img;
        }
        return view('admin_post.show', compact('post', 'post_img'));
    }

    public function edit(Post $post)
    {
        $tags = Tag::all();

        $post_img = 'images/no_image.png';
        if (trim($post->post_img) !== '')
        {
            $post_img = 'uploads/' . $post->post_img;
        }
        return view('admin_post.edit', compact('post', 'post_img', 'tags'));
    }

    public function update(Post $post)
    {
        $slug_validation_rules = '';
        if ($post->slug !== request('slug'))
        {
            $slug_validation_rules = 'required|unique:posts,slug';
        }

        $this->validate(request(), [
            'title' => 'required',
            'slug' => $slug_validation_rules,
            'body' => 'required',
        ]);
        $file = request()->file('post_img');
        if ($file !== null && $file->isValid())
        {
            $post->post_img = $file->getClientOriginalName();
            $file->move('uploads', $file->getClientOriginalName());
        }

        $post->title = request('title');
        $post->slug = request('slug');
        $post->body = request('body');
        $post->update();
         
        if (null !== request('tags'))
        {
            $post->tags()->sync(request('tags'));
        } else
        {
            $post->tags()->sync(array());
        }
        session()->flash('success', 'Successfully edited post');

        return redirect()->route('admin_post.index');
    }

    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();
        session()->flash('success', 'Successfully deleted post ' . $post->title);

        return redirect()->route('admin_post.index');
    }

}
