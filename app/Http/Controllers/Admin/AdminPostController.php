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
        $tags_list = Post::getTagsList();
        return view('admin_post.create', compact('tags_list'));
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
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
                    'post_img' => $post_img,
                    'user_id' => Auth::user()->id,
        ]);
        $post_tags_ids = explode(',', request('post_tags'));

        $post->tags()->attach($post_tags_ids);

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
        $tags_list = Post::getTagsList($post->tags()->pluck('id')->toArray());
        $choosed_tags_list = $post->getChoosedTags();

        $post_img = 'images/no_image.png';
        if (trim($post->post_img) !== '')
        {
            $post_img = 'uploads/' . $post->post_img;
        }
        return view('admin_post.edit', compact('post', 'post_img', 'choosed_tags_list', 'tags_list'));
    }

    public function update(Post $post)
    {
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
        ]);
        $file = request()->file('post_img');
        if ($file !== null && $file->isValid())
        {
            $post->post_img = $file->getClientOriginalName();
            $file->move('uploads', $file->getClientOriginalName());
        }
        $post_tags_ids = null;
        
        if (request('post_tags') !== null)
        {
            $post_tags_ids = explode(',', request('post_tags'));
        }
        $post->title = request('title');
        $post->body = request('body');
        $post->update();
        if (is_array($post_tags_ids))
        {
            $post->tags()->sync($post_tags_ids);
        } else
        {
            $post->tags()->detach();
        }
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
