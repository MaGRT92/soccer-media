<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class AdminTagController extends Controller
{
    public function index() {
        $tags = Tag::all();
        return response()->json(['tags' => $tags]);
    }
    
    public function store() {
        $this->validate(request(), [
           'tag_name' => 'required' 
        ]);
        
        Tag::create([
            'name' => request('tag_name')
        ]);
        
        return back();
    }
}
