<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;

class AdminTagController extends Controller
{
    public function index() {
        $tags = Tag::all();
        return view('admin_tag.index', compact('tags'));
    }
    
    public function store() {
        $this->validate(request(), [
           'name' => 'required' 
        ]);
        
        Tag::create([
            'name' => request('name')
        ]);
        
        session()->flash('success', 'Successfully created tag ' . request('name'));
        
        return back();
    }
    
    public function update() {
        $this->validate(request(), [
           'id' => 'required|integer', 
           'name' => 'required', 
        ]);
        $tag = Tag::find(request('id'));
        $tag->name = request('name');
        $tag->update();
        
        session()->flash('success', 'Successfully updated tag ' . $tag->name);
        
        return back();
    }
    
    public function destroy($id) {
        $tag = Tag::find($id);
        $tag->posts()->detach();
        $tag->delete();
        session()->flash('success', 'Successfully deleted tag ' . $tag->name);
        
        return back();
    }
}
