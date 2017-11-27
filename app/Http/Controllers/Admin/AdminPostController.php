<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'post_img' => 'sometimes|image',
            'body' => 'required',
        ]);

        $filename = '';

         if (request()->hasFile('post_img'))
        {
            $image = request()->file('post_img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/');
            $image->move($location, $filename);
        }

        $post = Post::create([
                    'title' => request('title'),
                    'body' => request('body'),
                    'slug' => request('slug'),
                    'post_img' => $filename,
                    'user_id' => Auth::user()->id,
        ]);


        if (null !== request('tags'))
        {
            $post->tags()->sync(request('tags'), false);
        }

        session()->flash('success', 'Successfully added post');

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
            'post_img' => 'sometimes|image',
            'body' => 'required',
        ]);
        
        $post->title = request('title');
        $post->slug = request('slug');
        $post->body = request('body');
        
        if (request()->hasFile('post_img'))
        {
            $image = request()->file('post_img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/');
            $image->move($location, $filename);
            $old_filename = $post->post_img;
            $post->post_img = $filename;
            Storage::delete($old_filename);
        }
        
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
        Storage::delete($post->post_img);
        session()->flash('success', 'Successfully deleted post ' . $post->title);

        return redirect()->route('admin_post.index');
    }

}
